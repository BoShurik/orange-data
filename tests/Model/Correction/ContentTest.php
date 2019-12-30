<?php
/**
 * User: boshurik
 * Date: 30.12.19
 * Time: 15:54
 */

namespace BoShurik\OrangeData\Tests\Model\Correction;

use BoShurik\OrangeData\Model\Correction\Content;
use BoShurik\OrangeData\Tests\Model\ModelTestCase;

class ContentTest extends ModelTestCase
{
    protected function getClass(): string
    {
        return Content::class;
    }

    protected function getFullParameters(): array
    {
        return [
            'correctionType' => 0,
            'type' => 1,
            'description' => 'description',
            'causeDocumentDate' => '2017-08-10T00:00:00',
            'causeDocumentNumber' => 'causeDocumentNumber',
            'totalSum' => '1000',
            'cashSum' => '1000',
            'eCashSum' => '1000',
            'prepaymentSum' => '1000',
            'postpaymentSum' => '1000',
            'otherPaymentTypeSum' => '1000',
            'tax1Sum' => '10',
            'tax2Sum' => '10',
            'tax3Sum' => '10',
            'tax4Sum' => '10',
            'tax5Sum' => '10',
            'tax6Sum' => '10',
            'taxationSystem' => 0,
            'automatNumber' => 'automatNumber',
            'settlementAddress' => 'settlementAddress',
            'settlementPlace' => 'settlementPlace',
        ];
    }

    protected function getMinimalParameters(): array
    {
        return [
            'correctionType' => 0,
            'type' => 1,
            'description' => 'description',
            'causeDocumentDate' => '2017-08-10T00:00:00',
            'causeDocumentNumber' => 'causeDocumentNumber',
            'totalSum' => '1000',
            'cashSum' => '1000',
            'eCashSum' => '1000',
            'prepaymentSum' => '1000',
            'postpaymentSum' => '1000',
            'otherPaymentTypeSum' => '1000',
            'tax1Sum' => '10',
            'tax2Sum' => '10',
            'tax3Sum' => '10',
            'tax4Sum' => '10',
            'tax5Sum' => '10',
            'tax6Sum' => '10',
            'taxationSystem' => 0,
        ];
    }
}
