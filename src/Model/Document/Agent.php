<?php
/**
 * User: boshurik
 * Date: 09.12.19
 * Time: 19:06
 */

namespace BoShurik\OrangeData\Model\Document;

use BoShurik\OrangeData\Assertion;
use BoShurik\OrangeData\Model\FactoryTrait;
use BoShurik\OrangeData\Model\JsonSerializableTrait;

class Agent implements \JsonSerializable
{
    public const TYPE_BANK_AGENT = 0x1;
    public const TYPE_BANK_SUBAGENT = 0x2;
    public const TYPE_AGENT = 0x4;
    public const TYPE_SUBAGENT = 0x8;
    public const TYPE_ATTORNEY = 0x10;
    public const TYPE_COMMISSION_AGENT = 0x20;
    public const TYPE_OTHER = 0x40;

    use JsonSerializableTrait;
    use FactoryTrait;

    /**
     * @var string[]|null
     */
    private $paymentTransferOperatorPhoneNumbers;

    /**
     * @var string|null
     */
    private $paymentAgentOperation;

    /**
     * @var string[]|null
     */
    private $paymentAgentPhoneNumbers;

    /**
     * @var string[]|null
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

    public function __construct()
    {
    }

    public function getPaymentTransferOperatorPhoneNumbers(): ?array
    {
        return $this->paymentTransferOperatorPhoneNumbers;
    }

    public function setPaymentTransferOperatorPhoneNumbers(?array $paymentTransferOperatorPhoneNumbers): Agent
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

    public function setPaymentAgentOperation(?string $paymentAgentOperation): Agent
    {
        Assertion::nullOrBetweenLength($paymentAgentOperation, 1, 24);

        $this->paymentAgentOperation = $paymentAgentOperation;

        return $this;
    }

    public function getPaymentAgentPhoneNumbers(): ?array
    {
        return $this->paymentAgentPhoneNumbers;
    }

    public function setPaymentAgentPhoneNumbers(?array $paymentAgentPhoneNumbers): Agent
    {
        if ($paymentAgentPhoneNumbers !== null) {
            Assertion::allBetweenLength($paymentAgentPhoneNumbers, 1, 19);
        }

        $this->paymentAgentPhoneNumbers = $paymentAgentPhoneNumbers;

        return $this;
    }

    public function getPaymentOperatorPhoneNumbers(): ?array
    {
        return $this->paymentOperatorPhoneNumbers;
    }

    public function setPaymentOperatorPhoneNumbers(?array $paymentOperatorPhoneNumbers): Agent
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

    public function setPaymentOperatorName(?string $paymentOperatorName): Agent
    {
        Assertion::nullOrBetweenLength($paymentOperatorName, 1, 64);

        $this->paymentOperatorName = $paymentOperatorName;

        return $this;
    }

    public function getPaymentOperatorAddress(): ?string
    {
        return $this->paymentOperatorAddress;
    }

    public function setPaymentOperatorAddress(?string $paymentOperatorAddress): Agent
    {
        Assertion::nullOrBetweenLength($paymentOperatorAddress, 1, 243);

        $this->paymentOperatorAddress = $paymentOperatorAddress;

        return $this;
    }

    public function getPaymentOperatorINN(): ?string
    {
        return $this->paymentOperatorINN;
    }

    public function setPaymentOperatorINN(?string $paymentOperatorINN): Agent
    {
        Assertion::nullOrInn($paymentOperatorINN);

        $this->paymentOperatorINN = $paymentOperatorINN;

        return $this;
    }
}
