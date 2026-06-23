<?php

namespace IBSWebCO\CommercioEstero\DTO;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;

final readonly class LegaleRappresentante implements DataObject
{
    public function __construct(
        public string $codiceFiscaleImpresa,
        public string $codiceFiscaleLegaleRappresentante,
        public string $cognomeLegaleRappresentante,
        public string $nomeLegaleRappresentante,
        public string $tipoFirmatario,
    ) {}

    public function toArray(): array
    {
        return [
            "codiceFiscaleImpresa" => $this->codiceFiscaleImpresa,
            "codiceFiscaleLegaleRappresentante" =>
                $this->codiceFiscaleLegaleRappresentante,
            "cognomeLegaleRappresentante" => $this->cognomeLegaleRappresentante,
            "nomeLegaleRappresentante" => $this->nomeLegaleRappresentante,
            "tipoFirmatario" => $this->tipoFirmatario,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            codiceFiscaleImpresa: $data["impreseLegaleRappresentante"][0][
                "codiceFiscale"
            ],
            codiceFiscaleLegaleRappresentante: $data["codiceFiscale"],
            cognomeLegaleRappresentante: $data["cognome"],
            nomeLegaleRappresentante: $data["nome"],
            tipoFirmatario: $data["tipoFirmatario"] ?? "",
        );
    }
}
