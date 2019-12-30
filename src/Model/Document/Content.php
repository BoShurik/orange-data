<?php
/**
 * User: boshurik
 * Date: 09.12.19
 * Time: 19:02
 */

namespace BoShurik\OrangeData\Model\Document;

use BoShurik\OrangeData\Assertion;
use BoShurik\OrangeData\Model\FactoryTrait;
use BoShurik\OrangeData\Model\JsonSerializableTrait;

class Content implements \JsonSerializable
{
    public const TYPE_IN = 1;
    public const TYPE_IN_REFUND = 2;
    public const TYPE_OUT = 3;
    public const TYPE_OUT_REFUND = 4;

    use JsonSerializableTrait;
    use FactoryTrait {
        getMapping as doGetMapping;
    }

    /**
     * @var int
     */
    private $type;

    /**
     * @var Position[]|iterable
     */
    private $positions;

    /**
     * @var CloseParameters
     */
    private $checkClose;

    /**
     * @var string
     */
    private $customerContact;

    /**
     * @var int|null
     */
    private $agentType;

    /**
     * @var iterable|null
     */
    private $paymentTransferOperatorPhoneNumbers;

    /**
     * @var string|null
     */
    private $paymentAgentOperation;

    /**
     * @var iterable|null
     */
    private $paymentAgentPhoneNumbers;

    /**
     * @var iterable|null
     */
    private $paymentOperatorPhoneNumbers;

    /**
     * @var string|null
     */
    private $paymentOperatorName;

    /**
     * @var string|null
     */
    private $paymentOperatorAddress;

    /**
     * @var string|null
     */
    private $paymentOperatorINN;

    /**
     * @var iterable|null
     */
    private $supplierPhoneNumbers;

    /**
     * @var UserAttribute|null
     */
    private $additionalUserAttribute;

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

    /**
     * @var string|null
     */
    private $customer;

    /**
     * @var string|null
     */
    private $customerINN;

    /**
     * @var string|null
     */
    private $cashier;

    /**
     * @var string|null
     */
    private $cashierINN;

    /**
     * @var string|null
     */
    private $senderEmail;

