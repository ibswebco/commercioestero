<?php

namespace IBSWebCO\CommercioEstero\DTO\Co;

use IBSWebCO\CommercioEstero\Enums\TipoConsegna;
use IBSWebCO\CommercioEstero\Enums\TipoSupporto;

final class OpzioniCertificato
{
    public function __construct(
        public readonly int $autentiche,
        //public readonly ?string $consegnaDomicilio,
        //public readonly ?array $consegnaSportello,
        //public readonly ?string $consegnaStampaAzienda,
        public readonly int $copie,
        public readonly bool $legalizzazioneCertificato,
        public readonly bool $proforma,
        public readonly ?TipoConsegna $tipoConsegna,
        public readonly ?TipoSupporto $tipoSupporto,
        public readonly bool $urgente,
    )
    { }

    public function toArray(): array
    {
        return [
            'autentiche' => $this->autentiche,
            //'consegnaDomicilio' => $this->consegnaDomicilio,
            //'consegnaSportello' => $this->consegnaSportello,
            //'consegnaStampaAzienda' => $this->consegnaStampaAzienda,
            'copie' => 1,
            'legalizzazioneCertificato' => $this->legalizzazioneCertificato,
            'proforma' => $this->proforma,
            'tipoConsegna' => $this->tipoConsegna ?? '',
            'tipoSupporto' => $this->tipoSupporto ?? '',
            'urgente' => $this->urgente,
        ];
    }
}