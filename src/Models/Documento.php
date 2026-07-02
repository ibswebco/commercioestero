<?php

namespace IBSWebCO\CommercioEstero\Models;

use IBSWebCO\CommercioEstero\Traits\Serializable;

class Documento
{
    use Serializable;

    public string $descrizioneTipoDocumento = "";

    public string $nome;

    public string $mimeType;

    public string $codiceTipoDocumento;

    public string $hash;

    public string $idGedoc;

    public string $idGedocOriginale;

    public array $firmatari = [];
}
