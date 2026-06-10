<?php

namespace IBSWebCO\CommercioEstero\DTO;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;

final class UtenteRichiedente implements DataObject
{
    public function __construct(
        public readonly string $accountId,
        public readonly string $codiceFiscale,
        public readonly string $cognome,
        public readonly string $email,
        public readonly string $nome,
        public readonly string $userId,
    )
    { }

    public function toArray(): array
    {
        return [
            'accountId' => $this->accountId,
            'codiceFiscale' => strtoupper($this->codiceFiscale),
            'cognome' => strtoupper($this->cognome),
            'email' => strtolower($this->email),
            'nome' => strtoupper($this->nome),
            'userId' => $this->userId,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            accountId: $data['accountId'] ?? '',
            codiceFiscale: $data['codicFiscale'] ?? '',
            cognome: $data['cognome'] ?? '',
            email: $data['email'] ?? '',
            nome: $data['nome'] ?? '',
            userId: $data['userId'] ?? '',
        );
    }
}