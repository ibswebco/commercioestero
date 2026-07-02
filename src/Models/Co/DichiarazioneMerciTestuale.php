<?php

namespace IBSWebCO\CommercioEstero\Models\Co;

use IBSWebCO\CommercioEstero\Traits\Serializable;

class DichiarazioneMerciTestuale
{
    use Serializable;

    public string $denominazione;

    public string $quantita;
}
