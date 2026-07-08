<?php

namespace IBSWebCO\CommercioEstero\Models;

use IBSWebCO\CommercioEstero\Enums\Ruolo;

/**
 * @property string $codiceFiscale
 * @property string $denominazione
 * @property string $impresaEstera
 * @property string $indirizzo
 * @property string $numeroRea
 * @property string $partitaIva
 * @property bool $registroImprese
 * @property string $registroImpreseSiglaProvincia
 * @property Ruolo $ruolo
 * @property string $source
 * @property Stato $stato
 */
class SoggettoRichiedente
{
    public string $codiceFiscale;

    //public string $codIsoNazione;

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
