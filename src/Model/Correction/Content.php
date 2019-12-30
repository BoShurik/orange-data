<?php
/**
 * User: boshurik
 * Date: 09.12.19
 * Time: 19:02
 */

namespace BoShurik\OrangeData\Model\Correction;

use BoShurik\OrangeData\Assertion;
use BoShurik\OrangeData\Model\FactoryTrait;
use BoShurik\OrangeData\Model\JsonSerializableTrait;

class Content implements \JsonSerializable
{
    use JsonSerializableTrait;
    use FactoryTrait;

    const CORRECTION_TYPE_SELF = 0;
    const CORRECTION_TYPE_ORDER = 1;

    public const TYPE_IN = 1;
    public const TYPE_OUT = 3;

    /**
     * @var int
     */
    private $correctionType;

    /**
     * @var int
     */
    private $type;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $causeDocumentDate;

    /**
     * @var string
     */
    private $causeDocumentNumber;

    /**
     * @var string
     */
    private $totalSum;

    /**
     * @var string
     */
    private $cashSum;

    /**
     * @var string
     */
    private $eCashSum;

    /**
     * @var string
     */
    private $prepaymentSum;

    /**
     * @var string
     */
    private $postpaymentSum;

    /**
     * @var string
     */
    private $otherPaymentTypeSum;

    /**
     * @var string
     */
    private $tax1Sum;

    /**
     * @var string
     */
    private $tax2Sum;

    /**
     * @var string
     */
    private $tax3Sum;

    /**
     * @var string
     */
    private $tax4Sum;

    /**
     * @var string
     */
    private $tax5Sum;

    /**
     * @var string
     */
    private $tax6Sum;

    /**
     * @var int
     */
    private $taxationSystem;

    /**
     * @var string|null
     */
    private $automatNumber;

    /**
     * @var string|null
     */
    private $settlementAddress;

    /**
     * @var string|null
     */
    private $settlementPlace;

    public function __construct(
        int $correctionType,
        int $type,
        string $description,
        string $causeDocumentDate,
        string $causeDocumentNumber,
        string $totalSum,
        string $cashSum,
        string $eCashSum,
        string $prepaymentSum,
        string $postpaymentSum,
        string $otherPaymentTypeSum,
        string $tax1Sum,
        string $tax2Sum,
        string $tax3Sum,
        string $tax4Sum,
        string $tax5Sum,
        string $tax6Sum,
        int $taxationSystem
    ) {
        Assertion::inArray($correctionType, [
            self::CORRECTION_TYPE_SELF,
            self::CORRECTION_TYPE_ORDER,
        ]);
        Assertion::inArray($type, [
            self::TYPE_IN,
            self::TYPE_OUT,
        ]);
        Assertion::betweenLength($description, 1, 243);
        Assertion::date($causeDocumentDate, 'Y-m-d\TH:i:s');
        Assertion::betweenLength($causeDocumentNumber, 1, 32);
        Assertion::numeric($totalSum);
        Assertion::numeric($cashSum);
        Assertion::numeric($eCashSum);
        Assertion::numeric($prepaymentSum);
        Assertion::numeric($postpaymentSum);
        Assertion::numeric($otherPaymentTypeSum);
        Assertion::numeric($tax1Sum);
        Assertion::numeric($tax2Sum);
        Assertion::numeric($tax3Sum);
        Assertion::numeric($tax4Sum);
        Assertion::numeric($tax5Sum);
        Assertion::numeric($tax6Sum);
        Assertion::between($taxationSystem, 0, 5);

        $this->correctionType = $correctionType;
        $this->type = $type;
        $this->description = $description;
        $this->causeDocumentDate = $causeDocumentDate;
        $this->causeDocumentNumber = $causeDocumentNumber;
        $this->totalSum = $totalSum;
        $this->cashSum = $cashSum;
        $this->eCashSum = $eCashSum;
        $this->prepaymentSum = $prepaymentSum;
        $this->postpaymentSum = $postpaymentSum;
        $this->otherPaymentTypeSum = $otherPaymentTypeSum;
        $this->tax1Sum = $tax1Sum;
        $this->tax2Sum = $tax2Sum;
        $this->tax3Sum = $tax3Sum;
        $this->tax4Sum = $tax4Sum;
        $this->tax5Sum = $tax5Sum;
        $this->tax6Sum = $tax6Sum;
        $this->taxationSystem = $taxationSystem;
    }

    public function getCorrectionType(): int
    {
        return $this->correctionType;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCauseDocumentDate(): string
    {
        return $this->causeDocumentDate;
    }

    public function getCauseDocumentNumber(): string
    {
        return $this->causeDocumentNumber;
    }

    public function getTotalSum(): string
    {
        return $this->totalSum;
    }

    public function getCashSum(): string
    {
        return $this->cashSum;
    }

    public function getECashSum(): string
    {
        return $this->eCashSum;
    }

    public function getPrepaymentSum(): string
    {
        return $this->prepaymentSum;
    }

    public function getPostpaymentSum(): string
    {
        return $this->postpaymentSum;
    }

    public function getOtherPaymentTypeSum(): string
    {
        return $this->otherPaymentTypeSum;
    }

    public function getTax1Sum(): string
    {
        return $this->tax1Sum;
    }

    public function getTax2Sum(): string
    {
        return $this->tax2Sum;
    }

    public function getTax3Sum(): string
    {
        return $this->tax3Sum;
    }

    public function getTax4Sum(): string
    {
        return $this->tax4Sum;
    }

    public function getTax5Sum(): string
    {
        return $this->tax5Sum;
    }

    public function getTax6Sum(): string
    {
        return $this->tax6Sum;
    }

    public function getTaxationSystem(): int
    {
        return $this->taxationSystem;
    }

    public function getAutomatNumber(): ?string
    {
        return $this->automatNumber;
    }

    public function setAutomatNumber(?string $automatNumber): Content
    {
        Assertion::nullOrBetweenLength($automatNumber, 1, 20);

        $this->automatNumber = $automatNumber;

        return $this;
    }

    public function getSettlementAddress(): ?string
    {
        return $this->settlementAddress;
    }

    public function setSettlementAddress(?string $settlementAddress): Content
    {
        Assertion::nullOrBetweenLength($settlementAddress, 1, 243);

        $this->settlementAddress = $settlementAddress;

        return $this;
    }

    public function getSettlementPlace(): ?string
    {
        return $this->settlementPlace;
    }

    public function setSettlementPlace(?string $settlementPlace): Content
    {
        Assertion::nullOrBetweenLength($settlementPlace, 1, 243);

        $this->settlementPlace = $settlementPlace;

        return $this;
    }
}
