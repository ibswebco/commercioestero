<?php

namespace IBSWebCO\CommercioEstero\Models;

use IBSWebCO\CommercioEstero\Traits\Serializable;
use stdClass;

/**
 * @property Documento $documento
 * @property int $attestatiLiberaVendita
 * @property int $legalizzazioniFirme
 * @property int $vistoDeposito
 * @property int $vistoPoteriFirmaFattura
 * @property int $vistoPoteriFirmaDichImpresa
 * @property object $vistoDepositoInfo
 * @property object $vistoPoteriFirmaInfo
 * @property object $vistoPoteriFirmaFatturaInfo
 */
class CertificazioniAllegato
{
    use Serializable;

    public Documento $documento;

    public int $attestatiLiberaVendita = 0;

    public int $legalizzazioniFirme = 0;

    public int $vistoDeposito = 0;

    public int $vistoPoteriFirmaFattura = 0;

    public int $vistoPoteriFirmaDichImpresa = 0;

    public stdClass $vistoDepositoInfo;

    public stdClass $vistoPoteriFirmaInfo;

    public stdClass $vistoPoteriFirmaFatturaInfo;

    public function __construct()
    {
        $this->vistoDepositoInfo = new stdClass();

        $this->vistoPoteriFirmaInfo = new stdClass();

        $this->vistoPoteriFirmaFatturaInfo = new stdClass();
    }
}
