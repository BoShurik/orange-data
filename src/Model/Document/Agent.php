<?php
/**
 * User: boshurik
 * Date: 09.12.19
 * Time: 19:06
 */

namespace BoShurik\OrangeData\Model\Document;

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

    public function __construct()
    {
        throw new \LogicException('TBI');
    }
}
