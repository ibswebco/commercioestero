<?php

namespace IBSWebCO\CommercioEstero\Models\Co;

use IBSWebCO\CommercioEstero\Models\Stato;
use IBSWebCO\CommercioEstero\Traits\Serializable;

class DestinatarioNoto
{
    use Serializable;

    public string $denominazione;

    public string $indirizzo;

    public Stato $stato;
}
