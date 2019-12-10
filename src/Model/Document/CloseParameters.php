<?php
/**
 * User: boshurik
 * Date: 09.12.19
 * Time: 19:04
 */

namespace BoShurik\OrangeData\Model\Document;

use Assert\Assertion;
use BoShurik\OrangeData\Model\FactoryTrait;
use BoShurik\OrangeData\Model\JsonSerializableTrait;

class CloseParameters implements \JsonSerializable
{
    use JsonSerializableTrait;
    use FactoryTrait;

    public const TAXATION_SYSTEM_COMMON = 0;
    public const TAXATION_SYSTEM_SIMPLIFIED = 1;
    public const TAXATION_SYSTEM_SIMPLIFIED_EXPENSE = 2;
    public const TAXATION_SYSTEM_IMPUTED = 3;
    public const TAXATION_SYSTEM_AGRICULTURE = 4;
    public const TAXATION_SYSTEM_PATENT = 5;

    /**
     * @var iterable
     */
    private $payments;

    /**
     * @var int
     */
    private $taxationSystem;

    /**
     * @param Payment[]|iterable $payments
     */
    public function __construct(iterable $payments, int $taxationSystem)
    {
        Assertion::minCount($payments, 1);
        Assertion::allIsInstanceOf($payments, Payment::class);
        Assertion::between($taxationSystem, 0, 5);

        $this->payments = $payments;
        $this->taxationSystem = $taxationSystem;
    }

    public function getPayments(): iterable
    {
        return $this->payments;
    }

    public function getTaxationSystem(): int
    {
        return $this->taxationSystem;
    }
}
