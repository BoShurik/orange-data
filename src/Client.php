<?php
/**
 * User: boshurik
 * Date: 09.12.19
 * Time: 18:47
 */

namespace BoShurik\OrangeData;

use BoShurik\OrangeData\Http\HttpClient;
use BoShurik\OrangeData\Model\Correction\Correction;
use BoShurik\OrangeData\Model\Correction\CorrectionStatus;
use BoShurik\OrangeData\Model\Document\Document;
use BoShurik\OrangeData\Model\Document\DocumentStatus;

class Client implements ClientInterface
{
    /**
     * @var HttpClient
     */
    private $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    public function document(Document $document): void
    {
        $this->http->post('/documents/', $document);
    }

    public function correction(Correction $correction): void
    {
        $this->http->post('/corrections/', $correction);
    }

    public function documentStatus(string $inn, string $id): ?DocumentStatus
    {
        $data = $this->http->get(sprintf('/documents/%s/status/%s', $inn, $id));
        if (count($data) === 0) {
            return null;
        }

        return DocumentStatus::create($data);
    }

    public function correctionStatus(string $inn, string $id): ?CorrectionStatus
    {
        $data = $this->http->get(sprintf('/corrections/%s/status/%s', $inn, $id));
        if (count($data) === 0) {
            return null;
        }

        return CorrectionStatus::create($data);
    }
}
