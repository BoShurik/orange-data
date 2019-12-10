<?php
/**
 * User: boshurik
 * Date: 09.12.19
 * Time: 19:02
 */

namespace BoShurik\OrangeData\Model\Document;

use Assert\Assertion;
use BoShurik\OrangeData\Model\FactoryTrait;
use BoShurik\OrangeData\Model\JsonSerializableTrait;

class Content implements \JsonSerializable
{
    public const TYPE_IN = 1;
    public const TYPE_IN_REFUND = 2;
    public const TYPE_OUT = 3;
    public const TYPE_OUT_REFUND = 4;

    use JsonSerializableTrait;
    use FactoryTrait;

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
        string $customerContact,
        ?int $agentType = null,
        ?iterable $paymentTransferOperatorPhoneNumbers = null,
        ?string $paymentAgentOperation = null,
        ?iterable $paymentAgentPhoneNumbers = null,
        ?iterable $paymentOperatorPhoneNumbers = null,
        ?string $paymentOperatorName = null,
        ?string $paymentOperatorAddress = null,
        ?string $paymentOperatorINN = null,
        ?iterable $supplierPhoneNumbers = null,
        ?UserAttribute $additionalUserAttribute = null,
        ?string $automatNumber = null,
        ?string $settlementAddress = null,
        ?string $settlementPlace = null,
        ?string $customer = null,
        ?string $customerINN = null,
        ?string $cashier = null,
        ?string $cashierINN = null,
        ?string $senderEmail = null
    ) {
        Assertion::between($type, 1, 4);
        Assertion::minCount($positions, 1);
        Assertion::allIsInstanceOf($positions, Position::class);
        Assertion::betweenLength($customerContact, 1, 64);
        Assertion::nullOrBetween($agentType, 1, 127);
        if ($paymentTransferOperatorPhoneNumbers !== null) {
            Assertion::allBetweenLength($paymentTransferOperatorPhoneNumbers, 1, 19);
        }
        Assertion::nullOrBetweenLength($paymentAgentOperation, 1, 24);
        if ($paymentAgentPhoneNumbers !== null) {
            Assertion::allBetweenLength($paymentAgentPhoneNumbers, 1, 19);
        }
        if ($paymentOperatorPhoneNumbers !== null) {
            Assertion::allBetweenLength($paymentOperatorPhoneNumbers, 1, 19);
        }
        Assertion::nullOrBetweenLength($paymentOperatorName, 1, 64);
        Assertion::nullOrBetweenLength($paymentOperatorAddress, 1, 243);
        if ($paymentOperatorINN !== null) {
            Assertion::inArray(\strlen($paymentOperatorINN), [10, 12]);
        }
        if ($supplierPhoneNumbers !== null) {
            Assertion::allBetweenLength($supplierPhoneNumbers, 1, 19);
        }
        Assertion::nullOrBetweenLength($automatNumber, 1, 20);
        Assertion::nullOrBetweenLength($settlementAddress, 1, 243);
        Assertion::nullOrBetweenLength($settlementPlace, 1, 243);
        Assertion::nullOrBetweenLength($customer, 1, 243);
        if ($customerINN !== null) {
            Assertion::inArray(\strlen($customerINN), [10, 12]);
        }
        Assertion::nullOrBetweenLength($cashier, 1, 64);
        Assertion::nullOrLength($cashierINN, 12);
        Assertion::nullOrBetweenLength($senderEmail, 1, 64);

        $this->type = $type;
        $this->positions = $positions;
        $this->checkClose = $checkClose;
        $this->customerContact = $customerContact;
        $this->agentType = $agentType;
        $this->paymentTransferOperatorPhoneNumbers = $paymentTransferOperatorPhoneNumbers;
        $this->paymentAgentOperation = $paymentAgentOperation;
        $this->paymentAgentPhoneNumbers = $paymentAgentPhoneNumbers;
        $this->paymentOperatorPhoneNumbers = $paymentOperatorPhoneNumbers;
        $this->paymentOperatorName = $paymentOperatorName;
        $this->paymentOperatorAddress = $paymentOperatorAddress;
        $this->paymentOperatorINN = $paymentOperatorINN;
        $this->supplierPhoneNumbers = $supplierPhoneNumbers;
        $this->additionalUserAttribute = $additionalUserAttribute;
        $this->automatNumber = $automatNumber;
        $this->settlementAddress = $settlementAddress;
        $this->settlementPlace = $settlementPlace;
        $this->customer = $customer;
        $this->customerINN = $customerINN;
        $this->cashier = $cashier;
        $this->cashierINN = $cashierINN;
        $this->senderEmail = $senderEmail;
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

    public function getPaymentTransferOperatorPhoneNumbers(): ?iterable
    {
        return $this->paymentTransferOperatorPhoneNumbers;
    }

    public function getPaymentAgentOperation(): ?string
    {
        return $this->paymentAgentOperation;
    }

    public function getPaymentAgentPhoneNumbers(): ?iterable
    {
        return $this->paymentAgentPhoneNumbers;
    }

    public function getPaymentOperatorPhoneNumbers(): ?iterable
    {
        return $this->paymentOperatorPhoneNumbers;
    }

    public function getPaymentOperatorName(): ?string
    {
        return $this->paymentOperatorName;
    }

    public function getPaymentOperatorAddress(): ?string
    {
        return $this->paymentOperatorAddress;
    }

    public function getPaymentOperatorINN(): ?string
    {
        return $this->paymentOperatorINN;
    }

    public function getSupplierPhoneNumbers(): ?iterable
    {
        return $this->supplierPhoneNumbers;
    }

    public function getAdditionalUserAttribute(): ?UserAttribute
    {
        return $this->additionalUserAttribute;
    }

    public function getAutomatNumber(): ?string
    {
        return $this->automatNumber;
    }

    public function getSettlementAddress(): ?string
    {
        return $this->settlementAddress;
    }

    public function getSettlementPlace(): ?string
    {
        return $this->settlementPlace;
    }

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function getCustomerINN(): ?string
    {
        return $this->customerINN;
    }

    public function getCashier(): ?string
    {
        return $this->cashier;
    }

    public function getCashierINN(): ?string
    {
        return $this->cashierINN;
    }

    public function getSenderEmail(): ?string
    {
        return $this->senderEmail;
    }
}
