<?php
/**
 * User: boshurik
 * Date: 09.12.19
 * Time: 19:03
 */

namespace BoShurik\OrangeData\Model\Document;

use BoShurik\OrangeData\Assertion;
use BoShurik\OrangeData\Model\FactoryTrait;
use BoShurik\OrangeData\Model\JsonSerializableTrait;

class Position implements \JsonSerializable
{
    public const TAX_20 = 1;
    public const TAX_10 = 2;
    public const TAX_20_120 = 3;
    public const TAX_10_110 = 4;
    public const TAX_0 = 5;
    public const TAX_NO = 6;

    public const METHOD_TYPE_PREPAYMENT_100 = 1;
    public const METHOD_TYPE_PREPAYMENT = 2;
    public const METHOD_TYPE_PREPAID_EXPENSE = 3;
    public const METHOD_TYPE_FULL_PAYMENT = 4;
    public const METHOD_TYPE_PAYMENT_AND_CREDIT = 5;
    public const METHOD_TYPE_CREDIT = 6;
    public const METHOD_TYPE_CREDIT_PAYMENT = 7;

    public const SUBJECT_TYPE_PRODUCT = 1;
    public const SUBJECT_TYPE_EXCISE_PRODUCT = 2;
    public const SUBJECT_TYPE_WORK = 3;
    public const SUBJECT_TYPE_SERVICE = 4;
    public const SUBJECT_TYPE_GAMBLING = 5;
    public const SUBJECT_TYPE_GAMBLING_WIN = 6;
    public const SUBJECT_TYPE_LOTTERY = 7;
    public const SUBJECT_TYPE_LOTTERY_WIN = 8;
    public const SUBJECT_TYPE_INTELLECTUAL_ACTIVITY = 9;
    public const SUBJECT_TYPE_PAYMENT = 10;
    public const SUBJECT_TYPE_AGENCY_FEE = 11;
    public const SUBJECT_TYPE_COMPOUND_SUBJECT = 12;
    public const SUBJECT_TYPE_OTHER_SUBJECT = 13;
    public const SUBJECT_TYPE_PROPERTY_LAW = 14;
    public const SUBJECT_TYPE_NON_OPERATING_INCOME = 15;
    public const SUBJECT_TYPE_INSURANCE = 16;
    public const SUBJECT_TYPE_TRADING_FEE = 17;
    public const SUBJECT_TYPE_RESORT_FEE = 18;
    public const SUBJECT_TYPE_DEPOSIT = 19;

    use JsonSerializableTrait;
    use FactoryTrait {
        getMapping as doGetMapping;
    }

    /**
     * @var string
     */
    private $quantity;

    /**
     * @var string
     */
    private $price;

    /**
     * @var int
     */
    private $tax;

    /**
     * @var string
     */
    private $text;

    /**
     * @var int|null
     */
    private $paymentMethodType;

    /**
     * @var int|null
     */
    private $paymentSubjectType;

    /**
     * @var string|null
     */
    private $nomenclatureCode;

    /**
     * @var Supplier|null
     */
    private $supplierInfo;

    /**
     * @var string|null
     */
    private $supplierINN;

    /**
     * @var int|null
     */
    private $agentType;

    /**
     * @var Agent|null
     */
    private $agentInfo;

    /**
     * @var string|null
     */
    private $unitOfMeasurement;

    /**
     * @var string|null
     */
    private $additionalAttribute;

    /**
     * @var string|null
     */
    private $manufacturerCountryCode;

    /**
     * @var string|null
     */
    private $customsDeclarationNumber;

    /**
     * @var string|null
     */
    private $excise;

    public function __construct(
        string $quantity,
        string $price,
        int $tax,
        string $text
    ) {
        Assertion::numeric($quantity);
        Assertion::numeric($price);
        Assertion::between($tax, 1, 6);
        Assertion::maxLength($text, 128);

        $this->quantity = $quantity;
        $this->price = $price;
        $this->tax = $tax;
        $this->text = $text;
    }

