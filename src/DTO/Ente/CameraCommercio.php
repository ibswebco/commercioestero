<?php

namespace IBSWebCO\CommercioEstero\DTO\Ente;

final class CameraCommercio
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
}