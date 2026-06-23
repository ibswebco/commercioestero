<?php
namespace IBSWebCO\CommercioEstero\Enums;

enum TipoOrigine: string
{
    case FABBRICATE = "fabbricate";

    case PRODOTTE = "prodotte";

    case FABBRICATE_PRODOTTE = "fabbricate e prodotte";

    case LAVORATE = "lavorate";

    case TRASFORMATE = "trasformate";

    case LAVORATE_TRASFORMATE = "lavorate e trasformate";
}
