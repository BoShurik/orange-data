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
        ;

        $client->documentStatus('inn', 'document');
    }

    public function testCorrectionStatus()
    {
        $client = new Client($this->http);

        $this->http
            ->expects($this->once())
            ->method('get')
            ->with('/corrections/inn/status/document')
        ;

        $client->correctionStatus('inn', 'document');
    }
}
