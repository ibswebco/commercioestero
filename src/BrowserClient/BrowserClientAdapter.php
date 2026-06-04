<?php

namespace IBSWebCO\CommercioEstero\BrowserClient;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar as GuzzleHttpCookieJar;
use IBSWebCO\CommercioEstero\BrowserClient\Exceptions\BrowserClientException;
use IBSWebCO\CommercioEstero\BrowserClient\Exceptions\LoginException;
use IBSWebCO\CommercioEstero\CeClientAdapter;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;


class BrowserClientAdapter implements CeClientAdapter
{
    protected Client $client;

    protected HttpBrowser $browser;

    protected string $baseUrl = 'https://commercioestero.camcom.it/';

    protected string $version = '1.0.0';

    protected string $bearerToken;

    protected string $idToken;

    protected GuzzleHttpCookieJar $guzzleCookieJar;

    private array $userAgents = [
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0',
        'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X x.y; rv:42.0) Gecko/20100101 Firefox/42.0',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Safari/605.1.15',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36',
    ];

    public function __construct(
        private bool $debug = false,
    )
    {
        $this->client = new Client();

        $this->browser = new HttpBrowser(HttpClient::create());
    }

    /**
     * Login al portale Commercio Estero
     * 
     * @param string $username
     * @param string $password
     * @return void
     * 
     * @throws \IBSWebCO\CommercioEstero\BrowserClient\Exceptions\LoginException
     */
    public function login(string $username, string $password): void
    {
        if (empty($username) || strlen($username) < 6) {
            throw new BrowserClientException(message: "Passare nome utente");
        }

        if (empty($password) || strlen($password) < 8) {
            throw new BrowserClientException(message: "Password password");
        }

        $this->browser->request(
            method: 'GET',
            uri: 'https://login.infocamere.it/eacologin/authorize?response_type=id_token%20token&client_id=ic.foeg.fr&redirect_uri=https://commercioestero.camcom.it&scope=openid%20ic_utente%20ic_account%20ic_codfiscale%20ic_nome%20ic_cognome%20ic_profili%20ic_email%20ic_settore_attivita%20ic_n_pro_cntt%20ic_tipologia_mercato&state=d680290047f&nonce=36cb968f8ec',
        );

        $this->browser->submitForm('Accedi', [
            'userid' => $username,
            'password' => $password
        ]);

        $response = $this->browser->getCrawler()->filter('body')->text();

        if (str_contains($response, 'aperta')) {
            $this->browser->submitForm('Accedi', [
                'userid' => $username,
                'password' => $password
            ]);
        }

        if (str_contains($response, 'scadenza')) {
            $this->browser->clickLink('OK');    
        }

        if (str_contains($response, 'completa')) {
            throw new LoginException(
                message: $response,
                code: 'AU03',
            );
        }

        if (str_contains($response, 'scaduta')) {
            throw new LoginException(
                message: $response,
                code: 'AU04',
            );
        }
        
        if (str_contains($response, 'scadenza')) {
            $this->browser->clickLink('OK');
        }

        if (str_contains($response, 'abilitato')) {
            $this->logout();

            throw new LoginException(
                message: $response,
                code: 'AU08',
            );
        }

        if (str_contains($response, 'riuscita')) {
            throw new LoginException(
                message: $response,
                code: 'AU01',
            );
        }

        if (str_contains($response, 'nuova password')) {
            throw new LoginException(
                message: $response,
                code: 'AU09',
            );
        }

        $u = explode('#', $this->browser->getInternalRequest()->getUri());
        $c = explode('&', $u[1]);

        foreach($c as $t) {
            if (str_starts_with($t, 'access_token')) {
                $bearer = explode('=', $t)[1];

                $this->bearerToken = trim($bearer);
            }

            if (str_starts_with($t, 'id_token')) {
                $idtoken = explode('=', $t)[1];

                $this->idToken = trim($idtoken);
            }
        }

        $this->guzzleCookieJar = GuzzleHttpCookieJar::fromArray(
            cookies: $this->browser->getCookieJar()->all(),
            domain: 'https://commercioestero.camcom.it'
        );
    }

    public function logout(): string
    {
        $logoutResponse = $this->client->get(
            uri: 'https://login.infocamere.it/eacologin/logout.action?fw=false&cp=0',
            options: [
                'cookies' => $this->guzzleCookieJar,
            ]
        );

        return $logoutResponse->getBody();
    }

