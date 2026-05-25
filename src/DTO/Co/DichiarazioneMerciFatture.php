<?php

namespace IBSWebCO\CommercioEstero\DTO\Co;

final class DichiarazioneMerciFatture
{
    public function __construct(
        public readonly ?string $denominazione,
        public readonly ?string $quantita,
    )
    { }

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
}