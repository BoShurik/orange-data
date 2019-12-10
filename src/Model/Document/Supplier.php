<?php
/**
 * User: boshurik
 * Date: 09.12.19
 * Time: 19:05
 */

namespace BoShurik\OrangeData\Model\Document;

use BoShurik\OrangeData\Model\FactoryTrait;
use BoShurik\OrangeData\Model\JsonSerializableTrait;

class Supplier implements \JsonSerializable
{
    use JsonSerializableTrait;
    use FactoryTrait;

    public function __construct()
    {
        throw new \LogicException('TBI');
    }
}
