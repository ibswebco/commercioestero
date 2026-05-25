<?php

namespace IBSWebCO\CommercioEstero;

use IBSWebCO\CommercioEstero\Enums\TipoPratica;

class CeClient
{
    protected string $version = '1.0.0';

    public function __construct(
        private CeClientAdapter $adapter,
    ) { }

    public function login(string $username, string $password)
    {
        return $this->adapter->login(
            username: $username,
            password: $password,
        );
    }

    public function logout(): string
    {
        return $this->logout();
    }

    public function tipoPratica(): array|string
    {
        return $this->adapter->tipoPratica();
    }

    public function tipiFileAllegati(string $tipoPratica): array|string
    {
        return $this->adapter->tipiFileAllegati(
            tipoPratica: $tipoPratica,
        );
    }

    public function saldo(): array|string
    {
        return $this->adapter->saldo();
    }

    public function elencoPaesi(): array|string
    {
        return $this->adapter->elencoPaesi();
    }

    public function elencoCciaa(string $tipoPratica): array|string
    {
        return $this->adapter->elencoCciaa(
            tipoPratica: $tipoPratica,
        );
    }

    public function elencoSedi(string $codiceEnte): array|string
    {
        return $this->adapter->elencoSedi(
            codiceEnte: $codiceEnte,
        );
    }

    public function inserisciPratica(array $datiPratica, TipoPratica $tipoPratica): array|string
    {
        return $this->adapter->inserisciPratica(
            datiPratica: $datiPratica,
            tipoPratica: $tipoPratica,
        );
    }

    public function modificaPratica(array $datiPratica, string $codicePratica, TipoPratica $tipoPratica): array|string
    {
        return $this->adapter->modificaPratica(
            datiPratica: $datiPratica,
            codicePratica: $codicePratica,
            tipoPratica: $tipoPratica,
        );
    }

    public function downloadDistinta(string $codicePratica): array|string
    {
        return $this->adapter->downloadDistinta(
            codicePratica: $codicePratica,
        );
    }

    public function utente(bool $full = false): array|string
    {
        return $this->adapter->utente(
            full: $full,
        );
    }
}