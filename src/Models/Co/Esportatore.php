<?php

namespace IBSWebCO\CommercioEstero\Models\Co;

use IBSWebCO\CommercioEstero\Enums\Ruolo;
use IBSWebCO\CommercioEstero\Models\Stato;

class Esportatore
{
    public string $denominazione;

    public string $indirizzo;

    public string $codiceFiscale;

    public Ruolo $ruolo;

    public Stato $stato;

    public string $numeroRea;

    public bool $registroImprese = true;

    public string $registroImpreseSiglaProvincia;

    public string $partitaIva;

    public string $source = "RI";
}
