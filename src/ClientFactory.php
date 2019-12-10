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

class ClientFactory
{
    public static function create(
        string $privateKey,
        string $cert,
        ?string $certPassword,
        string $sslKey,
        ?string $sslKeyPassword,
        $verify,
        string $endpoint = 'https://api.orangedata.ru:12003/api/v2/'
    ): Client {
        $guzzle = new GuzzleClient([
            'base_uri' => rtrim($endpoint, '/') . '/',
            RequestOptions::CERT => $certPassword ? [$cert, $certPassword] : $cert,
            RequestOptions::SSL_KEY => $sslKeyPassword ? [$sslKey, $sslKeyPassword] : $sslKey,
            RequestOptions::VERIFY => $verify,
        ]);

        $http = new HttpClient($guzzle, new Signer($privateKey));

        return new Client($http);
    }
}
