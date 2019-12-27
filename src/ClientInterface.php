<?php
/**
 * User: boshurik
 * Date: 27.12.19
 * Time: 15:43
 */

namespace BoShurik\OrangeData;

use BoShurik\OrangeData\Model\Correction\Correction;
use BoShurik\OrangeData\Model\Correction\CorrectionStatus;
use BoShurik\OrangeData\Model\Document\Document;
use BoShurik\OrangeData\Model\Document\DocumentStatus;

interface ClientInterface
{
    public function document(Document $document): void;

    public function correction(Correction $correction): void;

    public function documentStatus(string $inn, string $id): ?DocumentStatus;

    public function correctionStatus(string $inn, string $id): ?CorrectionStatus;
}