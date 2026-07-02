<?php

namespace IBSWebCO\CommercioEstero\Models\Co;

class OrigineExtraUe
{
    public array $certificazioniExtraUe;

    public array $dichiarazioneUnicaExtraUe;

    public function __construct()
    {
        $this->certificazioniExtraUe = [];

        $this->dichiarazioneUnicaExtraUe = ["firmato" => false];
    }
}
