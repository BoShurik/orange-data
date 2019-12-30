<?php
/**
 * User: boshurik
 * Date: 30.12.19
 * Time: 14:27
 */

use BoShurik\OrangeData\ClientInterface;

/** @var ClientInterface $client */
$client = require __DIR__ . '/bootstrap.php';

if (!$id = $argv[1] ?? null) {
    throw new \RuntimeException('Empty document id');
}

$status = $client->correctionStatus(INN, $id);

$data = print_r(json_encode($status, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), true);

echo "Status: ".\PHP_EOL.$data.\PHP_EOL;