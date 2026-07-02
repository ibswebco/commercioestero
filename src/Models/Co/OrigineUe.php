<?php

namespace IBSWebCO\CommercioEstero\Models\Co;

class OrigineUe
{
    public array $fabbricateProdotte;

    public array $trasformateLavorate;

    public array $dichiarazioneUnicaUe = ["firmato" => false];

    public function __construct()
    {
        $this->fabbricateProdotte = [];

        $this->trasformateLavorate = [];
    }
}
