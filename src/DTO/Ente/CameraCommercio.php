<?php

namespace IBSWebCO\CommercioEstero\DTO\Ente;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;

final class CameraCommercio implements DataObject
{
    public function __construct(
        public readonly string $cciaaMaster,
        public readonly string $codAooProt,
        public readonly string $codiceEnte,
        public readonly string $denominazione,
    )
    { }

    public function toArray(): array
    {
        return [
            'cciaaMaster' => $this->cciaaMaster,
            'codAooProt' => $this->codAooProt,
            'codiceEnte' => $this->codiceEnte,
            'denominazione' => $this->denominazione,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            cciaaMaster: $data['cciaaMaster'],
            codAooProt: $data['codiceAoo'],
            codiceEnte: $data['codiceEnte'],
            denominazione: $data['descrizione'],
        );
    }
}