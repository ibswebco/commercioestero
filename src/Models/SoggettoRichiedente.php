<?php

namespace IBSWebCO\CommercioEstero\Models;

use IBSWebCO\CommercioEstero\Enums\Ruolo;

class SoggettoRichiedente
{
    public string $codiceFiscale;

    public string $codIsoNazione;

    public string $denominazione;

    public string $impresaEstera;

    public string $indirizzo;

    public string $numeroRea;

    public string $partitaIva;

    public bool $registroImprese;

    public string $registroImpreseSiglaProvincia;

    public Ruolo $ruolo;

    public string $source = "RI";

    public Stato $stato;
}
