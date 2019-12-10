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

    public function __construct(ClientInterface $guzzle, Signer $signer)
    {
        $this->guzzle = $guzzle;
        $this->signer = $signer;
    }

    public function post(string $uri, $data): void
    {
        try {
            $this->guzzle->request('POST', $this->prepareUri($uri), [
                RequestOptions::JSON => $data,
                RequestOptions::HEADERS => [
                    'X-Signature' => $this->signer->sign(json_encode($data)),
                ],
            ]);
        } catch (BadResponseException $exception) {
            $message = (string)$exception->getResponse()->getBody();

            throw new ResponseException($message, $exception->getCode(), $exception);
        }
    }

    public function get(string $uri): array
    {
        try {
            $response = $this->guzzle->request('GET', $this->prepareUri($uri));
        } catch (BadResponseException $exception) {
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
}
