<?php
/**
 * User: boshurik
 * Date: 30.12.19
 * Time: 14:54
 */

namespace BoShurik\OrangeData\Tests\Model\Document;

use BoShurik\OrangeData\Model\Document\Supplier;
use BoShurik\OrangeData\Tests\Model\ModelTestCase;

class SupplierTest extends ModelTestCase
{
    protected function getClass(): string
    {
        return Supplier::class;
    }

    protected function getFullParameters(): array
    {
        return [
            'phoneNumbers' => ['79991112233'],
            'name' => 'name',
        ];
    }

    protected function getMinimalParameters(): array
    {
        return $this->getFullParameters();
    }
}
