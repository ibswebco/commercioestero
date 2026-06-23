<?php

namespace IBSWebCO\CommercioEstero\DTO\Co;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;

final readonly class Paese implements DataObject
{
    public function __construct(
        public string $codice,
        public string $denominazione,
        public string $denominazioneCo,
    ) {}

    public function toArray(): array
    {
        return [
            "codice" => $this->codice,
            "denominazione" => $this->denominazione,
            "denominazioneCo" => $this->denominazioneCo,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            codice: $data["codice"],
            denominazione: $data["denominazione"],
            denominazioneCo: $data["denominazioneCo"] ?? $data["denominazione"],
        );
    }
}
