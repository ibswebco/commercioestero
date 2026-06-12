<?php

namespace IBSWebCO\CommercioEstero\DTO\Interfaces;

interface DataObject
{
    public function toArray(): array;

    public static function fromArray(array $data): self;
}
