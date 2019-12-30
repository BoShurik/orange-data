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

class Supplier implements \JsonSerializable
{
    use JsonSerializableTrait;
    use FactoryTrait;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string[]|iterable|null
     */
    private $phoneNumbers;

    public function __construct(string $name, ?iterable $phoneNumbers)
    {
        $maxNameLength = 239;
        if ($phoneNumbers !== null) {
            Assertion::allBetweenLength($phoneNumbers, 1, 19);
            $maxNameLength -= array_sum(array_map('strlen', $phoneNumbers));
        }
        Assertion::betweenLength($name, 1, $maxNameLength);

        $this->name = $name;
        $this->phoneNumbers = $phoneNumbers;
    }

    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
