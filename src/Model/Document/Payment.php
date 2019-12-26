<?php
/**
 * User: boshurik
 * Date: 09.12.19
 * Time: 19:04
 */

namespace BoShurik\OrangeData\Model\Document;

use BoShurik\OrangeData\Assertion;
use BoShurik\OrangeData\Model\FactoryTrait;
use BoShurik\OrangeData\Model\JsonSerializableTrait;

class Payment implements \JsonSerializable
{
    use JsonSerializableTrait;
    use FactoryTrait;

    public const TYPE_CASH = 1;
    public const TYPE_CASHLESS = 2;
    public const TYPE_PREPAYMENT = 14;
    public const TYPE_POSTPAYMENT = 15;
    public const TYPE_BSO = 16;

    /**
     * @var int
     */
    private $type;

    /**
     * @var string
     */
    private $amount;

    public function __construct(int $type, string $amount)
    {
        Assertion::between($type, 1, 16);
        Assertion::numeric($amount);

        $this->type = $type;
        $this->amount = $amount;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }
}
