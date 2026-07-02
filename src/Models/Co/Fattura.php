<?php

namespace IBSWebCO\CommercioEstero\Models\Co;

use DateTimeImmutable;
use IBSWebCO\CommercioEstero\Models\Documento;
use IBSWebCO\CommercioEstero\Traits\Serializable;

class Fattura
{
    use Serializable;

    public Documento $documento;

    public string $numeroFattura;

    public string $dataFattura;

    public float $importo;
}
