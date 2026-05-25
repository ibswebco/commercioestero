<?php

namespace IBSWebCO\CommercioEstero\Enums;

enum TipoPratica: string
{
    case CO = 'CO';

    case DF = 'DF';

    case CD = 'CD';

    case DD = 'DD';

    case RD = 'RD';

    case VA = 'VA';

    public function descrizione(): string 
    {
        return match($this)
        {
            self::CO => 'Certificato di Origine',
            self::DF => 'Denuncia di Furto - Smarrimento',
            self::CD => 'Dichiarazione di Conferimento Delega alla Spedizione',
            self::DD => 'Dichiarazione di Distruzione',
            self::RD => 'Dichiarazione di Revoca Delega alla Spedizione',
            self::VA => 'Richiesta Visti - Autorizzazioni - Copie Certificato',
        };   
    }
}