<?php
/**
 * User: boshurik
 * Date: 09.12.19
 * Time: 19:03
 */

namespace BoShurik\OrangeData\Model\Document;

use Assert\Assertion;
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
    use FactoryTrait;

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
        string $text,
        ?int $paymentMethodType,
        ?int $paymentSubjectType,
        ?string $nomenclatureCode,
        ?Supplier $supplierInfo,
        ?string $supplierINN,
        ?int $agentType,
        ?Agent $agentInfo,
        ?string $unitOfMeasurement,
        ?string $additionalAttribute,
        ?string $manufacturerCountryCode,
        ?string $customsDeclarationNumber,
        ?string $excise
    ) {
        Assertion::numeric($quantity);
        Assertion::numeric($price);
        Assertion::between($tax, 1, 6);
        Assertion::maxLength($text, 128);
        Assertion::nullOrBetween($paymentMethodType, 1, 7);
        Assertion::nullOrBetween($paymentSubjectType, 1, 19);
        Assertion::nullOrBase64($nomenclatureCode);
        if ($supplierINN !== null) {
            Assertion::inArray(\strlen($supplierINN), [10, 12]);
        }
        Assertion::nullOrBetween($agentType, 1, 127);
        Assertion::nullOrBetweenLength($unitOfMeasurement, 1, 16);
        Assertion::nullOrBetweenLength($additionalAttribute, 1, 64);
        Assertion::nullOrBetweenLength($manufacturerCountryCode, 1, 3);
        Assertion::nullOrBetweenLength($customsDeclarationNumber, 1, 32);
        Assertion::nullOrNumeric($excise);

        $this->quantity = $quantity;
        $this->price = $price;
        $this->tax = $tax;
        $this->text = $text;
        $this->paymentMethodType = $paymentMethodType;
        $this->paymentSubjectType = $paymentSubjectType;
        $this->nomenclatureCode = $nomenclatureCode;
        $this->supplierInfo = $supplierInfo;
        $this->supplierINN = $supplierINN;
        $this->agentType = $agentType;
        $this->agentInfo = $agentInfo;
        $this->unitOfMeasurement = $unitOfMeasurement;
        $this->additionalAttribute = $additionalAttribute;
        $this->manufacturerCountryCode = $manufacturerCountryCode;
        $this->customsDeclarationNumber = $customsDeclarationNumber;
        $this->excise = $excise;
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

    public function getPaymentSubjectType(): ?int
    {
        return $this->paymentSubjectType;
    }

    public function getNomenclatureCode(): ?string
    {
        return $this->nomenclatureCode;
    }

    public function getSupplierInfo(): ?Supplier
    {
        return $this->supplierInfo;
    }

    public function getSupplierINN(): ?string
    {
        return $this->supplierINN;
    }

    public function getAgentType(): ?int
    {
        return $this->agentType;
    }

    public function getAgentInfo(): ?Agent
    {
        return $this->agentInfo;
    }

    public function getUnitOfMeasurement(): ?string
    {
        return $this->unitOfMeasurement;
    }

    public function getAdditionalAttribute(): ?string
    {
        return $this->additionalAttribute;
    }

    public function getManufacturerCountryCode(): ?string
    {
        return $this->manufacturerCountryCode;
    }

    public function getCustomsDeclarationNumber(): ?string
    {
        return $this->customsDeclarationNumber;
    }

    public function getExcise(): ?string
    {
        return $this->excise;
    }
}
