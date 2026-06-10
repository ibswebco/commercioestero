<?php

namespace IBSWebCO\CommercioEstero\DTO\Ente;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;

final class Sede implements DataObject
{
    public function __construct(
        public readonly string $descrizione,
        public readonly string $progressivo,
    )    
    { }

    public function toArray(): array 
    {
        return [
            'descrizione' => $this->descrizione,
            'progressivo' => $this->progressivo,
        ];    
    }

    public static function fromArray(array $data): self
    {
        return new self(
            descrizione: $data['descrizione'],
            progressivo: $data['progressivo'],
        );
    }
}