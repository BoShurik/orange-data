<?php
/**
 * User: boshurik
 * Date: 26.12.19
 * Time: 18:21
 */

namespace BoShurik\OrangeData\Tests\Http;

use BoShurik\OrangeData\Exception\ResponseException;
use BoShurik\OrangeData\Http\HttpClient;
use BoShurik\OrangeData\Http\Signer;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class HttpClientTest extends TestCase
{
    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @var MockHandler
     */
    private $responses;

    /**
     * @var array
     */
    private $requests;

    /**
     * @var Signer|MockObject
     */
    private $signer;

    /**
     * @var LoggerInterface|MockObject
     */
    private $logger;

    protected function setUp(): void
    {
        $this->responses = new MockHandler();
        $this->requests = [];
        $history = Middleware::history($this->requests);
        $handlerStack = HandlerStack::create($this->responses);
        $handlerStack->push($history);

        $this->signer = $this->createMock(Signer::class);
        $this->logger = $this->createMock(LoggerInterface::class);

        $this->client = new HttpClient(new Client([
            'handler' => $handlerStack,
        ]), $this->signer, $this->logger);
    }

    public function testPost()
    {
        $this->responses->append(new Response());

        $this->signer
            ->expects($this->once())
            ->method('sign')
            ->with('{}')
            ->willReturn('sign')
        ;

        $this->logger
            ->expects($this->once())
            ->method('debug')
            ->with('POST request to /uri')
        ;

        $this->client->post('/uri', new \stdClass());

        $this->assertCount(1, $this->requests);
        /** @var Request $request */
        $request = $this->requests[0]['request'];

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('uri', $request->getUri()->getPath());
        $this->assertSame(['application/json'], $request->getHeader('Content-Type'));
        $this->assertSame(['sign'], $request->getHeader('X-Signature'));
        $this->assertSame('{}', (string)$request->getBody());
    }

    public function testPostException()
    {
        $this->responses->append(new Response(400, [], 'Exception'));

        $this->signer
            ->expects($this->once())
            ->method('sign')
            ->with('{}')
            ->willReturn('sign')
        ;

        $this->logger
            ->expects($this->once())
            ->method('debug')
            ->with('POST request to /uri')
        ;

        $this->logger
            ->expects($this->once())
            ->method('error')
            ->with('Exception')
        ;

        $this->expectException(ResponseException::class);
        $this->expectExceptionMessage('Exception');
        $this->expectExceptionCode(400);

        $this->client->post('/uri', new \stdClass());

        $this->assertCount(1, $this->requests);
        /** @var Request $request */
        $request = $this->requests[0]['request'];

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('uri', $request->getUri()->getPath());
        $this->assertSame(['application/json'], $request->getHeader('Content-Type'));
        $this->assertSame(['sign'], $request->getHeader('X-Signature'));
        $this->assertSame('{}', (string)$request->getBody());
    }

    public function testGet()
    {
        $this->responses->append(new Response(200, [], '["test"]'));

        $this->signer
            ->expects($this->never())
            ->method('sign')
        ;

        $this->logger
            ->expects($this->once())
            ->method('debug')
            ->with('GET request to /uri')
        ;

        $response = $this->client->get('/uri');

        $this->assertCount(1, $this->requests);
        /** @var Request $request */
        $request = $this->requests[0]['request'];

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('uri', $request->getUri()->getPath());

        $this->assertSame(['test'], $response);
    }

    public function testGetException()
    {
        $this->responses->append(new Response(400, [], 'Exception'));

        $this->signer
            ->expects($this->never())
            ->method('sign')
        ;

        $this->logger
            ->expects($this->once())
            ->method('debug')
            ->with('GET request to /uri')
        ;

        $this->expectException(ResponseException::class);
        $this->expectExceptionMessage(400);
        $this->expectExceptionCode(400);

        $this->client->get('/uri');

        $this->assertCount(1, $this->requests);
        /** @var Request $request */
        $request = $this->requests[0]['request'];

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('uri', $request->getUri()->getPath());
    }

    public function testGet202()
    {
        $this->responses->append(new Response(202));

        $this->signer
            ->expects($this->never())
            ->method('sign')
        ;

        $this->logger
            ->expects($this->once())
            ->method('debug')
            ->with('GET request to /uri')
        ;

        $response = $this->client->get('/uri');

        $this->assertCount(1, $this->requests);
        /** @var Request $request */
        $request = $this->requests[0]['request'];

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('uri', $request->getUri()->getPath());

        $this->assertSame([], $response);
    }
}
