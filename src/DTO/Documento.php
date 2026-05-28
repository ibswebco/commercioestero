<?php

namespace IBSWebCO\CommercioEstero\DTO;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;

final class Documento implements DataObject
{
    public function __construct(
        public readonly string $codiceTipoDocumento,
        public readonly ?string $descrizioneTipoDocumento,
        public readonly ?array $firmatari,
        public readonly string $hash,
        public readonly string $idGedoc,
        public readonly string $idGedocOriginale,
        public readonly string $mimeType,
        public readonly string $nome,
    )
    { }

    public function toArray(): array 
    {
        return [
            'codiceTipoDocumento' => $this->codiceTipoDocumento,
            'descrizioneTipoDocumento' => $this->descrizioneTipoDocumento ?? '',
            'firmatari' => $this->firmatari ?? [],
            'hash' => $this->hash,
            'idGedoc' => $this->idGedoc,
            'idGedocOriginale' => $this->idGedocOriginale,
            'mimeType' => $this->mimeType,
            'nome' => $this->nome,
        ];    
    }

    public static function fromArray(array $data): self
    {
        return new self(
            codiceTipoDocumento: $data['codiceTipoDocumento'],
            descrizioneTipoDocumento: $data['descrizioneTipoDocumento'],
            firmatari: $datya['firmatari'] ?? null,
            hash: $data['hash'],
            idGedoc: $data['idGedoc'],
            idGedocOriginale: $data['idGedocOriginale'],
            mimeType: $data['miteType'],
            nome: $data['nome'],
        );
    }
}