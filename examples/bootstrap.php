<?php
/**
 * User: boshurik
 * Date: 30.12.19
 * Time: 14:27
 */

use BoShurik\OrangeData\ClientBuilder;
use Psr\Log\NullLogger;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

$builder = new ClientBuilder(
    PRIVATE_KEY,
    PRIVATE_KEY_PASSWORD,
    CERT,
    CERT_PASSWORD,
    SSL_KEY,
    SSL_KEY_PASSWORD,
    VERIFY,
    ENDPOINT
);

$builder->setLogger(new NullLogger()); // Optional

return $builder->build();