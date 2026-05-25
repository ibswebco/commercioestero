<?php

namespace IBSWebCO\CommercioEstero;

use IBSWebCO\CommercioEstero\Enums\TipoPratica;

interface CeClientAdapter
{
    public function login(string $username, string $password);

    public function logout();

    public function tipoPratica();

    public function tipiFileAllegati(string $tipoPratica);

    public function saldo();

    public function elencoPaesi();

    public function elencoCciaa(string $tipoPratica);

    public function elencoSedi(string $codiceEnte);

    public function province();

    public function inserisciPratica(array $datiPratica, TipoPratica $tipoPratica = TipoPratica::CO);

    public function modificaPratica(array $datiPratica, string $codicePratica, TipoPratica $tipoPratica = TipoPratica::CO);

    public function utente(bool $full = false);

    public function downloadDistinta(string $codicePratica);
}