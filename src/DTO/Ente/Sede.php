<?php

namespace IBSWebCO\CommercioEstero\DTO\Ente;

final class Sede
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
}