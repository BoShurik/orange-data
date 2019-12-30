<?php
/**
 * User: boshurik
 * Date: 09.12.19
 * Time: 19:05
 */

namespace BoShurik\OrangeData\Model\Document;

use BoShurik\OrangeData\Assertion;
use BoShurik\OrangeData\Model\FactoryTrait;
use BoShurik\OrangeData\Model\JsonSerializableTrait;

class UserAttribute implements \JsonSerializable
{
    use JsonSerializableTrait;
    use FactoryTrait;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    public function __construct(string $name, string $value)
    {
        Assertion::betweenLength($name, 1, 64);
        Assertion::betweenLength($value, 1, 234);
        Assertion::maxLength($name.$value, 235);

        $this->name = $name;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
