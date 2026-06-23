<?php

namespace IBSWebCO\CommercioEstero\DTO\Co;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;

final readonly class Speditore implements DataObject
{
    public function __construct(
        public ?array $delega = null,
        public ?array $esporatore = null,
        public string $ruolo = "",
        public ?array $spedizioniere = null,
    ) {}

    public function toArray(): array
    {
        return [
            "delega" => $this->delega ?? new \stdClass(),
            "esportatore" => $this->esporatore ?? [],
            "ruolo" => strtoupper($this->ruolo),
            "spedizioniere" => $this->spedizioniere ?? new \stdClass(),
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            delega: $data["delega"] ?? null,
            esporatore: $data["esportatore"] ?? null,
            ruolo: $data["ruolo"] ?? "e",
            spedizioniere: $data["spedizioniere"] ?? null,
        );
    }
}
