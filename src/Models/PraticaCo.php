<?php

namespace IBSWebCO\CommercioEstero\Models;

use IBSWebCO\CommercioEstero\Enums\TipoPagamento;
use IBSWebCO\CommercioEstero\Models\Co\OrigineUe;
use IBSWebCO\CommercioEstero\Models\Co\Destinatario;
use IBSWebCO\CommercioEstero\Models\Co\DichiarazioneMerciFatture;
use IBSWebCO\CommercioEstero\Models\Co\Fattura;
use IBSWebCO\CommercioEstero\Models\Co\OpzioniCertificato;
use IBSWebCO\CommercioEstero\Models\Co\OrigineExtraUe;
use IBSWebCO\CommercioEstero\Models\Co\Speditore;

/**
 * @property array $certificazioniAllegati
 * @property Speditore $speditore
 * @property Destinatario $destinatario
 * @property OrigineUe $origineUe
 * @property OrigineExtraUe $origineEstraUe
 * @property string $trasporto
 * @property string $valuta
 * @property array<int, Fattura> $fatture
 * @property float $fatturatoTotale
 * @property float $importoRichiesta
 * @property DichiarazioneMerciFatture $dichiarazioneMerciFatture
 * @property string $osservazioni
 * @property string $giacenzaMerci
 * @property string $note
 * @property bool $evasioneAutomatica
 * @property OpzioniCertificato $opzioniCertificato
 * @property TipoPagamento $tipoPagamento
 */
class PraticaCo extends PraticaBase
{
    public array $certificazioniAllegati = [];

    public Speditore $speditore;

    public Destinatario $destinatario;

    public OrigineUe $origineUe;

    public OrigineExtraUe $origineExtraUe;

    public string $trasporto = "";

    public string $valuta = "EUR";

    public array $fatture = [];

    public float $fatturatoTotale = 0;

    public float $importoRichiesta = 0;

    public DichiarazioneMerciFatture $dichiarazioneMerciFatture;

    public string $osservazioni = "";

    public string $giacenzaMerci = "";

    public string $note = "";

    //public bool $selezionaFirmatario = false;

    public bool $evasioneAutomatica = false;

    public OpzioniCertificato $opzioniCertificato;

    public TipoPagamento $tipoPagamento = TipoPagamento::TELEMACO;
}
