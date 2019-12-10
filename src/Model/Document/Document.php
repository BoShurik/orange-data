<?php
/**
 * User: boshurik
 * Date: 09.12.19
 * Time: 19:01
 */

namespace BoShurik\OrangeData\Model\Document;

use Assert\Assertion;
use BoShurik\OrangeData\Model\FactoryTrait;
use BoShurik\OrangeData\Model\JsonSerializableTrait;

class Document implements \JsonSerializable
{
    use JsonSerializableTrait;
    use FactoryTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $inn;

    /**
     * @var string
     */
    private $key;

    /**
     * @var Content
     */
    private $content;

    /**
     * @var string|null
     */
    private $callbackUrl;

    /**
     * @var string|null
     */
    private $group;

    public function __construct(string $id, string $inn, Content $content, ?string $callbackUrl = null, ?string $key = null, ?string $group = null)
    {
        $this->id = $id;
        $this->inn = $inn;
        $this->key = $key ?? $inn;
        $this->content = $content;
        $this->callbackUrl = $callbackUrl;
        $this->group = $group;

        Assertion::betweenLength($this->id, 1, 64);
        Assertion::inArray(\strlen($this->inn), [10, 12]);
        Assertion::betweenLength($this->key, 1, 32);
        Assertion::nullOrBetweenLength($this->callbackUrl, 1, 1024);
        Assertion::nullOrBetweenLength($this->group, 1, 32);
        Assertion::nullOrUrl($this->callbackUrl);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getInn(): string
    {
        return $this->inn;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getContent(): Content
    {
        return $this->content;
    }

    public function getCallbackUrl(): ?string
    {
        return $this->callbackUrl;
    }

    public function getGroup(): ?string
    {
        return $this->group;
    }
}
