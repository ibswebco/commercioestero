<?php

namespace IBSWebCO\CommercioEstero\DTO\Co;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;
use Override;

final class Destinatario implements DataObject
{
    public function __construct(
        public readonly ?string $denominazione,
        public readonly ?string $indirizzo,
        public readonly ?array $stato, 
    )
    { }

    public function toArray(): array 
    {
        $dn = $this->denominazione ? ['destinatariNoti' => [
                [
                    'denominazione' => $this->denominazione,
                    'indirizzo' => $this->indirizzo ?? '',
                    'stato' => [
                        'codice' => $this->stato['codice'] ?? '',
                        'denominazione' => $this->stato['denominazione'] ?? '',
                        'denominazioneCo' => $this->stato['denominazione'] ?? '',
                    ],
                ],
            ]] : [];
    
        return [
            'destinatariNoti' => $dn,
            'destinatarioNonNoto' => new \stdClass(),
            'noto' => true,
        ];    
    }

    public static function fromArray(array $data): self
    {
        return new self(
            denominazione: $data['denominazione'] ?? null,
            indirizzo: $data['indirizzo'] ?? null,
            stato: $data['stato'] ?? null,
        );   
    }
}