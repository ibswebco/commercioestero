<?php

namespace IBSWebCO\CommercioEstero\DTO\Co;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;
use IBSWebCO\CommercioEstero\DTO\Documento;
use Override;

final class Fattura implements DataObject
{
    public function __construct(
        public readonly string $dataFattura,
        public readonly Documento $documento,
        public readonly float $importo,
        public readonly string $numeroFattura,
    ) {}

    #[Override]
    public function toArray(): array
    {
        return [
            "dataFattura" => $this->dataFattura,
            "documento" => $this->documento->toArray(),
            "importo" => $this->importo,
            "numeroFattura" => $this->numeroFattura,
        ];
    }

    #[Override]
    public static function fromArray(array $data): DataObject
    {
        return new self(
            dataFattura: $data["dataFattura"],
            documento: $data["documento"],
            importo: $data["importo"],
            numeroFattura: $data["numeroFattura"],
        );
    }
}
