<?php
/**
 * User: boshurik
 * Date: 10.12.19
 * Time: 17:55
 */

namespace BoShurik\OrangeData\Model\Correction;

use BoShurik\OrangeData\Model\FactoryTrait;
use BoShurik\OrangeData\Model\JsonSerializableTrait;

class CorrectionStatus implements \JsonSerializable
{
    use FactoryTrait {
        create as private doCreate;
    }
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
     * @var string
     */
    private $ofdWebsite;

    /**
     * @var string
     */
    private $ofdINN;

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

    public static function create(array $parameters): self
    {
        if (isset($parameters['ofdinn'])) {
            $parameters['ofdINN'] = $parameters['ofdinn'];
            unset($parameters['ofdinn']);
        }

        return self::doCreate($parameters);
    }


    public function __construct(
        string $id,
        string $deviceSN,
        string $deviceRN,
        string $fsNumber,
        string $ofdName,
        string $ofdWebsite,
        string $ofdINN,
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
        $this->ofdWebsite = $ofdWebsite;
        $this->ofdINN = $ofdINN;
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

    public function getOfdWebsite(): string
    {
        return $this->ofdWebsite;
    }

    public function getOfdINN(): string
    {
        return $this->ofdINN;
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
