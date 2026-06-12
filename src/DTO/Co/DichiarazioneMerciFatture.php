<?php

namespace IBSWebCO\CommercioEstero\DTO\Co;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;

final class DichiarazioneMerciFatture implements DataObject
{
    public function __construct(
        public readonly ?string $denominazione,
        public readonly ?string $quantita,
    ) {}

    public function toArray(): array
    {
        return $this->denominazione ? [
            'dichiarazioneTestuale' => [
                'denominazione' => $this->denominazione,
                'quantita' => $this->quantita,
            ],
            'tipologia' => 'DESCRIZIONE_TESTUALE',
        ] : [
            'tipologia' => '',
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            denominazione: $data['denominazione'] ?? null,
            quantita: $data['quantita'] ?? null,
        );
    }
}
