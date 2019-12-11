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
     * @var Content
     */
    private $content;

    /**
     * @var string|null
     */
    private $callbackUrl;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string|null
     */
    private $group;

    public function __construct(string $id, string $inn, Content $content)
    {
        $this->id = $id;
        $this->inn = $inn;
        $this->key = $key ?? $inn;
        $this->content = $content;

        Assertion::betweenLength($this->id, 1, 64);
        Assertion::inArray(\strlen($this->inn), [10, 12]);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getInn(): string
    {
        return $this->inn;
    }

    public function getContent(): Content
    {
        return $this->content;
    }

    public function getCallbackUrl(): ?string
    {
        return $this->callbackUrl;
    }

    public function setCallbackUrl(?string $callbackUrl): Document
    {
        Assertion::nullOrBetweenLength($callbackUrl, 1, 1024);
        Assertion::nullOrUrl($callbackUrl);

        $this->callbackUrl = $callbackUrl;

        return $this;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): Document
    {
        Assertion::betweenLength($key, 1, 32);

        $this->key = $key;

        return $this;
    }

    public function getGroup(): ?string
    {
        return $this->group;
    }

    public function setGroup(?string $group): Document
    {
        Assertion::nullOrBetweenLength($group, 1, 32);

        $this->group = $group;

        return $this;
    }
}
