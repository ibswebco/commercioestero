<?php

namespace IBSWebCO\CommercioEstero\Models;

use IBSWebCO\CommercioEstero\Enums\TipoPagamento;
use IBSWebCO\CommercioEstero\Traits\Serializable;

abstract class PraticaBase
{
    use Serializable;

    public array $certificazioniAllegati = [];

    public Ente $ente;

    public Sede $sede;

    public Firmatario $firmatario;

    public string $note = "";

    public SoggettoRichiedente $soggettoRichiedente;

    public TipoPagamento $tipoPagamento = TipoPagamento::TELEMACO;

    public UtenteRichiedente $utenteRichiedente;
}
