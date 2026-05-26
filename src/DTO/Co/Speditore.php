<?php

namespace IBSWebCO\CommercioEstero\DTO\Co;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;

final class Speditore implements DataObject
{
    public function __construct(
        public readonly ?array $delega,
        public readonly ?array $esporatore,
        public readonly string $ruolo,
        public readonly ?array $spedizioniere,
    ) 
    { }
    
    public function toArray(): array
    {
        return [
            'delega' => $this->delega ?? new \stdClass(),
            'esportatore' => $this->esporatore ?? [],
            'ruolo' => strtoupper($this->ruolo),
            'spedizioniere' => $this->spedizioniere ?? new \stdClass(),
        ];
    }
}