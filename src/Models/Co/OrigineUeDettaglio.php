<?php

namespace IBSWebCO\CommercioEstero\Models\Co;

use IBSWebCO\CommercioEstero\Enums\TipoOrigine;
use IBSWebCO\CommercioEstero\Models\Stato;

class OrigineUeDettaglio
{
    public Stato $paese;

    public array $imprese;

    public TipoOrigine $tipoOrigine;
}
