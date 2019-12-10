<?php
/**
 * User: boshurik
 * Date: 10.12.19
 * Time: 15:15
 */

namespace BoShurik\OrangeData\Tests\Model\Document;

use BoShurik\OrangeData\Model\Document\Position;
use BoShurik\OrangeData\Tests\Model\ModelTestCase;

class PositionTest extends ModelTestCase
{
    protected function getClass(): string
    {
        return Position::class;
    }

    protected function getFullParameters(): array
    {
        return [
            'quantity' => '1',
            'price' => '10.10',
            'tax' => 1,
            'text' => 'text',
            'paymentMethodType' => 1,
            'paymentSubjectType' => 1,
            'nomenclatureCode' => 'nomenclatureCode',
//            'supplierInfo' => 'supplierInfo',
            'supplierINN' => '1234567890',
            'agentType' => 127,
//            'agentInfo' => 'agentInfo',
            'unitOfMeasurement' => 'unit',
            'additionalAttribute' => 'additionalAttribute',
            'manufacturerCountryCode' => '123',
            'customsDeclarationNumber' => 'customsDeclarationNumber',
            'excise' => '10.10',
        ];
    }

    protected function getMinimalParameters(): array
    {
        return [
            'quantity' => '1',
            'price' => '10.10',
            'tax' => 1,
            'text' => 'text',
        ];
    }
}
