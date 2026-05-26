<?php

namespace IBSWebCO\CommercioEstero;

interface CeClientAdapter
{
    public function login(string $username, string $password): void;

    public function logout(): string;

    public function tipoPratica();

    public function tipiFileAllegati(string $tipoPratica);

    public function saldo();

    public function elencoPaesi();

    public function elencoCciaa(string $tipoPratica);

    public function elencoSedi(string $codiceEnte);

    public function province();

    public function speditori();

    public function firmatari();

    public function inserisciPratica(array $datiPratica, string $tipoPratica = 'co');

    public function modificaPratica(array $datiPratica, string $codicePratica, string $tipoPratica = 'co');

    public function utente(bool $full = false);

    public function downloadDistinta(string $codicePratica);
}