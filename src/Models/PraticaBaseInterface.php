<?php

namespace IBSWebCO\CommercioEstero\Models;

/**
 * @method mixed toArray()
 * @method string|false toJson()
 */
interface PraticaBaseInterface
{
    public function toArray(): mixed;

    public function toJson(): string|false;
}
