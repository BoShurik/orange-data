<?php
/**
 * User: boshurik
 * Date: 09.12.19
 * Time: 18:53
 */

namespace BoShurik\OrangeData\Http;

use BoShurik\OrangeData\Exception\ResponseException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\RequestOptions;
use Psr\Log\LoggerInterface;

class HttpClient
{
    /**
     * @var ClientInterface
     */
    private $guzzle;

    /**
     * @var Signer
     */
    private $signer;

    /**
     * @var LoggerInterface|null
     */
    private $logger;

    public function __construct(ClientInterface $guzzle, Signer $signer, ?LoggerInterface $logger = null)
    {
        $this->guzzle = $guzzle;
        $this->signer = $signer;
        $this->logger = $logger;
    }

    public function post(string $uri, $data): void
    {
        $this->debug(sprintf('POST request to %s', $uri));

        try {
            $this->guzzle->request('POST', $this->prepareUri($uri), [
                RequestOptions::JSON => $data,
                RequestOptions::HEADERS => [
                    'X-Signature' => $this->signer->sign(json_encode($data)),
                ],
            ]);
        } catch (BadResponseException $exception) {
            $message = (string)$exception->getResponse()->getBody();

            $this->error($message);

            throw new ResponseException($message, $exception->getCode(), $exception);
        }
    }

    public function get(string $uri): array
    {
        $this->debug(sprintf('GET request to %s', $uri));

        try {
            $response = $this->guzzle->request('GET', $this->prepareUri($uri));
        } catch (BadResponseException $exception) {
            $this->error($exception->getCode());

            throw new ResponseException($exception->getCode(), $exception->getCode(), $exception);
        }

        if ($response->getStatusCode() === 202) {
            return [];
        }

        return json_decode((string)$response->getBody(), true);
    }

    private function prepareUri(string $uri): string
    {
        return ltrim($uri, '/');
    }

    private function debug(string $message, array $context = []): void
    {
        if (!$this->logger) {
            return;
        }

        $this->logger->debug($message, $context);
    }

    private function error(string $message, array $context = []): void
    {
        if (!$this->logger) {
            return;
        }

        $this->logger->error($message, $context);
    }
}
