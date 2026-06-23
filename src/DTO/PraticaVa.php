<?php

namespace IBSWebCO\CommercioEstero\DTO;

use IBSWebCO\CommercioEstero\DTO\Ente\CameraCommercio;
use IBSWebCO\CommercioEstero\DTO\Ente\Sede;
use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;
use IBSWebCO\CommercioEstero\Enums\TipoConsegna;
use IBSWebCO\CommercioEstero\Enums\TipoPagamento;
use IBSWebCO\CommercioEstero\Enums\TipoSupporto;

final readonly class PraticaVa implements DataObject
{
    public function __construct(
        public array $certificati,
        public array $certificazioniAllegati,
        public ?bool $consegnaDomicilio,
        public ?bool $consegnaSportello,
        public ?bool $consegnaStampaAzienda,
        public ?array $delega,
        public CameraCommercio $ente,
        public Sede $sede,
        public Firmatario $firmatario,
        public ?string $note,
        public SoggettoRichiedente $soggettoRichiedente,
        public TipoConsegna $tipoConsegna,
        public TipoPagamento $tipoPagamento,
        public TipoSupporto $tipoSupporto,
        public bool $urgente,
        public UtenteRichiedente $utenteRichiedente,
    ) {}

    public function toArray(): array
    {
        return [
            "certificati" => $this->certificati,
            "certificazioniAllegati" => $this->certificazioniAllegati,
            "consegnaDomicilio" => $this->consegnaDomicilio,
            "consegnaSportello" => $this->consegnaSportello,
            "consegnaStampaAzienda" => $this->consegnaStampaAzienda,
            "delega" => $this->delega ?? new \stdClass(),
            "ente" => $this->ente->toArray(),
            "firmatario" => $this->firmatario->toArray(),
            "linguaDocumentoSintesi" => "it",
            "linguaPortale" => "it",
            "note" => $this->note ?? "",
            "sede" => $this->sede->toArray(),
            "soggettoRichiedente" => $this->soggettoRichiedente->toArray(),
            "tipoConsegna" => $this->tipoConsegna,
            "tipoPagamento" => $this->tipoPagamento,
            "tipoSupporto" => $this->tipoSupporto,
            "urgente" => $this->urgente,
            "utenteRichiedente" => $this->utenteRichiedente->toArray(),
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            certificati: $data["certificati"] ?? [],
            certificazioniAllegati: $data["certificazioniAllegati"] ?? [],
            consegnaDomicilio: $data["consegnaDomicilio"] ?? false,
            consegnaSportello: $data["consegnaSportello"] ?? false,
            consegnaStampaAzienda: $data["consegnaStampaAzienda"] ?? true,
            delega: $data["delega"] ?? [],
            ente: $data["ente"],
            sede: $data["sede"],
            firmatario: $data["firmatario"] ?? [],
            note: $data["note"] ?? null,
            soggettoRichiedente: $data["soggettoRichiedente"] ?? [],
            tipoConsegna: $data["tipoConsegna"] ?? TipoConsegna::STAMPA_AZIENDA,
            tipoPagamento: $data["tipoPagamento"] ?? TipoPagamento::TELEMACO,
            tipoSupporto: $data["tipoSupporto"] ?? TipoSupporto::FOGLIO_BIANCO,
            urgente: $data["urgente"] ?? false,
            utenteRichiedente: $data["utenterRichiedente"] ?? [],
        );
    }
}
