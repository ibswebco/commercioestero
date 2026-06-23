<?php

namespace IBSWebCO\CommercioEstero\Enums;

enum TipoPagamento: string
{
    case TELEMACO = "COD_PAGAMENTO_TELEMACO";

    case PAGOPA = "COD_PAGAMENTO_PAGOPA";

    case CONSEGNA = "COD_PAGAMENTO_CONSEGNA";
}
