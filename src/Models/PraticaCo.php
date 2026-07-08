<?php

namespace IBSWebCO\CommercioEstero\Models;

use IBSWebCO\CommercioEstero\Enums\TipoPagamento;
use IBSWebCO\CommercioEstero\Models\Co\OrigineUe;
use IBSWebCO\CommercioEstero\Models\Co\Destinatario;
use IBSWebCO\CommercioEstero\Models\Co\DichiarazioneMerciFatture;
use IBSWebCO\CommercioEstero\Models\Co\OpzioniCertificato;
use IBSWebCO\CommercioEstero\Models\Co\OrigineExtraUe;
use IBSWebCO\CommercioEstero\Models\Co\Speditore;

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