    /**
     * Elenco tipologie pratiche per Commercio Estero
     * 
     * @return array|string
     */
    public function tipoPratica(): array|string
    {
        return $this->callPrivateApi(
            method: 'get',
            uriPart: 'foegWeb/private/pratiche/tipologie',
        );
    }

    /**
     * Saldo Telemaco per utente
     * 
     * @return array|string
     */
    public function saldo(): array|string
    {
        return $this->callPrivateApi(
            method: 'get',
            uriPart: 'foegWeb/private/pagamenti/saldo',
        );
    }

    /**
     * Elenco Paesi
     * 
     * @return array|string
     */
    public function elencoPaesi(): array|string
    {
        return $this->callPrivateApi(
            method: 'get',
            uriPart: 'foegWeb/private/paesi',
        );
    }

    public function praticheInfo(): array
    {
        return $this->callPrivateApi(
            method: 'get',
            uriPart: 'foegWeb/private/pratiche/info',
        );
    }

    public function notificheCount(): array
    {
        return $this->callPrivateApi(
            method: 'get',
            uriPart: 'foegWeb/private/notifiche/count',
        );
    }

    /**
     * Elenco Camere di commercio
     * 
     * @param string $codicePratica
     * @return array|string
     */
    public function elencoCciaa(string $codicePratica = 'all'): array|string
    {
        $params = $codicePratica != 'all' ? '?codicePratica='.strtoupper($codicePratica) : '/'.$codicePratica;

        return $this->callPrivateApi(
            method: 'get',
            uriPart: 'foegWeb/private/cciaa'.$params,
        );
    }

    /**
     * Elenco sedi della Camera di commercio specificata
     * 
     * @param string $codiceEnte
     * @return array|string
     */
    public function elencoSedi(string $codiceEnte): array|string
    {
        return $this->callPrivateApi(
            method: 'get',
            uriPart: 'foegWeb/private/cciaa/sedi?codiceEnte='.strtoupper($codiceEnte),
        );
    }

    public function configurazioneSpecifica(): array|string
    {
        //https://commercioestero.camcom.it/foegWeb/private/utente/configurazioneSpecifica?tipologia=CO

        //https://commercioestero.camcom.it/foegWeb/private/utente/configurazioneSpecifica?tipologia=BDCO&codiceApplicazione=CDOR

        //https://commercioestero.camcom.it/foegWeb/private/configurazione?cciaa=ST&codiceFiscale=SMNMRC75T02G224Z&tipoPratica=CO
        return $this->callPrivateApi(
            method: 'get',
            uriPart: 'foegWeb/private/utente/configurazioneSpecifica?tipologia=AV&codiceApplicazione=CDOR',
        );    
    }

    /**
     * Elenco provincie italiane
     * 
     * @return array|string
     */
    public function province(): array|string
    {
        return $this->callPrivateApi(
            method: 'get',
            uriPart: 'assets/mocks/province-italiane.json',
        );
    }

    public function utente(bool $full = false): array|string
    {
        $uri = 'foegWeb/private/utente';
        
        if ($full) {
            $uri .= '/full';
        }
    
        return $this->callPrivateApi(
            method: 'get',
            uriPart: $uri,
        );
    }

    public function avvisi(): array|string
    {
        return $this->callPrivateApi(
            method: 'get',
            uriPart: 'foegWeb/private/avvisi?pageNumber=1&pageSize=5&cciaa=CC0001&ascending=false',
        );
    }

    /** 
     * Elenco dei tipi di file con codici per gli allegati alla pratica
     * 
     * @param string $codicePratica
     * @return array|string
     */
    public function tipiFileAllegati(string $codicePratica = 'co'): array|string
    {
        return $this->callPrivateApi(
            method: 'get',
            uriPart: 'foegWeb/private/file/tipi?codicePratica='.strtoupper($codicePratica),
        );
    }

    /**
     * Elenco degli speditori per utente collegato
     * 
     * @return array|string
     */
    public function speditori(): array|string
    {
        return $this->callPrivateApi(
            method: 'get',
            uriPart: 'foegWeb/private/speditori/new',
        );
    }

    public function spedizionieri(string $codiceFiscale): array|string
    {
        return $this->callPrivateApi(
            method: 'post',
            uriPart: '/foegWeb/private/spedizionieri/new',
            data: ['codiceFiscale' => $codiceFiscale],
        );
    }

