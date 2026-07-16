<?php

namespace IBSWebCO\CommercioEstero\Models;

use IBSWebCO\CommercioEstero\Enums\TipoConsegna;
use IBSWebCO\CommercioEstero\Enums\TipoPagamento;
use IBSWebCO\CommercioEstero\Enums\TipoSupporto;

/**
 * @property array $certificati
 * @property array $certificazioniAllegati
 * @property string $consegnaDomicilio
 * @property string $consegnaSportello
 * @property string $consegnaStampaAzienda
 * @property string $note
 * @property array $delega
 * @property TipoConsegna $tipoConsegna
 * @property TipoPagamento $tipoPagamento
 * @property TipoSupporto $tipoSupporto
 * @property bool $urgente
 */
class PraticaVa extends PraticaBase
{
    public array $certificati;

    public array $certificazioniAllegati = [];

    public ?string $consegnaDomicilio = null;

    public ?string $consegnaSportello = null;

    public ?string $consegnaStampaAzienda = null;

    public string $note = "";

    public array $delega;

    public TipoConsegna $tipoConsegna = TipoConsegna::STAMPA_AZIENDA;

    public TipoPagamento $tipoPagamento = TipoPagamento::TELEMACO;

    public TipoSupporto $tipoSupporto = TipoSupporto::FOGLIO_BIANCO;

    public bool $urgente = false;
}
