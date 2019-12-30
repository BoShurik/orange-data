<?php
/**
 * User: boshurik
 * Date: 30.12.19
 * Time: 14:26
 */

use BoShurik\OrangeData\ClientInterface;
use BoShurik\OrangeData\Model\Document\CloseParameters;
use BoShurik\OrangeData\Model\Document\Content;
use BoShurik\OrangeData\Model\Document\Document;
use BoShurik\OrangeData\Model\Document\Payment;
use BoShurik\OrangeData\Model\Document\Position;

/** @var ClientInterface $client */
$client = require __DIR__ . '/bootstrap.php';

$position = new Position(1, '1000', Position::TAX_NO, 'Position');
$position->setPaymentMethodType(Position::METHOD_TYPE_FULL_PAYMENT);
$position->setPaymentSubjectType(Position::SUBJECT_TYPE_SERVICE);

$payment = new Payment(Payment::TYPE_CASHLESS, '1000');

$closeParameters = new CloseParameters([
    $payment,
], CloseParameters::TAXATION_SYSTEM_COMMON);

$content = new Content(Content::TYPE_IN, [
    $position,
], $closeParameters, 'test@example.com');

$id = uniqid();
$document = new Document($id, INN, $content);

$client->document($document);

echo "Document with $id has been created". \PHP_EOL;