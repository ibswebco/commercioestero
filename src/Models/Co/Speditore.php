<?php

namespace IBSWebCO\CommercioEstero\Models\Co;

use stdClass;

class Speditore
{
    public string $ruolo = "E";

    public Esportatore $esportatore;

    public Spedizioniere $spedizioniere;

    public array|stdClass $delega;

    public function __construct()
    {
        $this->esportatore = new Esportatore();

        $this->spedizioniere = new Spedizioniere();

        $this->delega = new stdClass();
    }
}
