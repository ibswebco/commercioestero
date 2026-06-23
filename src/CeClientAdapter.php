<?php

namespace IBSWebCO\CommercioEstero;

interface CeClientAdapter
{
    public function login(string $username, string $password): void;

    public function logout(): string;

    public function tipoPratica(): array|string;

    public function tipiFileAllegati(string $codicePratica);

    public function saldo(): array|string;

    public function elencoPaesi(): array|string;

    public function elencoCciaa(string $codicePratica): array|string;

    public function elencoSedi(string $codiceEnte): array|string;

    public function province(): array|string;

    public function speditori(): array|string;

    public function firmatari(): array|string;

    public function legaleRappresentante(
        array $datiLegaleRappresentante,
    ): array|string;

    public function inserisciPratica(
        array $datiPratica,
        string $tipoPratica = "co",
    ): array|string;

    public function modificaPratica(
        array $datiPratica,
        string $codicePratica,
        string $tipoPratica = "co",
    ): array|string;

    public function dettagliPratica(string $codicePratica): array|string;

    public function inserisciAllegato(
        array $datiAllegato,
        string $codiceRichiesta,
        int $tipoDocumento,
        string $tipoPratica = "co",
    ): array|string;

    public function utente(bool $full = false): array|string;

    public function downloadDistinta(string $codicePratica): array|string;
}
