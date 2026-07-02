<?php

namespace IBSWebCO\CommercioEstero\Models;

use IBSWebCO\CommercioEstero\Enums\Ruolo;
use IBSWebCO\CommercioEstero\Enums\SoggettoFirmatario;

class Firmatario
{
    public bool $checkRuolo;

    public string $codiceFiscale;

    public string $cognome;

    public array $documentoCarica;

    public bool $enabled;

    public string $nome;

    public bool $registroImprese;

    public Ruolo $ruolo;

    public SoggettoFirmatario $tipoFirmatario;

    public bool $validate;

    public function __construct()
    {
        $this->documentoCarica = ["firmato" => false];
    }
}
