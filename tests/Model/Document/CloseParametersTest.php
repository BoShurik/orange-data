<?php
/**
 * User: boshurik
 * Date: 10.12.19
 * Time: 15:14
 */

namespace BoShurik\OrangeData\Tests\Model\Document;

use BoShurik\OrangeData\Model\Document\CloseParameters;
use BoShurik\OrangeData\Model\Document\Payment;
use BoShurik\OrangeData\Tests\Model\ModelTestCase;
use PHPUnit\Framework\MockObject\MockObject;

class CloseParametersTest extends ModelTestCase
{
    /**
     * @var Payment|MockObject
     */
    private $payment;

    protected function setUp(): void
    {
        $this->payment = $this->createMock(Payment::class);
        $this->payment
            ->method('jsonSerialize')
            ->willReturn([])
        ;
    }

    protected function getClass(): string
    {
        return CloseParameters::class;
    }

    protected function getFullParameters(): array
    {
        return [
            'payments' => [$this->payment],
            'taxationSystem' => 0,
        ];
    }

    protected function getMinimalParameters(): array
    {
        return $this->getFullParameters();
    }
}
