<?php

namespace IBSWebCO\CommercioEstero\DTO;

use IBSWebCO\CommercioEstero\Enums\Firmatario\Ruolo;
use IBSWebCO\CommercioEstero\Enums\Firmatario\Tipo;

final class Firmatario
{
    public function __construct(
        public readonly bool $checkRuolo,
        public readonly string $codiceFiscale,
        public readonly string $cognome,
        public readonly ?array $documentoCarica,
        public readonly bool $enabled,
        public readonly string $nome,
        public readonly bool $registroImprese,
        public readonly ?Ruolo $ruolo,
        public readonly ?Tipo $tipoFirmatario,
        public readonly bool $validate, 
    )
    { }

    public function toArray(): array  
    {
        return [
            'checkRuolo' => $this->checkRuolo,
            'codiceFiscale' => $this->codiceFiscale,
            'cognome' => $this->cognome,
            'documentoCarica' => $this->documentoCarica ?? [ 'firmato' => false ],//new \stdClass(),
            'enabled' => $this->enabled,
            'nome' => $this->nome,
            'registroImporese' => $this->registroImprese,
            'ruolo' => $this->ruolo ?? '',
            'tipoFirmatario' => $this->tipoFirmatario ?? '',
            'validate' => $this->validate,
        ];    
    }
}