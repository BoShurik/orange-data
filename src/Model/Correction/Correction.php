<?php
/**
 * User: boshurik
 * Date: 09.12.19
 * Time: 19:01
 */

namespace BoShurik\OrangeData\Model\Correction;

use BoShurik\OrangeData\Model\FactoryTrait;
use BoShurik\OrangeData\Model\JsonSerializableTrait;

class Correction implements \JsonSerializable
{
    use JsonSerializableTrait;
    use FactoryTrait;

    public function __construct()
    {
        throw new \LogicException('TBI');
    }
}
