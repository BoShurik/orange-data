<?php
/**
 * User: boshurik
 * Date: 09.12.19
 * Time: 19:18
 */

namespace BoShurik\OrangeData\Tests\Model\Document;

use BoShurik\OrangeData\Model\Document\Content;
use BoShurik\OrangeData\Model\Document\Document;
use BoShurik\OrangeData\Tests\Model\ModelTestCase;
use PHPUnit\Framework\MockObject\MockObject;

class DocumentTest extends ModelTestCase
{
    /**
     * @var Content|MockObject
     */
    private $content;

    protected function setUp(): void
    {
        $this->content = $this->createMock(Content::class);
        $this->content
            ->expects($this->atLeastOnce())
            ->method('jsonSerialize')
            ->willReturn([])
        ;
    }

    protected function getClass(): string
    {
        return Document::class;
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
