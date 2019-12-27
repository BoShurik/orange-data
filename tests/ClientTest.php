<?php
/**
 * User: boshurik
 * Date: 10.12.19
 * Time: 18:49
 */

namespace BoShurik\OrangeData\Tests;

use BoShurik\OrangeData\Client;
use BoShurik\OrangeData\Http\HttpClient;
use BoShurik\OrangeData\Model\Correction\Correction;
use BoShurik\OrangeData\Model\Document\Document;
use BoShurik\OrangeData\Model\Document\DocumentStatus;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * @var HttpClient|MockObject
     */
    private $http;

    protected function setUp(): void
    {
        $this->http = $this->createMock(HttpClient::class);
    }

    public function testDocument()
    {
        $client = new Client($this->http);

        $document = $this->createMock(Document::class);

        $this->http
            ->expects($this->once())
            ->method('post')
            ->with('/documents/', $document)
        ;

        $client->document($document);
    }

    public function testCorrection()
    {
        $client = new Client($this->http);

        $correction = $this->createMock(Correction::class);

        $this->http
            ->expects($this->once())
            ->method('post')
            ->with('/corrections/', $correction)
        ;

        $client->correction($correction);
    }

    public function testDocumentStatus()
    {
        $client = new Client($this->http);

        $this->http
            ->expects($this->once())
            ->method('get')
            ->with('/documents/inn/status/document')
            ->willReturn([
                'id' => 'id',
                'deviceSN' => 'deviceSN',
                'deviceRN' => 'deviceRN',
                'fsNumber' => 'fsNumber',
                'ofdName' => 'ofdName',
                'odfWebsite' => 'odfWebsite',
                'odfINN' => 'odfINN',
                'fnsWebsite' => 'fnsWebsite',
                'companyINN' => 'companyINN',
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
            ])
        ;

        $this->assertInstanceOf(DocumentStatus::class, $client->documentStatus('inn', 'document'));
    }

//    public function testCorrectionStatus()
//    {
//        $client = new Client($this->http);
//
//        $this->http
//            ->expects($this->once())
//            ->method('get')
//            ->with('/corrections/inn/status/document')
//        ;
//
//        $client->correctionStatus('inn', 'document');
//    }

    public function testDocumentStatusEmpty()
    {
        $client = new Client($this->http);

        $this->http
            ->expects($this->once())
            ->method('get')
            ->with('/documents/inn/status/document')
            ->willReturn([])
        ;

        $this->assertNull($client->documentStatus('inn', 'document'));
    }

    public function testCorrectionStatusEmpty()
    {
        $client = new Client($this->http);

        $this->http
            ->expects($this->once())
            ->method('get')
            ->with('/corrections/inn/status/document')
            ->willReturn([])
        ;

        $this->assertNull($client->correctionStatus('inn', 'document'));
    }
}
