<?php
/**
 * User: boshurik
 * Date: 26.12.19
 * Time: 19:07
 */

namespace BoShurik\OrangeData\Tests\Model\Document;

use BoShurik\OrangeData\Model\Document\DocumentStatus;
use BoShurik\OrangeData\Tests\Model\ModelTestCase;

class DocumentStatusTest extends ModelTestCase
{
    protected function getClass(): string
    {
        return DocumentStatus::class;
    }

    protected function getFullParameters(): array
    {
        return [
            'id' => 'id',
            'deviceSN' => 'deviceSN',
            'deviceRN' => 'deviceRN',
            'fsNumber' => 'fsNumber',
            'ofdName' => 'ofdName',
            'ofdWebsite' => 'ofdWebsite',
            'ofdinn' => '0123456789',
            'fnsWebsite' => 'fnsWebsite',
            'companyINN' => '0123456789',
            'companyName' => 'companyName',
            'documentNumber' => 10,
            'shiftNumber' => 10,
            'documentIndex' => 10,
            'processedAt' => '2000-10-10T00:00:00+04:00',
            'content' => [
                'type' => 1,
                'positions' => [
                    [
                        'quantity' => '1',
                        'price' => '10.10',
                        'tax' => 1,
                        'text' => 'text',
                        'paymentMethodType' => 1,
                        'paymentSubjectType' => 1,
                        'nomenclatureCode' => 'nomenclatureCode',
                        'supplierINN' => '1234567890',
                        'agentType' => 127,
                        'unitOfMeasurement' => 'unit',
                        'additionalAttribute' => 'additionalAttribute',
                        'manufacturerCountryCode' => '123',
                        'customsDeclarationNumber' => 'customsDeclarationNumber',
                        'excise' => '10.10',
                    ]
                ],
                'checkClose' => [
                    'payments' => [
                        [
                            'type' => 1,
                            'amount' => '10.10',
                        ]
                    ],
                    'taxationSystem' => 0,
                ],
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
                'automatNumber' => 'automatNumber',
                'settlementAddress' => 'settlementAddress',
                'settlementPlace' => 'settlementPlace',
                'customer' => 'customer',
                'customerINN' => '1234567890',
                'cashier' => 'cashier',
                'cashierINN' => '123456789012',
                'senderEmail' => 'senderEmail',
            ],
            'change' => 'change',
            'fp' => 'fp',
            'callbackUrl' => 'callbackUrl',
        ];
    }

    protected function getMinimalParameters(): array
    {
        return $this->getFullParameters();
    }

    protected function getFullResults(): array
    {
        $results = parent::getFullResults();
        if (isset($results['ofdinn'])) {
            $results['ofdINN'] = $results['ofdinn'];
            unset($results['ofdinn']);
        }

        return $results;
    }

    protected function getMinimalResults(): array
    {
        $results = parent::getFullResults();
        if (isset($results['ofdinn'])) {
            $results['ofdINN'] = $results['ofdinn'];
            unset($results['ofdinn']);
        }

        return $results;
    }
}
