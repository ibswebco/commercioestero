<?php

namespace IBSWebCO\CommercioEstero\DTO\Co\Origine;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;
use Override;

final readonly class OrigineUe implements DataObject
{
    public function __construct(
        public ?OrigineUeDettagli $fabbricateProdotte,
        public ?OrigineUeDettagli $trasformateLavorate,
    ) {
        throw new \Exception("Not implemented");
    }

    #[Override]
    public function toArray(): array
    {
        return [
            "fabbricateProdotte" => $this->fabbricateProdotte->toArray() ?? [],
            "trasformateLavorate" =>
                $this->trasformateLavorate->toArray() ?? [],
            "dichiarazioneUnicaUe" => ["firmato" => false],
        ];
    }

    #[Override]
    public static function fromArray(array $data): DataObject
    {
        throw new \Exception("Not implemented");
    }
}
