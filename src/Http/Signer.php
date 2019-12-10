<?php
/**
 * User: boshurik
 * Date: 10.12.19
 * Time: 17:27
 */

namespace BoShurik\OrangeData\Http;

use BoShurik\OrangeData\Exception\SignException;

class Signer
{
    /**
     * @var string
     */
    private $privateKeyPath;

    public function __construct(string $privateKeyPath)
    {
        $this->privateKeyPath = $privateKeyPath;
    }

    public function sign(string $data): string
    {
        if (!openssl_sign($data, $sign, file_get_contents($this->privateKeyPath), OPENSSL_ALGO_SHA256)) {
            throw new SignException();
        }

        return base64_encode($sign);
    }
}
