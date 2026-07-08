<?php

namespace IBSWebCO\CommercioEstero\Enums;

enum StatoPratica: string
{
    case IN_COMPILAZIONE = "BOZZA_COMPILAZIONE";

    case RETTIFICA_RICHIESTA = "BOZZA_RETTIFICA";

    case INVIATA = "INVIATA";

    case RILASCIATA = "EVASA";

    case DA_ISTRUIRE = "DISPONIBILE_PER_ISTRUTTORIA";

    case IN_LAVORAZIONE = "INLAVORAZIONE";

    case RESPINTA = "RESPINTA";
}
