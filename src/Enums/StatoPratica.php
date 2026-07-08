<?php

namespace IBSWebCO\CommercioEstero\Enums;

enum StatoPratica: string
{
    case BOZZA = "BOZZA_COMPILAZIONE";

    case TRASMESSA = "DISPONIBILE_PER_ISTRUTTORIA";
}
