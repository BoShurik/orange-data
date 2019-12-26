<?php
/**
 * User: boshurik
 * Date: 10.12.19
 * Time: 15:17
 */

namespace BoShurik\OrangeData\Tests\Model;

use PHPUnit\Framework\TestCase;

abstract class ModelTestCase extends TestCase
{
    public function testJsonSerializableFull()
    {
        $class = $this->getClass();

        /** @var \JsonSerializable $model */
        $model = $class::create($this->getFullParameters());
        $data = $model->jsonSerialize();

        $this->assertIsArray($data);

        $this->assertJsonSerializableFull($data);
    }

    public function testJsonSerializableMinimal()
    {
        $class = $this->getClass();

        /** @var \JsonSerializable $model */
        $model = $class::create($this->getMinimalParameters());
        $data = $model->jsonSerialize();

        $this->assertIsArray($data);

        $this->assertJsonSerializableMinimal($data);
    }

    public function testGetters()
    {
        $class = $this->getClass();

        /** @var \JsonSerializable $model */
        $model = $class::create($this->getFullParameters());
        foreach ($this->getGetterResults() as $field => $value) {
            $result = call_user_func([$model, $field]);
            if ($result instanceof \DateTimeInterface) {
                $this->assertEquals(new \DateTimeImmutable($value), $result);
            } elseif (is_scalar($result)) {
                $this->assertSame($value, $result);
            } else {
                // TODO: Assert class
            }
        }
    }

    protected function assertJsonSerializableFull(array $data)
    {
        foreach ($this->getFullResults() as $name => $value) {
            $this->assertArrayHasKey($name, $data);
            $this->assertSame($data[$name], $value);
        }
    }

    protected function assertJsonSerializableMinimal(array $data)
    {
        foreach ($this->getMinimalResults() as $name => $value) {
            $this->assertArrayHasKey($name, $data);
            $this->assertSame($data[$name], $value);
        }

        $diff = array_keys(array_diff_key($this->getMinimalResults(), $this->getFullResults()));
        foreach ($diff as $name) {
            $this->assertArrayNotHasKey($name, $data);
        }
    }

    protected function getFullResults(): array
    {
        return array_filter($this->getFullParameters(), function ($value) {
            return $this->useAsAResult($value);
        });
    }

    protected function getMinimalResults(): array
    {
        return array_filter($this->getMinimalParameters(), function ($value) {
            return $this->useAsAResult($value);
        });
    }

    protected function getGetterResults(): array
    {
        $results = [];
        foreach ($this->getFullResults() as $name => $value) {
            $results[sprintf('get%s', ucfirst($name))] = $value;
        }

        return $results;
    }

    abstract protected function getClass(): string;

    abstract protected function getFullParameters(): array;

    abstract protected function getMinimalParameters(): array;

    private function useAsAResult($value): bool
    {
        if (is_object($value)) {
            return false;
        }
        if (is_iterable($value)) {
            $first = current($value);

            return $this->useAsAResult($first);
        }

        return true;
    }
}
