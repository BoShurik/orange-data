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

    /**
     * @var string|null
     */
    private $password;

    public function __construct(string $privateKeyPath, ?string $password = null)
    {
        $this->privateKeyPath = $privateKeyPath;
        $this->password = $password;
    }

    public function sign(string $data): string
    {
        $privateKey = openssl_get_privatekey(sprintf('file://%s', $this->privateKeyPath), $this->password);
        if (!openssl_sign($data, $sign, $privateKey, OPENSSL_ALGO_SHA256)) {
            throw new SignException();
        }

        return base64_encode($sign);
    }
}