    public function legaleRappresentante(array $datiLegaleRappresentante): array|string
    {
        return $this->callPrivateApi(
            method: 'post',
            uriPart: 'foegWeb/private/registroimprese/legaleRappresentante',
            data: $datiLegaleRappresentante,
        );
    }

    public function firmatari(): array|string
    {
        throw new \Exception('Not implemented');
    }

    /**
     * Dettgali pratica
     * 
     * @param string $codicePratica
     * @return array|string
     */
    public function dettagliPratica(string $codicePratica): array|string
    {
        return $this->callPrivateApi(
            method: 'get',
            uriPart: 'foegWeb/private/pratica/'.$codicePratica,
        );
    }

    /**
     * Inserisce una nuova pratica
     * 
     * @param array $datiPratica
     * @param string $tipoPratica
     * @return array|string
     * 
     * @throws \IBSWebCO\CommercioEstero\BrowserClient\Exceptions\BrowserClientException
     */
    public function inserisciPratica(array $datiPratica, string $tipoPratica = 'co'): array|string
    {
        return $this->callPrivateApi(
            method: 'post',
            uriPart: 'foegWeb/private/bozza?codicePratica='.strtoupper($tipoPratica),
            data: $datiPratica
        );
    }

    /**
     * Modifica i dati di una pratica
     * 
     * @param array $datiPratica
     * @param string $codicePratica
     * @param string $tipoPratica
     * 
     * @return array|string
     */
    public function modificaPratica(array $datiPratica, string $codicePratica, string $tipoPratica = 'co'): array|string
    {
        return $this->callPrivateApi(
            method: 'put',
            uriPart: 'foegWeb/private/bozza?codicePratica='.strtoupper($tipoPratica).'&idBozza='.$codicePratica,
            data: $datiPratica,
        );
    }

    public function inserisciAllegato(array $datiAllegato, string $codiceRichiesta, string $tipoDocumento, string $tipoPratica = 'co'): string|array
    {
        return $this->callPrivateApi(
            method: 'post',
            uriPart: 'foegWeb/private/file?tipoRichiesta='.strtoupper($tipoPratica).'&codiceRichiesta='.$codiceRichiesta.'&tipoDocumento='.$tipoDocumento,
            data: $datiAllegato,
        );
    }

    /**
     * Download della distinta (ex xml) della richiesta per firma digitale
     * 
     * @param string $codicePratica
     * 
     * @return array|string
     */
    public function downloadDistinta(string $codicePratica): array|string
    {
        return $this->callPrivateApi(
            method: 'get',
            uriPart: 'foegWeb/private/distinta?codiceRichiesta='.$codicePratica,
        );
    }

    /**
     * Invia una richiesta
     * 
     * @param string $method
     * @param string $uriPart
     * @param array $data
     * @param bool $debug
     * @return array|string
     * 
     * @throws \IBSWebCO\CommercioEstero\BrowserClient\Exceptions\BrowserClientException
     */
    private function callPrivateApi(string $method, string $uriPart, ?array $data = null): array|string
    {
        $k = array_rand($this->userAgents, 1);

        try {
            $response = $this->client->request(
                method: strtoupper($method),
                uri: $this->baseUrl . $uriPart,
                options: [
                    'headers' => [
                        'Accept' => 'application/json, text/plain, */*',
                        'Content-Type' => 'application/json; charset=UTF-8',
                        'User-Agent' => $this->userAgents[$k],
                        'Authorization' => "Bearer {$this->bearerToken}",
                        'idToken' => $this->idToken,
                    ],
                    'cookies' => $this->guzzleCookieJar,
                    //'json' => $data,
                    'body' => base64_encode(json_encode($data)),
                    'debug' => $this->debug,
                ],
            );

            if ($response->hasHeader('content-type') && str_contains($response->getHeader('content-type')[0], 'json')) {
                $ret = json_decode(
                    json: $response->getBody(),
                    associative: true,
                    flags: 0,
                );

                return $ret ?? (string) trim($response->getBody());
            }

            return (string) trim($response->getBody());
        }
        catch(\GuzzleHttp\Exception\RequestException $e) {
            $this->logout();

            throw new BrowserClientException(
                message: $e->getMessage(), 
                code: $e->getCode()
            );
        }
    }
}