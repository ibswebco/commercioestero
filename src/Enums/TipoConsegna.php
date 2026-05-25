<?php

namespace IBSWebCO\CommercioEstero\Enums;

enum TipoConsegna: string
{
    case SPORTELLO = 'COC_CONSEGNA_SPORTELLO';

    case DOMICLIO = 'COD_CONSEGNA_DOMICILIO';

    CASE STAMPA_AZIENDA = 'COD_STAMPA_AZIENDA';
}