<?php
/**
 * User: boshurik
 * Date: 10.12.19
 * Time: 13:19
 */

namespace BoShurik\OrangeData\Model;

use BoShurik\OrangeData\Assertion;

trait FactoryTrait
{
    public static function create(array $parameters): self
    {
        $reflectionClass = new \ReflectionClass(self::class);
        $mapping = self::getMapping($reflectionClass);

        $constructorParameters = [];
        $classParameters = [];
        foreach ($mapping as $name => $type) {
            if ($type === true) {
                Assertion::keyExists($parameters, $name);

                $constructorParameters[$name] = $parameters[$name];
            } elseif (is_string($type) && substr($type, 0, 1) !== '?') {
                Assertion::keyExists($parameters, $name);

                $constructorParameters[$name] = self::processValue($type, $parameters[$name]);
            } elseif (isset($parameters[$name])) {
                $classParameters[$name] = self::processValue($type, $parameters[$name]);
            }
        }

        /** @var self $instance */
        $instance = $reflectionClass->newInstanceArgs($constructorParameters);

        foreach ($classParameters as $name => $value) {
            $method = sprintf('set%s', ucfirst($name));
            call_user_func([$instance, $method], self::processValue($mapping[$name], $parameters[$name]));
        }

        return $instance;
    }

    protected static function getMapping(\ReflectionClass $reflectionClass): array
    {
        $fields = [];

        foreach ($reflectionClass->getProperties() as $reflectionProperty) {
            $fields[$reflectionProperty->getName()] = false;
        }

        $constructorReflectionMethod = $reflectionClass->getMethod('__construct');
        // Assume properties and constructor parameters have same names
        foreach ($constructorReflectionMethod->getParameters() as $reflectionParameter) {
            if ($reflectionParameter->getClass()) {
                $fields[$reflectionParameter->getName()] = sprintf('%s%s', $reflectionParameter->allowsNull() ? '?' : '', $reflectionParameter->getClass()->getName());
            } elseif (!$reflectionParameter->allowsNull()) {
                $fields[$reflectionParameter->getName()] = true;
            }
        }

        return $fields;
    }

    private static function processValue($type, $value)
    {
        if (is_bool($type)) {
            return $value;
        }

        $iterable = substr($type, -2) === '[]';
        $optional = substr($type, 0, 1) === '?';
        if ($iterable) {
            $class = substr($type, $optional ? 1 : 0, -2);
        } else {
            $class = substr($type, $optional ? 1 : 0);
        }

        if ($optional && $value === null) {
            return $value;
        }

        if ($iterable) {
            if (is_array($value)) {
                $value = array_map(function ($data) use ($class) {
                    if (is_array($data)) {
                        return call_user_func([$class, 'create'], $data);
                    }

                    return $data;
                }, $value);
            }

            Assertion::allIsInstanceOf($value, $class);
        } else {
            if (is_array($value)) {
                $value = call_user_func([$class, 'create'], $value);
            }

            Assertion::isInstanceOf($value, $class);
        }

        return $value;
    }
}
