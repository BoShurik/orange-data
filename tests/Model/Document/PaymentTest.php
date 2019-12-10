<?php
/**
 * User: boshurik
 * Date: 10.12.19
 * Time: 15:15
 */

namespace BoShurik\OrangeData\Tests\Model\Document;

use BoShurik\OrangeData\Model\Document\Payment;
use BoShurik\OrangeData\Tests\Model\ModelTestCase;

class PaymentTest extends ModelTestCase
{
    protected function getClass(): string
    {
        return Payment::class;
    }

    protected function getFullParameters(): array
    {
        return [
            'type' => 1,
            'amount' => '10.10',
        ];
    }

    protected function getMinimalParameters(): array
    {
        return $this->getFullParameters();
    }
}
