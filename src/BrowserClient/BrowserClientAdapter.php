<?php

namespace IBSWebCO\CommercioEstero\BrowserClient;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar as GuzzleHttpCookieJar;
use GuzzleHttp\Exception\RequestException;
use IBSWebCO\CommercioEstero\BrowserClient\Exceptions\BrowserClientException;
use IBSWebCO\CommercioEstero\BrowserClient\Exceptions\LoginException;
use IBSWebCO\CommercioEstero\CeClientAdapter;
use IBSWebCO\CommercioEstero\Enums\TipoPratica;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

class BrowserClientAdapter implements CeClientAdapter
{
    protected Client $client;

    protected HttpBrowser $browser;

    protected string $baseUrl = "https://commercioestero.camcom.it/";

    protected string $version = "1.0.2";

    protected string $bearerToken;

    protected string $idToken;

    protected GuzzleHttpCookieJar $guzzleCookieJar;

    private array $userAgents = [
        "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0",
        "Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0",
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0",
        "Mozilla/5.0 (Macintosh; Intel Mac OS X x.y; rv:42.0) Gecko/20100101 Firefox/42.0",
        "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0",
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36",
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0",
        "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Safari/605.1.15",
        "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36",
    ];

    private ?string $currentUserAgent = null;

    public function __construct(private bool $debug = false)
    {
        $this->client = new Client();

        $this->browser = new HttpBrowser(HttpClient::create());

        $this->setCurrentUA();
    }

    public function login(string $username, string $password): void
    {
        if (empty($username) || strlen($username) < 6) {
            throw new BrowserClientException(message: "Passare nome utente");
        }

        if (empty($password) || strlen($password) < 8) {
            throw new BrowserClientException(message: "Password password");
        }

        $this->browser->request(
            method: "GET",
            uri: "https://login.infocamere.it/eacologin/authorize?response_type=id_token%20token&client_id=ic.foeg.fr&redirect_uri=https://commercioestero.camcom.it&scope=openid%20ic_utente%20ic_account%20ic_codfiscale%20ic_nome%20ic_cognome%20ic_profili%20ic_email%20ic_settore_attivita%20ic_n_pro_cntt%20ic_tipologia_mercato&state=d680290047f&nonce=36cb968f8ec",
        );

        $this->browser->submitForm("Accedi", [
            "userid" => $username,
            "password" => $password,
        ]);

        $response = $this->browser->getCrawler()->filter("body")->text();

        if (str_contains($response, "aperta")) {
            $this->browser->submitForm("Accedi", [
                "userid" => $username,
                "password" => $password,
            ]);
        }

        if (str_contains($response, "scadenza")) {
            $this->browser->clickLink("OK");
        }

        if (str_contains($response, "completa")) {
            throw new LoginException(message: $response . " (AU03)", code: 3);
        }

        if (str_contains($response, "scaduta")) {
            throw new LoginException(message: $response . " (AU04)", code: 4);
        }

        if (str_contains($response, "scadenza")) {
            $this->browser->clickLink("OK");
        }

        if (str_contains($response, "abilitato")) {
            $this->logout();

            throw new LoginException(message: $response . " (AU08)", code: 8);
        }

        if (str_contains($response, "riuscita")) {
            throw new LoginException(message: $response . " (AU01)", code: 1);
        }

        if (str_contains($response, "nuova password")) {
            throw new LoginException(message: $response . " (AU09)", code: 9);
        }

        $u = explode("#", $this->browser->getInternalRequest()->getUri());
        $c = explode("&", $u[1]);

        foreach ($c as $t) {
            if (str_starts_with($t, "access_token")) {
                $bearer = explode("=", $t)[1];

                $this->bearerToken = trim($bearer);
            }

            if (str_starts_with($t, "id_token")) {
                $idtoken = explode("=", $t)[1];

                $this->idToken = trim($idtoken);
            }
        }

        $this->guzzleCookieJar = GuzzleHttpCookieJar::fromArray(
            cookies: $this->browser->getCookieJar()->all(),
            domain: $this->baseUrl,
        );
    }

    public function logout(): void
    {
        $this->client->get(
            uri: "https://praticacdor.infocamere.it/ptco/eacologout", //"https://login.infocamere.it/eacologin/logout.action?fw=false",
            options: [
                "cookies" => $this->guzzleCookieJar,
                "allow_redirects" => [
                    "max" => 10,
                    "referer" => true,
                ],
                "headers" => [
                    "user-Agent" => $this->currentUserAgent,
                ],
            ],
        );
    }

