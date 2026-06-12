<?php

namespace IBSWebCO\CommercioEstero\DTO;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;
use IBSWebCO\CommercioEstero\Enums\Ruolo;

final class SoggettoRichiedente implements DataObject
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
        public readonly ?Ruolo $ruolo,
        public readonly string $sedeLegale,
    ) {}

    public function toArray(): array
    {
        return [
            // 'cap' => $this->cap,
            'codiceFiscale' => $this->codiceFiscale,
            // 'coumne' => strtoupper($this->comune),
            'denominazione' => $this->denominazione,
            // 'impresaEstera' => false,
            'indirizzo' => $this->indirizzo,
            'numeroRea' => $this->numeroRea,
            'partitaIva' => $this->partitaIva ?? '',
            // 'provincia' => strtoupper($this->provincia),
            'registroImprese' => $this->registroImprese,
            'registroImpreseSiglaProvincia' => $this->registroImpreseSiglaProvincia,
            'ruolo' => $this->ruolo,
            // 'sedeLegale' => $this->sedeLegale,
            'stato' => [
                'denominazione' => '',
            ],
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            cap: $data['cap'] ?? '',
            codiceFiscale: $data['codiceFiscale'] ?? '',
            comune: $data['comune'] ?? '',
            denominazione: $data['denominazione'] ?? '',
            indirizzo: $data['indirizzo'] ?? '',
            numeroRea: $data['numeroRea'] ?? '',
            partitaIva: $data['partitaIva'] ?? '',
            provincia: $data['provincia'] ?? '',
            registroImprese: $data['registroImprese'] ?? false,
            registroImpreseSiglaProvincia: $data[
                'registroImpreseSiglaProvincia'
            ] ?? '',
            ruolo: is_null($data['ruolo'])
                ? Ruolo::PERSONA_FISICA
                : Ruolo::from($data['ruolo']),
            sedeLegale: $data['sedeLegale'] ?? '',
        );
    }
}
