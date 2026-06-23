<?php

namespace IBSWebCO\CommercioEstero\DTO;

use IBSWebCO\CommercioEstero\DTO\Co\Destinatario;
use IBSWebCO\CommercioEstero\DTO\Co\DichiarazioneMerciFatture;
use IBSWebCO\CommercioEstero\DTO\Co\OpzioniCertificato;
use IBSWebCO\CommercioEstero\DTO\Co\Speditore;
use IBSWebCO\CommercioEstero\DTO\Ente\CameraCommercio;
use IBSWebCO\CommercioEstero\DTO\Ente\Sede;
use IBSWebCO\CommercioEstero\DTO\Interfaces\DataObject;
use IBSWebCO\CommercioEstero\Enums\TipoPagamento;
use IBSWebCO\CommercioEstero\Traits\Cloneable;

final readonly class PraticaCo implements DataObject
{
    use Cloneable;

    public function __construct(
        public Destinatario $destinatario,
        public ?array $certificazioniAllegati,
        public DichiarazioneMerciFatture $dichiarazioneMerciFatture,
        public CameraCommercio $ente,
        public bool $evasioneAutomatica,
        public float $fatturatoTotale,
        public ?array $fatture,
        public Firmatario $firmatario,
        public string $gicenzaMerci,
        public string $note,
        public OpzioniCertificato $opzioniCertificato,
        public array $origineExtraUe,
        public array $origineUe,
        public ?string $osservazioni,
        public Sede $sede,
        // public readonly Tipo $selezionaFirmatario,
        public SoggettoRichiedente $soggettoRichiedente,
        public Speditore $speditore,
        public TipoPagamento $tipoPagamento,
        public ?string $trasporto,
        public UtenteRichiedente $utenteRichiedente,
    ) {}

    public function toArray(): array
    {
        return [
            "certificazioniAllegati" => $this->certificazioniAllegati ?? [],
            "destinatario" => $this->destinatario->toArray(),
            "dichiarazioneMerciFatture" => $this->dichiarazioneMerciFatture->toArray(),
            "ente" => $this->ente->toArray(),
            "evasioneAutomatica" => $this->evasioneAutomatica,
            "fatturatoTotale" => $this->fatturatoTotale,
            "fatture" => $this->fatture ?? [],
            "firmatario" => $this->firmatario->toArray(),
            "giacenzaMerci" => $this->gicenzaMerci,
            "linguaDocumentoSintesi" => "it",
            "linguaPortale" => "it",
            "note" => $this->note,
            "opzioniCertificato" => $this->opzioniCertificato->toArray(),
            "origineExtraUe" => $this->origineExtraUe,
            "origineUe" => $this->origineUe,
            "osservazioni" => $this->osservazioni,
            "sede" => $this->sede->toArray(),
            "soggettoRichiedente" => $this->soggettoRichiedente->toArray(),
            "speditore" => $this->speditore->toArray(),
            "tipoPagamento" => $this->tipoPagamento,
            "trasporto" => $this->trasporto,
            "utenteRichiedente" => $this->utenteRichiedente->toArray(),
            "valuta" => "EUR",
            "importoRichiesta" => 0.0,
        ];

        //return get_object_vars($this);
    }

    public static function fromArray(array $data): self
    {
        return new self(
            destinatario: $data["destinatario"] ?? Destinatario::fromArray([]),
            certificazioniAllegati: $data["allegati"] ?? [],
            dichiarazioneMerciFatture: $data["dichiarazioneMerciFatture"] ??
                DichiarazioneMerciFatture::fromArray([]),
            ente: $data["ente"],
            evasioneAutomatica: $data["evasioneAutomatica"] ?? false,
            fatturatoTotale: $data["datturatoTotale"] ?? 0,
            fatture: $data["fatture"] ?? [],
            firmatario: $data["firmatario"] ?? Firmatario::fromArray([]),
            gicenzaMerci: $data["giacenzaMerci"] ?? "",
            note: $data["note"] ?? "",
            opzioniCertificato: $data["opzioniCertificato"] ??
                OpzioniCertificato::fromArray([]),
            origineExtraUe: $data["origineExtraUe"] ?? [],
            origineUe: $data["origineUe"] ?? [],
            osservazioni: $data["osservazioni"] ?? null,
            sede: $data["sede"],
            soggettoRichiedente: $data["soggettoRichiedente"] ??
                SoggettoRichiedente::fromArray([]),
            speditore: $data["speditore"] ?? Speditore::fromArray([]),
            tipoPagamento: $data["tipoPagamento"] ?? TipoPagamento::TELEMACO,
            trasporto: $data["trasporto"] ?? null,
            utenteRichiedente: $data["utenteRichiedente"] ??
                UtenteRichiedente::fromArray([]),
        );
    }

    /*public function aggiungiCertificazioniAllegati(array $data): self
    {
        $clone = clone $this;
        $clone->certificazioniAllegati = $data;

        return $clone;
    }

    public function aggiungiFatture(array $data): self
    {
        $clone = clone $this;
        $clone->fatture = $data;

        return $clone;
        }*/
}
