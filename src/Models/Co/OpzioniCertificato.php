<?php

namespace IBSWebCO\CommercioEstero\Models\Co;

use IBSWebCO\CommercioEstero\Enums\TipoConsegna;
use IBSWebCO\CommercioEstero\Enums\TipoSupporto;

class OpzioniCertificato
{
    public int $copie = 1;

    public int $autentiche = 0;

    public bool $legalizzazioneCertificato = false;

    public bool $proforma = false;

    public bool $urgente = false;

    public TipoSupporto $tipoSupporto = TipoSupporto::FOGLIO_BIANCO;

    public TipoConsegna $tipoConsegna = TipoConsegna::STAMPA_AZIENDA;
}
