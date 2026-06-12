<?php

namespace IBSWebCO\CommercioEstero\DTO;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;
use IBSWebCO\CommercioEstero\Enums\SoggettoFirmatario;

final class Firmatario implements DataObject
{
    public function __construct(
        public readonly bool $checkRuolo,
        public readonly string $codiceFiscale,
        public readonly string $cognome,
        public readonly ?array $documentoCarica,
        public readonly bool $enabled,
        public readonly string $nome,
        public readonly bool $registroImprese,
        public readonly ?string $ruolo,
        public readonly ?string $tipoFirmatario,
        public readonly bool $validate,
    ) {}

    public function toArray(): array
    {
        return [
            'checkRuolo' => $this->checkRuolo,
            'codiceFiscale' => $this->codiceFiscale,
            'cognome' => $this->cognome,
            'documentoCarica' => $this->documentoCarica ?? ['firmato' => false],
            'enabled' => $this->enabled,
            'nome' => $this->nome,
            'registroImporese' => $this->registroImprese,
            'ruolo' => $this->ruolo ?? '',
            'tipoFirmatario' => $this->tipoFirmatario ?? '',
            'validate' => $this->validate,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            checkRuolo: $data['checkRuolo'] ?? false,
            codiceFiscale: $data['codiceFiscale'] ?? '',
            cognome: $data['cognome'] ?? '',
            documentoCarica: $data['documentoCarica'] ?? null,
            enabled: $data['enabled'] ?? false,
            nome: $data['nome'] ?? '',
            registroImprese: $data['registroImprese'] ?? false,
            ruolo: $data['ruolo'] ?? '',
            tipoFirmatario: $data['tipoFirmatario'] ?? SoggettoFirmatario::SOGGETTO_FIRMATARIO,
            validate: $data['validate'] ?? false,
        );
    }
}