    /**
     * @param Position[]|iterable $positions
     */
    public function __construct(
        int $type,
        iterable $positions,
        CloseParameters $checkClose,
        string $customerContact
    ) {
        Assertion::between($type, 1, 4);
        Assertion::minCount($positions, 1);
        Assertion::allIsInstanceOf($positions, Position::class);
        Assertion::betweenLength($customerContact, 1, 64);

        $this->type = $type;
        $this->positions = $positions;
        $this->checkClose = $checkClose;
        $this->customerContact = $customerContact;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getPositions()
    {
        return $this->positions;
    }

    public function getCheckClose(): CloseParameters
    {
        return $this->checkClose;
    }

    public function getCustomerContact(): string
    {
        return $this->customerContact;
    }

    public function getAgentType(): ?int
    {
        return $this->agentType;
    }

    public function setAgentType(?int $agentType): Content
    {
        Assertion::nullOrBetween($agentType, 1, 127);

        $this->agentType = $agentType;

        return $this;
    }

    public function getPaymentTransferOperatorPhoneNumbers(): ?iterable
    {
        return $this->paymentTransferOperatorPhoneNumbers;
    }

    public function setPaymentTransferOperatorPhoneNumbers(?iterable $paymentTransferOperatorPhoneNumbers): Content
    {
        if ($paymentTransferOperatorPhoneNumbers !== null) {
            Assertion::allBetweenLength($paymentTransferOperatorPhoneNumbers, 1, 19);
        }

        $this->paymentTransferOperatorPhoneNumbers = $paymentTransferOperatorPhoneNumbers;

        return $this;
    }

    public function getPaymentAgentOperation(): ?string
    {
        return $this->paymentAgentOperation;
    }

    public function setPaymentAgentOperation(?string $paymentAgentOperation): Content
    {
        Assertion::nullOrBetweenLength($paymentAgentOperation, 1, 24);

        $this->paymentAgentOperation = $paymentAgentOperation;

        return $this;
    }

    public function getPaymentAgentPhoneNumbers(): ?iterable
    {
        return $this->paymentAgentPhoneNumbers;
    }

    public function setPaymentAgentPhoneNumbers(?iterable $paymentAgentPhoneNumbers): Content
    {
        if ($paymentAgentPhoneNumbers !== null) {
            Assertion::allBetweenLength($paymentAgentPhoneNumbers, 1, 19);
        }

        $this->paymentAgentPhoneNumbers = $paymentAgentPhoneNumbers;

        return $this;
    }

    public function getPaymentOperatorPhoneNumbers(): ?iterable
    {
        return $this->paymentOperatorPhoneNumbers;
    }

    public function setPaymentOperatorPhoneNumbers(?iterable $paymentOperatorPhoneNumbers): Content
    {
        if ($paymentOperatorPhoneNumbers !== null) {
            Assertion::allBetweenLength($paymentOperatorPhoneNumbers, 1, 19);
        }

        $this->paymentOperatorPhoneNumbers = $paymentOperatorPhoneNumbers;

        return $this;
    }

    public function getPaymentOperatorName(): ?string
    {
        return $this->paymentOperatorName;
    }

    public function setPaymentOperatorName(?string $paymentOperatorName): Content
    {
        Assertion::nullOrBetweenLength($paymentOperatorName, 1, 64);

        $this->paymentOperatorName = $paymentOperatorName;

        return $this;
    }

    public function getPaymentOperatorAddress(): ?string
    {
        return $this->paymentOperatorAddress;
    }

    public function setPaymentOperatorAddress(?string $paymentOperatorAddress): Content
    {
        Assertion::nullOrBetweenLength($paymentOperatorAddress, 1, 243);

        $this->paymentOperatorAddress = $paymentOperatorAddress;

        return $this;
    }

    public function getPaymentOperatorINN(): ?string
    {
        return $this->paymentOperatorINN;
    }

    public function setPaymentOperatorINN(?string $paymentOperatorINN): Content
    {
        if ($paymentOperatorINN !== null) {
            Assertion::inn($paymentOperatorINN);
        }

        $this->paymentOperatorINN = $paymentOperatorINN;

        return $this;
    }

    public function getSupplierPhoneNumbers(): ?iterable
    {
        return $this->supplierPhoneNumbers;
    }

    public function setSupplierPhoneNumbers(?iterable $supplierPhoneNumbers): Content
    {
        if ($supplierPhoneNumbers !== null) {
            Assertion::allBetweenLength($supplierPhoneNumbers, 1, 19);
        }

        $this->supplierPhoneNumbers = $supplierPhoneNumbers;

        return $this;
    }

    public function getAdditionalUserAttribute(): ?UserAttribute
    {
        return $this->additionalUserAttribute;
    }

    public function setAdditionalUserAttribute(?UserAttribute $additionalUserAttribute): Content
    {
        $this->additionalUserAttribute = $additionalUserAttribute;

        return $this;
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

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function setCustomer(?string $customer): Content
    {
        Assertion::nullOrBetweenLength($customer, 1, 243);

        $this->customer = $customer;

        return $this;
    }

    public function getCustomerINN(): ?string
    {
        return $this->customerINN;
    }

    public function setCustomerINN(?string $customerINN): Content
    {
        if ($customerINN !== null) {
            Assertion::inn($customerINN);
        }

        $this->customerINN = $customerINN;

        return $this;
    }

    public function getCashier(): ?string
    {
        return $this->cashier;
    }

    public function setCashier(?string $cashier): Content
    {
        Assertion::nullOrBetweenLength($cashier, 1, 64);

        $this->cashier = $cashier;

        return $this;
    }

    public function getCashierINN(): ?string
    {
        return $this->cashierINN;
    }

    public function setCashierINN(?string $cashierINN): Content
    {
        Assertion::nullOrLength($cashierINN, 12);

        $this->cashierINN = $cashierINN;

        return $this;
    }

    public function getSenderEmail(): ?string
    {
        return $this->senderEmail;
    }

    public function setSenderEmail(?string $senderEmail): Content
    {
        Assertion::nullOrBetweenLength($senderEmail, 1, 64);

        $this->senderEmail = $senderEmail;

        return $this;
    }

    protected static function getMapping(\ReflectionClass $reflectionClass): array
    {
        $mapping = self::doGetMapping($reflectionClass);
        $mapping['positions'] = Position::class.'[]';
        $mapping['additionalUserAttribute'] = '?'.UserAttribute::class;

        return $mapping;
    }
}
