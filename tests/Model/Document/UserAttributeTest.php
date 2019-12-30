<?php
/**
 * User: boshurik
 * Date: 30.12.19
 * Time: 14:54
 */

namespace BoShurik\OrangeData\Tests\Model\Document;

use BoShurik\OrangeData\Model\Document\UserAttribute;
use BoShurik\OrangeData\Tests\Model\ModelTestCase;

class UserAttributeTest extends ModelTestCase
{
    protected function getClass(): string
    {
        return UserAttribute::class;
    }

    protected function getFullParameters(): array
    {
        return [
            'name' => 'name',
            'value' => 'value',
        ];
    }

    protected function getMinimalParameters(): array
    {
        return $this->getFullParameters();
    }
}
