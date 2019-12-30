<?php
/**
 * User: boshurik
 * Date: 30.12.19
 * Time: 14:26
 */

use BoShurik\OrangeData\ClientInterface;
use BoShurik\OrangeData\Model\Correction\Content;
use BoShurik\OrangeData\Model\Correction\Correction;
use BoShurik\OrangeData\Model\Document\CloseParameters;

/** @var ClientInterface $client */
$client = require __DIR__ . '/bootstrap.php';

$content = new Content(
    Content::CORRECTION_TYPE_SELF,
    Content::TYPE_IN,
    'Description',
    (new \DateTime())->format('Y-m-d\TH:i:s'),
    'number',
    '1000',
    '1000',
    '1000',
    '1000',
    '1000',
    '1000',
    '10',
    '10',
    '10',
    '10',
    '10',
    '10',
    CloseParameters::TAXATION_SYSTEM_COMMON
);

$id = uniqid();
$correction = new Correction($id, INN, $content);

$client->correction($correction);

echo "Correction with $id has been created". \PHP_EOL;