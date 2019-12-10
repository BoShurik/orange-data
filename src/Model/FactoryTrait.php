<?php
/**
 * User: boshurik
 * Date: 10.12.19
 * Time: 13:19
 */

namespace BoShurik\OrangeData\Model;

trait FactoryTrait
{
    public static function create(array $parameters): self
    {
        $reflectionClass = new \ReflectionClass(self::class);
        $constructorReflectionMethod = $reflectionClass->getMethod('__construct');
        $constructorParameters = [];
        foreach ($constructorReflectionMethod->getParameters() as $reflectionParameter) {
            $name = $reflectionParameter->getName();
            if (isset($parameters[$name])) {
                if ($reflectionParameterClass = $reflectionParameter->getClass()) {
                    $class = $reflectionParameterClass->getName();
                    if ($parameters[$name] instanceof $class) {
                        $constructorParameters[$name] = $parameters[$name];
                    } elseif (is_callable([$class, 'create']) && is_array($parameters[$name])) {
                        $constructorParameters[$name] = call_user_func_array([$class, 'create'], $parameters[$name]);
                    } else {
                        throw new \LogicException(sprintf('Wrong type for %s parameter', $name));
                    }
                } else {
                    $constructorParameters[$name] = $parameters[$name];
                }
            } elseif ($reflectionParameter->allowsNull()) {
                $constructorParameters[$name] = null;
            } else {
                throw new \LogicException(sprintf('Undefined %s parameter', $name));
            }
        }

        return $reflectionClass->newInstanceArgs($constructorParameters);
    }
}
