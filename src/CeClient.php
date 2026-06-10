<?php

namespace IBSWebCO\CommercioEstero;

use IBSWebCO\CommercioEstero\Enums\TipoPratica;

class CeClient
{
    protected string $version = "1.0.1";

    public function __construct(private CeClientAdapter $adapter) {}

    public function versione()
    {
        return "v{$this->version}";
    }

    public function login(string $username, string $password): void
    {
        $this->adapter->login(username: $username, password: $password);
    }

    public function logout(): string
    {
        return $this->adapter->logout();
    }

    public function tipoPratica(): array|string
    {
        return $this->adapter->tipoPratica();
    }

    public function tipiFileAllegati(string $tipoPratica): array|string
    {
        return $this->adapter->tipiFileAllegati(tipoPratica: $tipoPratica);
    }

    public function saldo(): array|string
    {
        return $this->adapter->saldo();
    }

    public function elencoPaesi(): array|string
    {
        return $this->adapter->elencoPaesi();
    }

    public function elencoCciaa(string $codicePratica): array|string
    {
        return $this->adapter->elencoCciaa(codicePratica: $codicePratica);
    }

    public function elencoSedi(string $codiceEnte): array|string
    {
        return $this->adapter->elencoSedi(codiceEnte: $codiceEnte);
    }

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

    public function downloadDistinta(string $codicePratica): array|string
    {
        return $this->adapter->downloadDistinta(codicePratica: $codicePratica);
    }

    public function utente(bool $full = false): array|string
    {
        return $this->adapter->utente(full: $full);
    }
}
