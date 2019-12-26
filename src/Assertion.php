<?php
/**
 * User: boshurik
 * Date: 26.12.19
 * Time: 16:20
 */

namespace BoShurik\OrangeData;

class Assertion extends \Assert\Assertion
{
    const INVALID_INN = 1024;

    public static function inn($value, $message = null, string $propertyPath = null): bool
    {
        try {
            static::inArray(\strlen($value), [10, 12], null, $propertyPath);
        } catch (\Throwable $e) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not a valid INN. Expected length 10 or 12'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_INN, $propertyPath);
        }

        return true;
    }
}