    public function getQuantity(): string
    {
        return $this->quantity;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getTax(): int
    {
        return $this->tax;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getPaymentMethodType(): ?int
    {
        return $this->paymentMethodType;
    }

    public function setPaymentMethodType(?int $paymentMethodType): Position
    {
        Assertion::nullOrBetween($paymentMethodType, 1, 7);

        $this->paymentMethodType = $paymentMethodType;

        return $this;
    }

    public function getPaymentSubjectType(): ?int
    {
        return $this->paymentSubjectType;
    }

    public function setPaymentSubjectType(?int $paymentSubjectType): Position
    {
        Assertion::nullOrBetween($paymentSubjectType, 1, 19);

        $this->paymentSubjectType = $paymentSubjectType;

        return $this;
    }

    public function getNomenclatureCode(): ?string
    {
        return $this->nomenclatureCode;
    }

    public function setNomenclatureCode(?string $nomenclatureCode): Position
    {
        Assertion::nullOrBase64($nomenclatureCode);

        $this->nomenclatureCode = $nomenclatureCode;

        return $this;
    }

    public function getSupplierInfo(): ?Supplier
    {
        return $this->supplierInfo;
    }

    public function setSupplierInfo(?Supplier $supplierInfo): Position
    {
        $this->supplierInfo = $supplierInfo;

        return $this;
    }

    public function getSupplierINN(): ?string
    {
        return $this->supplierINN;
    }

    public function setSupplierINN(?string $supplierINN): Position
    {
        if ($supplierINN !== null) {
            Assertion::inn($supplierINN);
        }

        $this->supplierINN = $supplierINN;

        return $this;
    }

    public function getAgentType(): ?int
    {
        return $this->agentType;
    }

    public function setAgentType(?int $agentType): Position
    {
        Assertion::nullOrBetween($agentType, 1, 127);

        $this->agentType = $agentType;

        return $this;
    }

    public function getAgentInfo(): ?Agent
    {
        return $this->agentInfo;
    }

    public function setAgentInfo(?Agent $agentInfo): Position
    {
        $this->agentInfo = $agentInfo;

        return $this;
    }

    public function getUnitOfMeasurement(): ?string
    {
        return $this->unitOfMeasurement;
    }

    public function setUnitOfMeasurement(?string $unitOfMeasurement): Position
    {
        Assertion::nullOrBetweenLength($unitOfMeasurement, 1, 16);

        $this->unitOfMeasurement = $unitOfMeasurement;

        return $this;
    }

    public function getAdditionalAttribute(): ?string
    {
        return $this->additionalAttribute;
    }

    public function setAdditionalAttribute(?string $additionalAttribute): Position
    {
        Assertion::nullOrBetweenLength($additionalAttribute, 1, 64);

        $this->additionalAttribute = $additionalAttribute;

        return $this;
    }

    public function getManufacturerCountryCode(): ?string
    {
        return $this->manufacturerCountryCode;
    }

    public function setManufacturerCountryCode(?string $manufacturerCountryCode): Position
    {
        Assertion::nullOrBetweenLength($manufacturerCountryCode, 1, 3);

        $this->manufacturerCountryCode = $manufacturerCountryCode;

        return $this;
    }

    public function getCustomsDeclarationNumber(): ?string
    {
        return $this->customsDeclarationNumber;
    }

    public function setCustomsDeclarationNumber(?string $customsDeclarationNumber): Position
    {
        Assertion::nullOrBetweenLength($customsDeclarationNumber, 1, 32);

        $this->customsDeclarationNumber = $customsDeclarationNumber;

        return $this;
    }

    public function getExcise(): ?string
    {
        return $this->excise;
    }

    public function setExcise(?string $excise): Position
    {
        Assertion::nullOrNumeric($excise);

        $this->excise = $excise;

        return $this;
    }

    protected static function getMapping(\ReflectionClass $reflectionClass): array
    {
        $mapping = self::doGetMapping($reflectionClass);
        $mapping['supplierInfo'] = '?'.Supplier::class;
        $mapping['agentInfo'] = '?'.Agent::class;

        return $mapping;
    }
}