    public function tipoPratica(): array|string
    {
        return $this->callPrivateApi(
            method: "get",
            uriPart: "foegWeb/private/pratiche/tipologie",
        );
    }

    public function saldo(): array|string
    {
        return $this->callPrivateApi(
            method: "get",
            uriPart: "foegWeb/private/pagamenti/saldo",
        );
    }

    public function elencoPaesi(): array|string
    {
        return $this->callPrivateApi(
            method: "get",
            uriPart: "foegWeb/private/paesi",
        );
    }

    public function praticheInfo(): array
    {
        return $this->callPrivateApi(
            method: "get",
            uriPart: "foegWeb/private/pratiche/info",
        );
    }

    public function notificheCount(): array
    {
        return $this->callPrivateApi(
            method: "get",
            uriPart: "foegWeb/private/notifiche/count",
        );
    }

    public function elencoCciaa(string $codicePratica = "all"): array|string
    {
        $params =
            "all" != $codicePratica
                ? "?codicePratica=" . strtoupper($codicePratica)
                : "/" . $codicePratica;

        return $this->callPrivateApi(
            method: "get",
            uriPart: "foegWeb/private/cciaa" . $params,
        );
    }

    public function elencoSedi(string $codiceEnte): array|string
    {
        return $this->callPrivateApi(
            method: "get",
            uriPart: "foegWeb/private/cciaa/sedi?codiceEnte=" .
                strtoupper($codiceEnte),
        );
    }

    public function configurazioneSpecifica(): array|string
    {
        // https://commercioestero.camcom.it/foegWeb/private/utente/configurazioneSpecifica?tipologia=CO

        // https://commercioestero.camcom.it/foegWeb/private/utente/configurazioneSpecifica?tipologia=BDCO&codiceApplicazione=CDOR

        // https://commercioestero.camcom.it/foegWeb/private/configurazione?cciaa=ST&codiceFiscale=SMNMRC75T02G224Z&tipoPratica=CO
        return $this->callPrivateApi(
            method: "get",
            uriPart: "foegWeb/private/utente/configurazioneSpecifica?tipologia=AV&codiceApplicazione=CDOR",
        );
    }

    /**
     * Elenco provincie italiane.
     */
    public function province(): array|string
    {
        return $this->callPrivateApi(
            method: "get",
            uriPart: "assets/mocks/province-italiane.json",
        );
    }

    public function utente(bool $full = false): array|string
    {
        $uri = "foegWeb/private/utente";

        if ($full) {
            $uri .= "/full";
        }

        return $this->callPrivateApi(method: "get", uriPart: $uri);
    }

    public function avvisi(): array|string
    {
        return $this->callPrivateApi(
            method: "get",
            uriPart: "foegWeb/private/avvisi?pageNumber=1&pageSize=5&cciaa=CC0001&ascending=false",
        );
    }

    /**
     * Elenco dei tipi di file con codici per gli allegati alla pratica.
     */
    public function tipiFileAllegati(string $codicePratica = "co"): array|string
    {
        return $this->callPrivateApi(
            method: "get",
            uriPart: "foegWeb/private/file/tipi?codicePratica=" .
                strtoupper($codicePratica),
        );
    }

    public function speditori(): array|string
    {
        return $this->callPrivateApi(
            method: "get",
            uriPart: "foegWeb/private/speditori/new",
        );
    }

    public function spedizionieri(string $codiceFiscale): array|string
    {
        return $this->callPrivateApi(
            method: "post",
            uriPart: "/foegWeb/private/spedizionieri/new",
            data: ["codiceFiscale" => $codiceFiscale],
        );
    }

    public function legaleRappresentante(
        array $datiLegaleRappresentante,
    ): array|string {
        return $this->callPrivateApi(
            method: "post",
            uriPart: "foegWeb/private/registroimprese/legaleRappresentante",
            data: $datiLegaleRappresentante,
        );
    }

    public function firmatari(): array|string
    {
        throw new \Exception("Not implemented");
    }

    public function dettagliPratica(string $codicePratica): array|string
    {
        return $this->callPrivateApi(
            method: "get",
            uriPart: "foegWeb/private/pratica/" . $codicePratica,
        );
    }

    /**
     * Inserisce una nuova pratica.
     *
     * @throws BrowserClientException
     */
    public function inserisciPratica(
        array $datiPratica,
        string $tipoPratica = "co",
    ): array|string {
        return $this->callPrivateApi(
            method: "post",
            uriPart: "foegWeb/private/bozza?codicePratica=" .
                strtoupper($tipoPratica),
            data: $datiPratica,
        );
    }

