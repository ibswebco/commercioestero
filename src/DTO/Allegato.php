<?php

namespace IBSWebCO\CommercioEstero\DTO;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;

final class Allegato implements DataObject
{
    public function __construct(
        public readonly array $documento,
        public readonly int $attestatiLiberaVendita = 0,
        public readonly int $legalizzazioniFirme = 0,
        public readonly int $vistoDeposito = 0,
        public readonly array $vistoDepositoInfo = [],
        public readonly string $noteAllegato = '',
        public readonly int $vistoPoteriFirmaDichImpresa = 0,
        public readonly int $vistoPoteriFirmaFattura = 0,
        public readonly ?array $vistoPoteriFirmaFatturaInfo = null,
        public readonly ?array $vistoPoteriFirmaInfo = null,
    )
    { }

    public function toArray(): array
    {
        return [
            'documento' => $this->documento,
            'attestatiLiberaVendita' => $this->attestatiLiberaVendita,
            'legalizzazioniFirme' => $this->legalizzazioniFirme,
            'noteAllegato' => $this->noteAllegato,
            'vistoDeposito' => $this->vistoDeposito,
            'vistoDepositoInfo' => $this->vistoDepositoInfo ?? new \stdClass,
            'vistoPoteriFirmaDichImpresa' => $this->vistoPoteriFirmaDichImpresa,
            'vistoPoteriFirmaFattura' => $this->vistoPoteriFirmaFattura,
            'vistoPoteriFirmaFatturaInfo' => $this->vistoPoteriFirmaFatturaInfo ?? ['importoFattura' => null],
            'vistoPoteriFirmaInfo' => $this->vistoPoteriFirmaInfo ?? new \stdClass,
        ];
    }

    public static function fromArray(array $data): DataObject
    {
        return new self(
            documento: $data['documento'],
            attestatiLiberaVendita: $data['attestatiLiberaVendita'] ?? 0,
            legalizzazioniFirme: $data['legalizzazioneFirma'] ?? 0,
            vistoDeposito: $data['vistoDeposito'] ?? 0,
            vistoDepositoInfo: $data['vistoDepositoInfo'] ?? [],
            noteAllegato: $data['noteAllegato'] ?? '',
            vistoPoteriFirmaDichImpresa: $data['vistoPoteriFirmaDichImpresa'] ?? 0,
            vistoPoteriFirmaFattura: $data['vistoPoteriFirmaFattura'] ?? 0,
            vistoPoteriFirmaInfo: $data['vistoPoteriFirmaInfo'] ?? null,
        );
    }
}