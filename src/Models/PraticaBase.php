<?php

namespace IBSWebCO\CommercioEstero\Models;

use IBSWebCO\CommercioEstero\Traits\Serializable;

/**
 * @property string $linguaDocumentoSintesi
 * @property string $linguaPortale
 * @property Ente $ente
 * @property Sede $sede
 * @property Firmatario $firmatario
 * @property SoggettoRichiedente $soggettoRichiedente
 * @property UtenteRichiedente $utenteRichiedente
 */
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