    /**
     * Modifica i dati di una pratica.
     */
    public function modificaPratica(
        array $datiPratica,
        string $codicePratica,
        string $tipoPratica = "co",
    ): array|string {
        return $this->callPrivateApi(
            method: "put",
            uriPart: "foegWeb/private/bozza?codicePratica=" .
                strtoupper($tipoPratica) .
                "&idBozza=" .
                $codicePratica,
            data: $datiPratica,
        );
    }

    public function inserisciAllegato(
        array $datiAllegato,
        string $codiceRichiesta,
        int $tipoDocumento,
        string $tipoPratica = "co",
    ): array|string {
        return $this->callPrivateApi(
            method: "post",
            uriPart: "foegWeb/private/file?tipoRichiesta=" .
                strtoupper($tipoPratica) .
                "&codiceRichiesta=" .
                $codiceRichiesta .
                "&tipoDocumento=" .
                $tipoDocumento,
            data: $datiAllegato,
        );
    }

    /**
     * Download della distinta (ex xml) della richiesta per firma digitale.
     */
    public function downloadDistinta(string $codicePratica): array|string
    {
        return $this->callPrivateApi(
            method: "get",
            uriPart: "foegWeb/private/distinta?codiceRichiesta=" .
                $codicePratica,
        );
    }

    /**
     * upload del file pdf firmato del riepilogo (ex xml).
     */
    public function firmaOffline(
        string $codicePratica,
        string $codiceFiscaleFirmatario,
        array $riepilogo,
    ): array|string {
        return $this->callPrivateApi(
            method: "post",
            uriPart: "foegWeb/private/firmaoffline?codiceRichiesta=" .
                $codicePratica .
                "&codiceFiscaleFirmatario=" .
                $codiceFiscaleFirmatario,
            data: $riepilogo,
        );
    }

    public function inviaPratica(
        string $codicePratica,
        TipoPratica $tipoPratica = TipoPratica::CO,
    ): array|string {
        return $this->callPrivateApi(
            method: "post",
            uriPart: "foegWeb/private/pratica/pagaeinvia?codiceRichiesta=" .
                $codicePratica .
                "&tipoRichiesta=" .
                $tipoPratica->value,
            data: [
                "codiceRichiesta" => $codicePratica,
                "tipoRichiesta" => $tipoPratica->value,
            ],
        );
    }

    public function pratiche(
        bool $archiviate = false,
        string $label = "",
        int $pageNumber = 1,
        int $pageSize = 3,
        string $query = "",
        string $tipologiaRichiesta = "",
        bool $viewAllPratiche = false,
    ): array|string {
        return $this->callPrivateApi(
            method: "post",
            uriPart: "foegWeb/private/pratiche",
            data: [
                "archiviate" => $archiviate,
                "label" => $label,
                "pageNumber" => $pageNumber,
                "pageSize" => $pageSize,
                "query" => $query,
                "tipologiaRichiesta" => $tipologiaRichiesta,
                "viewAllPratiche" => $viewAllPratiche,
            ],
        );
    }

    /**
     * Invia una richiesta.
     *
     * @throws BrowserClientException
     */
    private function callPrivateApi(
        string $method,
        string $uriPart,
        ?array $data = null,
    ): array|string {
        $k = array_rand($this->userAgents, 1);

        try {
            $response = $this->client->request(
                method: strtoupper($method),
                uri: $this->baseUrl . $uriPart,
                options: [
                    "headers" => [
                        "Accept" => "application/json, text/plain, */*",
                        "Content-Type" => "application/json; charset=UTF-8",
                        "User-Agent" => $this->currentUserAgent,
                        "Authorization" => "Bearer {$this->bearerToken}",
                        "idToken" => $this->idToken,
                    ],
                    "cookies" => $this->guzzleCookieJar,
                    // 'json' => $data,
                    "body" => base64_encode(json_encode($data)),
                    "debug" => $this->debug,
                ],
            );

            $responseBody = $response->getBody();

            if (
                $response->hasHeader("content-type") &&
                str_contains($response->getHeader("content-type")[0], "json") &&
                json_validate($responseBody)
            ) {
                $ret = json_decode(
                    json: $responseBody,
                    associative: true,
                    flags: 0,
                );

                return $ret ?? (string) trim($responseBody);
            }

            return (string) trim($responseBody);
        } catch (RequestException $e) {
            $this->logout();

            throw new BrowserClientException(
                message: $e->getMessage(),
                code: $e->getCode(),
            );
        }
    }

    private function setCurrentUA(): void
    {
        $k = array_rand($this->userAgents, 1);

        $this->currentUserAgent = $this->userAgents[$k];
    }
}
