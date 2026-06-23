<?php

namespace IBSWebCO\CommercioEstero\DTO\Co\Origine;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;
use Override;

final readonly class Impresa implements DataObject
{
    public function __construct(?string $denominazione, ?string $indirizzo) {}

    #[Override]
    public function toArray(): array
    {
        return [
            "denominazione" => $this->denominazione ?? "",
            "indirizzo" => $this->indirizzo ?? "",
        ];
    }

    #[Override]
    public static function fromArray(array $data): DataObject
    {
        throw new \Exception("Not implemented");
    }
}
