<?php

namespace IBSWebCO\CommercioEstero\Models;

use IBSWebCO\CommercioEstero\Traits\Serializable;

/**
 * @property string $descrizioneTipoDocumento
 * @property string $nome
 * @property string $mimeType
 * @property string $codiceTipoDocumento
 * @property string $hash
 * @property string $idGedoc
 * @property string $idGedocOriginale
 * @property array $firmatari
 */
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
