<?php

namespace IBSWebCO\CommercioEstero\DTO;

use IBSWebCO\CommercioEstero\DTO\Co\Destinatario;
use IBSWebCO\CommercioEstero\DTO\Co\DichiarazioneMerciFatture;
use IBSWebCO\CommercioEstero\DTO\Co\OpzioniCertificato;
use IBSWebCO\CommercioEstero\DTO\Co\Speditore;
use IBSWebCO\CommercioEstero\DTO\Ente\CameraCommercio;
use IBSWebCO\CommercioEstero\DTO\Ente\Sede;
use IBSWebCO\CommercioEstero\DTO\Firmatario;
use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;
use IBSWebCO\CommercioEstero\DTO\SoggettoRichiedente;
use IBSWebCO\CommercioEstero\DTO\UtenteRichiedente;
use IBSWebCO\CommercioEstero\Enums\TipoPagamento;

final class PraticaCo implements DataObject
{
    public function __construct (
        public readonly Destinatario $destinatario,
        //public readonly ?array $certificazioniAllegati,
        public readonly DichiarazioneMerciFatture $dichiarazioneMerciFatture,
        public readonly CameraCommercio $ente,
        public readonly bool $evasioneAutomatica,
        public readonly float $fatturatoTotale,
        public readonly Firmatario $firmatario,
        public readonly string $gicenzaMerci,
        public readonly string $note,
        public readonly OpzioniCertificato $opzioniCertificato,
        public readonly array $origineExtraUe,
        public readonly array $origineUe,
        public readonly ?string $osservazioni,
        public readonly Sede $sede,
        //public readonly Tipo $selezionaFirmatario,
        public readonly SoggettoRichiedente $soggettoRichiedente,
        public readonly Speditore $speditore,
        public readonly TipoPagamento $tipoPagamento,
        public readonly ?string $trasporto,
        public readonly UtenteRichiedente $utenteRichiedente,    
    )
    { }

    public function toArray(): array
    {
        return [
            'certificazioniAllegati' => [],
            'destinatario' => $this->destinatario->toArray(),
            'dichiarazioneMerciFatture' => $this->dichiarazioneMerciFatture->toArray(),
            'ente' => $this->ente->toArray(),
            'evasioneAutomatica' => $this->evasioneAutomatica,
            'fatturatoTotale' => $this->fatturatoTotale,
            'fatture' => [],
            'firmatario' => $this->firmatario->toArray(),
            'giacenzaMerci' => $this->gicenzaMerci,
            'linguaDocumentoSintesi' => 'it',
            'linguaPortale' => 'it',
            'note' => $this->note,
            'opzioniCertificato' => $this->opzioniCertificato->toArray(),
            'origineExtraUe' => $this->origineExtraUe,
            'origineUe' => $this->origineUe,
            'osservazioni' => $this->osservazioni,
            'sede' => $this->sede->toArray(),
            //'selezionaFirmatario' => $this->selezionaFirmatario,
            'soggettoRichiedente' => $this->soggettoRichiedente->toArray(),
            'speditore' => $this->speditore->toArray(),
            'tipoPagamento' => $this->tipoPagamento,
            'trasporto' => $this->trasporto,
            'utenteRichiedente' => $this->utenteRichiedente->toArray(),
            'valuta' => 'EUR',
            'importoRichiesta' => 0.0,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            destinatario: $data['destinatario'],
            dichiarazioneMerciFatture: $data['dichiarazioneMerciFatture'],
            ente: $data['ente'],
            evasioneAutomatica: $data['evasioneAutomatica'],
            fatturatoTotale: $data['datturatoTotale'],
            firmatario: $data['firmatario'],
            gicenzaMerci: $data['giacenzaMerci'],
            note: $data['note'],
            opzioniCertificato: $data['opzioniCertificato'],
            origineExtraUe: $data['origineExtraUe'],
            origineUe: $data['origineUe'],
            osservazioni: $data['osservazioni'] ?? null,
            sede: $data['sede'],
            soggettoRichiedente: $data['soggettoRichiedente'],
            speditore: $data['speditore'],
            tipoPagamento: $data['tipoPagamento'],
            trasporto: $data['trasporto'] ?? null,
            utenteRichiedente: $data['utenteRichiedente'],
        );
    }
}