<?php

namespace IBSWebCO\CommercioEstero\DTO;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;

final readonly class Documento implements DataObject
{
    public function __construct(
        public string $codiceTipoDocumento,
        public ?string $descrizioneTipoDocumento,
        public ?array $firmatari,
        public string $hash,
        public string $idGedoc,
        public string $idGedocOriginale,
        public string $mimeType,
        public string $nome,
    ) {}

    public function toArray(): array
    {
        return [
            "codiceTipoDocumento" => $this->codiceTipoDocumento,
            "descrizioneTipoDocumento" => $this->descrizioneTipoDocumento ?? "",
            "firmatari" => $this->firmatari ?? [],
            "hash" => $this->hash,
            "idGedoc" => $this->idGedoc,
            "idGedocOriginale" => $this->idGedocOriginale,
            "mimeType" => $this->mimeType,
            "nome" => $this->nome,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            codiceTipoDocumento: $data["codiceTipoDocumento"],
            descrizioneTipoDocumento: $data["nomeTipoDocumento"],
            firmatari: $data["firmatari"] ?? null,
            hash: $data["codiceHashFile"],
            idGedoc: $data["idDocumento"],
            idGedocOriginale: $data["idDocumento"],
            mimeType: $data["mimeType"],
            nome: $data["nomeDocumento"],
        );
    }
}
