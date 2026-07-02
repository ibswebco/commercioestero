<?php

namespace IBSWebCO\CommercioEstero\Models\Co;

use stdClass;

class Destinatario
{
    public bool $noto = true;

    public mixed $destinatarioNonNoto;

    public array $destinatariNoti = [];

    public function __construct()
    {
        $this->destinatarioNonNoto = new stdClass();
    }
}
