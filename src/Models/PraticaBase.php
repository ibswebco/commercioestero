<?php

namespace IBSWebCO\CommercioEstero\Models;

use IBSWebCO\CommercioEstero\Traits\Serializable;

abstract class PraticaBase
{
    use Serializable;

    public string $linguaDocumentoSintesi = "it";

    public string $linguaPortale = "it";

    public Ente $ente;

    public Sede $sede;

    public Firmatario $firmatario;

    public SoggettoRichiedente $soggettoRichiedente;

    public UtenteRichiedente $utenteRichiedente;
}
