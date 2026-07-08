<?php

namespace IBSWebCO\CommercioEstero\Models;

use IBSWebCO\CommercioEstero\Traits\Serializable;

class DatiAllegato
{
    use Serializable;

    public string $file {
        get => base64_encode(file_get_contents($this->path));
    }

    public string $name {
        get => pathinfo($this->path, PATHINFO_BASENAME);
    }

    public string $type {
        get => pathinfo($this->path, PATHINFO_EXTENSION) == "p7m" ? "application/pkcs7-mime" :finfo_file(finfo_open(FILEINFO_MIME_TYPE), $this->path);
    }

    public function __construct(private string $path) {}
}
