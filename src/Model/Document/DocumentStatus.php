<?php
/**
 * User: boshurik
 * Date: 10.12.19
 * Time: 17:44
 */

namespace BoShurik\OrangeData\Model\Document;

use BoShurik\OrangeData\Model\FactoryTrait;
use BoShurik\OrangeData\Model\JsonSerializableTrait;

class DocumentStatus
{
    use FactoryTrait;
    use JsonSerializableTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $deviceSN;

    /**
     * @var string
     */
    private $deviceRN;

    /**
     * @var string
     */
    private $fsNumber;

    /**
     * @var string
     */
    private $ofdName;

    /**
     * @var string|null
     */
    private $odfWebsite;

    /**
     * @var string
     */
    private $odfINN;

    /**
     * @var string
     */
    private $fnsWebsite;

    /**
     * @var string
     */
    private $companyINN;

    /**
     * @var string
     */
    private $companyName;

    /**
     * @var int
     */
    private $documentNumber;

    /**
     * @var int
     */
    private $shiftNumber;

    /**
     * @var int
     */
    private $documentIndex;

    /**
     * @var \DateTimeInterface
     */
    private $processedAt;

    /**
     * @var Content
     */
    private $content;

    /**
     * @var string
     */
    private $change;

    /**
     * @var string
     */
    private $fp;

    /**
     * @var string|null
     */
    private $callbackUrl;

    public function __construct(
        string $id,
        string $deviceSN,
        string $deviceRN,
        string $fsNumber,
        string $ofdName,
        ?string $odfWebsite,
        string $odfINN,
        string $fnsWebsite,
        string $companyINN,
        string $companyName,
        int $documentNumber,
        int $shiftNumber,
        int $documentIndex,
        string $processedAt,
        Content $content,
        string $change,
        string $fp,
        ?string $callbackUrl
    ) {
        $this->id = $id;
        $this->deviceSN = $deviceSN;
        $this->deviceRN = $deviceRN;
        $this->fsNumber = $fsNumber;
        $this->ofdName = $ofdName;
        $this->odfWebsite = $odfWebsite;
        $this->odfINN = $odfINN;
        $this->fnsWebsite = $fnsWebsite;
        $this->companyINN = $companyINN;
        $this->companyName = $companyName;
        $this->documentNumber = $documentNumber;
        $this->shiftNumber = $shiftNumber;
        $this->documentIndex = $documentIndex;
        $this->processedAt = new \DateTimeImmutable($processedAt);
        $this->content = $content;
        $this->change = $change;
        $this->fp = $fp;
        $this->callbackUrl = $callbackUrl;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDeviceSN(): string
    {
        return $this->deviceSN;
    }

    public function getDeviceRN(): string
    {
        return $this->deviceRN;
    }

    public function getFsNumber(): string
    {
        return $this->fsNumber;
    }

    public function getOfdName(): string
    {
        return $this->ofdName;
    }

    public function getOdfWebsite(): ?string
    {
        return $this->odfWebsite;
    }

    public function getOdfINN(): string
    {
        return $this->odfINN;
    }

    public function getFnsWebsite(): string
    {
        return $this->fnsWebsite;
    }

    public function getCompanyINN(): string
    {
        return $this->companyINN;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getDocumentNumber(): int
    {
        return $this->documentNumber;
    }

    public function getShiftNumber(): int
    {
        return $this->shiftNumber;
    }

    public function getDocumentIndex(): int
    {
        return $this->documentIndex;
    }

    public function getProcessedAt(): \DateTimeInterface
    {
        return $this->processedAt;
    }

    public function getContent(): Content
    {
        return $this->content;
    }

    public function getChange(): string
    {
        return $this->change;
    }

    public function getFp(): string
    {
        return $this->fp;
    }

    public function getCallbackUrl(): ?string
    {
        return $this->callbackUrl;
    }
}
