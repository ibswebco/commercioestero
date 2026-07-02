<?php

namespace IBSWebCO\CommercioEstero\Models;

interface PraticaBaseInterface
{
    public function toArray(): mixed;

    public function toJson(): string|false;
}
