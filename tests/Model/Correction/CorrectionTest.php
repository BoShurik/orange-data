<?php
/**
 * User: boshurik
 * Date: 30.12.19
 * Time: 15:53
 */

namespace BoShurik\OrangeData\Tests\Model\Correction;

use BoShurik\OrangeData\Model\Correction\Content;
use BoShurik\OrangeData\Model\Correction\Correction;
use BoShurik\OrangeData\Tests\Model\ModelTestCase;
use PHPUnit\Framework\MockObject\MockObject;

class CorrectionTest extends ModelTestCase
{
    /**
     * @var Content|MockObject
     */
    private $content;

    protected function setUp(): void
    {
        $this->content = $this->createMock(Content::class);
        $this->content
            ->method('jsonSerialize')
            ->willReturn([])
        ;
    }

    protected function getClass(): string
    {
        return Correction::class;
    }

    protected function getFullParameters(): array
    {
        return [
            'id' => 'id',
            'inn' => '0123456789',
            'content' => $this->content,
            'callbackUrl' => 'https://google.com',
            'key' => 'key',
            'group' => 'group',
        ];
    }

    protected function getMinimalParameters(): array
    {
        return [
            'id' => 'id',
            'inn' => '0123456789',
            'content' => $this->content,
        ];
    }

    protected function getMinimalResults(): array
    {
        $results = parent::getMinimalResults();

        return array_merge(
            $results, [
                'key' => $results['inn']
            ]
        );
    }
}
