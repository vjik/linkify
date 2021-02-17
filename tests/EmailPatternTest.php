<?php

declare(strict_types=1);

namespace Vjik\Linkify\Tests;

use PHPUnit\Framework\TestCase;
use Vjik\Linkify\Linkify;
use Vjik\Linkify\EmailPattern;

final class EmailPatternTest extends TestCase
{
    public function dataBase(): array
    {
        return [
            'onlyEmail' => [
                '<a href="mailto:contact@example.com">contact@example.com</a>',
                'contact@example.com',
            ],
            'oneEmailInText' => [
                'My email is <a href="mailto:contact@example.com">contact@example.com</a>.',
                'My email is contact@example.com.',
            ],
            'twoEmailInText' => [
                'My email is <a href="mailto:contact@example.com">contact@example.com</a>. ' .
                'Old <a href="mailto:info@example.com">info@example.com</a> is not work.',
                'My email is contact@example.com. ' .
                'Old info@example.com is not work.',
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
            (new Linkify(new EmailPattern()))->process($text)
        );
    }
}
