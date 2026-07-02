<?php

namespace IBSWebCO\CommercioEstero\Models\Co;

use IBSWebCO\CommercioEstero\Models\Stato;

class Spedizioniere
{
    public Stato $stato;

    public function __construct()
    {
        $this->stato = new Stato();
    }
}
