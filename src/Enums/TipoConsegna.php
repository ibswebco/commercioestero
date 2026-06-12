<?php

namespace IBSWebCO\CommercioEstero\Enums;

enum TipoConsegna: string
{
    case SPORTELLO = 'COD_CONSEGNA_SPORTELLO';

    case DOMICLIO = 'COD_CONSEGNA_DOMICILIO';

    case STAMPA_AZIENDA = 'COD_STAMPA_AZIENDA';
}
