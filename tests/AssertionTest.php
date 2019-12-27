<?php
/**
 * User: boshurik
 * Date: 27.12.19
 * Time: 12:51
 */

namespace BoShurik\OrangeData\Tests;

use Assert\InvalidArgumentException;
use BoShurik\OrangeData\Assertion;
use PHPUnit\Framework\TestCase;

class AssertionTest extends TestCase
{
    /**
     * @dataProvider valid
     *
     * @param $value
     */
    public function testValid($value)
    {
        $this->assertTrue(Assertion::inn($value));
    }

    /**
     * @dataProvider invalid
     *
     * @param $value
     */
    public function testInvalid($value)
    {
        $this->expectException(InvalidArgumentException::class);

        Assertion::inn($value);
    }

    public function valid(): iterable
    {
        yield ['0123456789'];
        yield ['012345678912'];
    }

    public function invalid(): iterable
    {
        yield ['0'];
        yield [null];
    }
}
