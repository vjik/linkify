<?php

declare(strict_types=1);

namespace Vjik\Linkify\Tests;

use PHPUnit\Framework\TestCase;
use Vjik\Linkify\HttpLinkifyProtocol;
use Vjik\Linkify\Linkify;

final class HttpLinkifyProtocolTest extends TestCase
{
    public function dataBase(): array
    {
        return [
            'onlyLinkHttp' => [
                '<a href="http://example.com">example.com</a>',
                'http://example.com',
            ],
            'onlyLinkHttps' => [
                '<a href="https://example.com">example.com</a>',
                'https://example.com',
            ],
            'oneLinkInText' => [
                'My site is <a href="http://example.com">example.com</a>.',
                'My site is http://example.com.',
            ],
            'twoLinkInText' => [
                'My site is <a href="https://example.com">example.com</a>. ' .
                'Old site here: <a href="http://old.example.com">old.example.com</a>.',
                'My site is https://example.com. ' .
                'Old site here: http://old.example.com.',
            ],
        ];
    }

    /**
     * @dataProvider dataBase
     */
    public function testBase(string $expected, string $text): void
    {
        self::assertSame(
            $expected,
            (new Linkify(new HttpLinkifyProtocol()))->linkify($text)
        );
    }
}

