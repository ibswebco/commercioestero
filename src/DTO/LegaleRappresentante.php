<?php

namespace IBSWebCO\CommercioEstero\DTO;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;

final class LegaleRappresentante implements DataObject
{
    public function __construct(
       public readonly string $codiceFiscaleImpresa,
       public readonly string $codiceFiscaleLegaleRappresentante,
       public readonly string $cognomeLegaleRappresentante,
       public readonly string $nomeLegaleRappresentante,
       public readonly string $tipoFirmatario, 
    )
    { }

    public function toArray(): array 
    {
        return [
            'codiceFiscaleImpresa' => $this->codiceFiscaleImpresa,
            'codiceFiscaleLegaleRappresentante' => $this->codiceFiscaleLegaleRappresentante,
            'cognomeLegaleRappresentante' => $this->cognomeLegaleRappresentante,
            'nomeLegaleRappresentante' => $this->nomeLegaleRappresentante,
            'tipoFirmatario' => $this->tipoFirmatario,
        ];    
    }

    public static function fromArray(array $data): self
    {
        return new self(
            codiceFiscaleImpresa: $data['codiceFiscaleImpresa'],
            codiceFiscaleLegaleRappresentante: $data['codiceFiscaleLegaleRappresentante'],
            cognomeLegaleRappresentante: $data['cognom,eLegaleRappresentante'],
            nomeLegaleRappresentante: $data['nomeLegaleRappresentante'],
            tipoFirmatario: $data['tipoFirmatario'],
        );
    }
}