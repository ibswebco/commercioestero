<?php

namespace IBSWebCO\CommercioEstero;

use IBSWebCO\CommercioEstero\Enums\TipoPratica;
use IBSWebCO\CommercioEstero\BrowserClient\Exceptions\LoginException;

class CeClient
{
    protected string $version = "1.0.3";

    public function __construct(private CeClientAdapter $adapter) {}

    public function versione()
    {
        return "v{$this->version}";
    }

    /**
     * Login al portale Commercio Estero.
     *
     * @throws LoginException
     */
    public function login(string $username, string $password): void
    {
        $this->adapter->login(username: $username, password: $password);
    }

    public function logout(): void
    {
        $this->adapter->logout();
    }

    /**
     * Elenco tipologie pratiche per Commercio Estero.
     */
    public function tipoPratica(): array|string
    {
        return $this->adapter->tipoPratica();
    }

    public function tipiFileAllegati(string $codicePratica): array|string
    {
        return $this->adapter->tipiFileAllegati(codicePratica: $codicePratica);
    }

    /**
     * Saldo Telemaco per utente.
     */
    public function saldo(): array|string
    {
        return $this->adapter->saldo();
    }

    /**
     * Elenco Paesi.
     */
    public function elencoPaesi(): array|string
    {
        return $this->adapter->elencoPaesi();
    }

    /**
     * Elenco Camere di commercio.
     *
     * @param string $codicePratica tipologia pratica (CO, VA)
     */
    public function elencoCciaa(string $codicePratica): array|string
    {
        return $this->adapter->elencoCciaa(codicePratica: $codicePratica);
    }

    /**
     * Elenco Sedi.
     *
     * @param string $codiceEnte
     */
    public function elencoSedi(string $codiceEnte): array|string
    {
        return $this->adapter->elencoSedi(codiceEnte: $codiceEnte);
    }

    /**
     * Elenco degli speditori per utente collegato.
     */
    public function speditori(): array|string
    {
        return $this->adapter->speditori();
    }

    public function legaleRappresentante(array $datiLegaleRappresentante)
    {
        return $this->adapter->legaleRappresentante(
            datiLegaleRappresentante: $datiLegaleRappresentante,
        );
    }

    public function firmatari()
    {
        return $this->adapter->firmatari();
    }

    /**
     * Dettgali pratica.
     *
     * @param string $codicePratica
     */
    public function dettagliPratica(string $codicePratica): array|string
    {
        return $this->adapter->dettagliPratica(codicePratica: $codicePratica);
    }

    public function inserisciPratica(
        array $datiPratica,
        string $tipoPratica,
    ): array|string {
        return $this->adapter->inserisciPratica(
            datiPratica: $datiPratica,
            tipoPratica: $tipoPratica,
        );
    }

    public function modificaPratica(
        array $datiPratica,
        string $codicePratica,
        string $tipoPratica,
    ): array|string {
        return $this->adapter->modificaPratica(
            datiPratica: $datiPratica,
            codicePratica: $codicePratica,
            tipoPratica: $tipoPratica,
        );
    }

    public function inserisciAllegato(
        array $datiAllegato,
        string $codiceRichiesta,
        int $tipoDocumento,
        string $tipoPratica = "co",
    ): array|string {
        return $this->adapter->inserisciAllegato(
            datiAllegato: $datiAllegato,
            codiceRichiesta: $codiceRichiesta,
            tipoDocumento: $tipoDocumento,
            tipoPratica: $tipoPratica,
        );
    }

    public function downloadDistinta(string $codicePratica): array|string
    {
        return $this->adapter->downloadDistinta(codicePratica: $codicePratica);
    }

    public function inviaPratica(
        string $codicePratica,
        TipoPratica $tipoPratica,
    ): string|array {
        return $this->adapter->inviaPratica(
            codicePratica: $codicePratica,
            tipoPratica: $tipoPratica,
        );
    }

    public function firmaOffline(
        string $codicePratica,
        string $codiceFiscaleFirmatario,
        array $riepilogo,
    ): array|string {
        return $this->adapter->firmaOffline(
            codicePratica: $codicePratica,
            codiceFiscaleFirmatario: $codiceFiscaleFirmatario,
            riepilogo: $riepilogo,
        );
    }

    public function utente(bool $full = false): array|string
    {
        return $this->adapter->utente(full: $full);
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
        return $this->adapter->pratiche(
            archiviate: $archiviate,
            label: $label,
            pageNumber: $pageNumber,
            pageSize: $pageSize,
            query: $query,
            tipologiaRichiesta: $tipologiaRichiesta,
            viewAllPratiche: $viewAllPratiche,
        );
    }
}
