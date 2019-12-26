<?php
/**
 * User: boshurik
 * Date: 10.12.19
 * Time: 18:28
 */

namespace BoShurik\OrangeData;

use BoShurik\OrangeData\Http\HttpClient;
use BoShurik\OrangeData\Http\Signer;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\RequestOptions;
use Psr\Log\LoggerInterface;

class ClientBuilder
{
    /**
     * @var string
     */
    private $privateKey;

    /**
     * @var string
     */
    private $cert;

    /**
     * @var string|null
     */
    private $certPassword;

    /**
     * @var string
     */
    private $sslKey;

    /**
     * @var string|null
     */
    private $sslKeyPassword;

    /**
     * @var mixed
     */
    private $verify;

    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var LoggerInterface|null
     */
    private $logger;

    public function __construct(
        string $privateKey,
        string $cert,
        ?string $certPassword,
        string $sslKey,
        ?string $sslKeyPassword,
        $verify,
        string $endpoint = 'https://api.orangedata.ru:12003/api/v2/'
    ) {
        $this->privateKey = $privateKey;
        $this->cert = $cert;
        $this->certPassword = $certPassword;
        $this->sslKey = $sslKey;
        $this->sslKeyPassword = $sslKeyPassword;
        $this->verify = $verify;
        $this->endpoint = $endpoint;
    }

    public function build(): Client
    {
        $guzzle = new GuzzleClient([
            'base_uri' => rtrim($this->endpoint, '/') . '/',
            RequestOptions::CERT => $this->certPassword ? [$this->cert, $this->certPassword] : $this->cert,
            RequestOptions::SSL_KEY => $this->sslKeyPassword ? [$this->sslKey, $this->sslKeyPassword] : $this->sslKey,
            RequestOptions::VERIFY => $this->verify,
        ]);

        $http = new HttpClient($guzzle, new Signer($this->privateKey), $this->logger);

        return new Client($http);
    }

    public function setLogger(?LoggerInterface $logger): ClientBuilder
    {
        $this->logger = $logger;

        return $this;
    }
}
