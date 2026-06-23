<?php

namespace IBSWebCO\CommercioEstero\DTO\Co;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;
use IBSWebCO\CommercioEstero\Enums\TipoConsegna;
use IBSWebCO\CommercioEstero\Enums\TipoSupporto;

final readonly class OpzioniCertificato implements DataObject
{
    public function __construct(
        public int $autentiche = 0,
        // public readonly ?string $consegnaDomicilio,
        // public readonly ?array $consegnaSportello,
        // public readonly ?string $consegnaStampaAzienda,
        public int $copie = 1,
        public bool $legalizzazioneCertificato = false,
        public bool $proforma = false,
        public ?TipoConsegna $tipoConsegna = null,
        public ?TipoSupporto $tipoSupporto = null,
        public bool $urgente = false,
    ) {}

    public function toArray(): array
    {
        return [
            "autentiche" => $this->autentiche,
            // 'consegnaDomicilio' => $this->consegnaDomicilio,
            // 'consegnaSportello' => $this->consegnaSportello,
            // 'consegnaStampaAzienda' => $this->consegnaStampaAzienda,
            "copie" => 1,
            "legalizzazioneCertificato" => $this->legalizzazioneCertificato,
            "proforma" => $this->proforma,
            "tipoConsegna" => $this->tipoConsegna ?? null,
            "tipoSupporto" => $this->tipoSupporto ?? null,
            "urgente" => $this->urgente,
        ];
    }

    #[\Override]
    public static function fromArray(array $data): self
    {
        return new self(
            autentiche: $data["autentiche"] ?? 0,
            copie: $data["copie"] ?? 1,
            legalizzazioneCertificato: $data["legalizzazioneCertificato"] ??
                false,
            proforma: $data["proforma"] ?? false,
            tipoConsegna: $data["tipoConsegna"] ?? null,
            tipoSupporto: $data["tipoSupporto"] ?? null,
            urgente: $data["urgente"] ?? false,
        );
    }
}
