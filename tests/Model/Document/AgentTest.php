<?php
/**
 * User: boshurik
 * Date: 30.12.19
 * Time: 14:53
 */

namespace BoShurik\OrangeData\Tests\Model\Document;

use BoShurik\OrangeData\Model\Document\Agent;
use BoShurik\OrangeData\Tests\Model\ModelTestCase;

class AgentTest extends ModelTestCase
{
    protected function getClass(): string
    {
        return Agent::class;
    }

    protected function getFullParameters(): array
    {
        return [
            'paymentTransferOperatorPhoneNumbers' => ['79991112233'],
            'paymentAgentOperation' => 'paymentAgentOperation',
            'paymentAgentPhoneNumbers' => ['79991112233'],
            'paymentOperatorPhoneNumbers' =>['79991112233'],
            'paymentOperatorName' => 'paymentOperatorName',
            'paymentOperatorAddress' => 'paymentOperatorAddress',
            'paymentOperatorINN' => '1234567890',
        ];
    }

    protected function getMinimalParameters(): array
    {
        return [];
    }
}
