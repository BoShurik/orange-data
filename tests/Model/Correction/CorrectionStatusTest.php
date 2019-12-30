<?php
/**
 * User: boshurik
 * Date: 30.12.19
 * Time: 16:11
 */

namespace BoShurik\OrangeData\Tests\Model\Correction;

use BoShurik\OrangeData\Model\Correction\CorrectionStatus;
use BoShurik\OrangeData\Tests\Model\ModelTestCase;

class CorrectionStatusTest extends ModelTestCase
{
    protected function getClass(): string
    {
        return CorrectionStatus::class;
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
