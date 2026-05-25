<?php

namespace IBSWebCO\CommercioEstero\DTO;

use IBSWebCO\CommercioEstero\Enums\Firmatario\Ruolo;

final class SoggettoRichiedente
{
    public function __construct(
        public readonly string $cap,
        public readonly string $codiceFiscale,
        public readonly string $comune,
        public readonly string $denominazione,
        public readonly string $indirizzo,
        public readonly string $numeroRea,
        public readonly ?string $partitaIva,
        public readonly string $provincia, 
        public readonly bool $registroImprese,
        public readonly string $registroImpreseSiglaProvincia,
        public readonly Ruolo $ruolo,
        public readonly string $sedeLegale,
    )
    { }

    public function toArray(): array
    {
        return [
            //'cap' => $this->cap,
            'codiceFiscale' => strtoupper($this->codiceFiscale),
            //'coumne' => strtoupper($this->comune),
            'denominazione' => $this->denominazione,
            //'impresaEstera' => false,
            'indirizzo' => $this->indirizzo,
            'numeroRea' => $this->numeroRea,
            'partitaIva' => $this->partitaIva ?? '',
            //'provincia' => strtoupper($this->provincia),
            'registroImprese' => $this->registroImprese,
            'registroImpreseSiglaProvincia' => $this->registroImpreseSiglaProvincia,
            'ruolo' => $this->ruolo,
            //'sedeLegale' => $this->sedeLegale,
            'stato' => [
                'denominazione' => '',
            ]
        ];
    }
}