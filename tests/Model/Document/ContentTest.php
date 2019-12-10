<?php
/**
 * User: boshurik
 * Date: 10.12.19
 * Time: 15:14
 */

namespace BoShurik\OrangeData\Tests\Model\Document;

use BoShurik\OrangeData\Model\Document\CloseParameters;
use BoShurik\OrangeData\Model\Document\Content;
use BoShurik\OrangeData\Model\Document\Position;
use BoShurik\OrangeData\Tests\Model\ModelTestCase;
use PHPUnit\Framework\MockObject\MockObject;

class ContentTest extends ModelTestCase
{
    /**
     * @var CloseParameters|MockObject
     */
    private $closeParameters;

    /**
     * @var Position|MockObject
     */
    private $position;

    protected function setUp(): void
    {
        $this->closeParameters = $this->createMock(CloseParameters::class);
        $this->closeParameters
            ->expects($this->atLeastOnce())
            ->method('jsonSerialize')
            ->willReturn([])
        ;

        $this->position = $this->createMock(Position::class);
        $this->position
            ->expects($this->atLeastOnce())
            ->method('jsonSerialize')
            ->willReturn([])
        ;
    }

    protected function getClass(): string
    {
        return Content::class;
    }

    protected function getFullParameters(): array
    {
        return [
            'type' => 1,
            'positions' => [$this->position],
            'checkClose' => $this->closeParameters,
            'customerContact' => 'customerContact',
            'agentType' => 127,
            'paymentTransferOperatorPhoneNumbers' => ['1234567890'],
            'paymentAgentOperation' => 'paymentAgentOperation',
            'paymentAgentPhoneNumbers' => ['1234567890'],
            'paymentOperatorPhoneNumbers' => ['1234567890'],
            'paymentOperatorName' => 'paymentOperatorName',
            'paymentOperatorAddress' => 'paymentOperatorAddress',
            'paymentOperatorINN' => '1234567890',
            'supplierPhoneNumbers' => ['1234567890'],
//            'additionalUserAttribute' => 'additionalUserAttribute',
            'automatNumber' => 'automatNumber',
            'settlementAddress' => 'settlementAddress',
            'settlementPlace' => 'settlementPlace',
            'customer' => 'customer',
            'customerINN' => '1234567890',
            'cashier' => 'cashier',
            'cashierINN' => '123456789012',
            'senderEmail' => 'senderEmail',
        ];
    }

    protected function getMinimalParameters(): array
    {
        return [
            'type' => 1,
            'positions' => [$this->position],
            'checkClose' => $this->closeParameters,
            'customerContact' => 'customerContact',
        ];
    }
}
