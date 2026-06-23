<?php
namespace IBSWebCO\CommercioEstero\DTO\Co\Origine;

use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;
use IBSWebCO\CommercioEstero\DTO\Co\Paese;
use IBSWebCO\CommercioEstero\Enums\TipoOrigine;
use Override;

final readonly class OrigineUeDettagli implements DataObject
{
    public function __construct(
        public ?Paese $paese,
        public ?array $imprese,
        public ?TipoOrigine $tipoOrigine,
    ) {}

    #[Override]
    public function toArray(): array
    {
        return [
            "paese" => $this->paese->toArray() ?? [],
            "imprese" => $this->imprese ?? [],
            "tipoOrigine" => $this->tipoOrigine ?? "",
        ];
    }

    #[Override]
    public static function fromArray(array $data): DataObject
    {
        throw new \Exception("Not implemented");
    }
}
