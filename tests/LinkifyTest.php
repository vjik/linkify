<?php

declare(strict_types=1);

namespace Vjik\Linkify\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Vjik\Linkify\EmailPattern;
use Vjik\Linkify\HttpPattern;
use Vjik\Linkify\Linkify;

final class LinkifyTest extends TestCase
{
    public function testBase(): void
    {
        $text = 'My 1st site is https://example.com. ' .
            'Old site available here: https://old.example.com';
        $expected = 'My 1st site is <a href="https://example.com">example.com</a>. ' .
            'Old site available here: <a href="https://old.example.com">old.example.com</a>';

        self::assertSame(
            $expected,
            (new Linkify(new HttpPattern()))->process($text)
        );
    }

    public function testTwoPattern(): void
    {
        $text = 'Contacts: https://example.com, info@example.com.';
        $expected = 'Contacts: <a href="https://example.com">example.com</a>, ' .
            '<a href="mailto:info@example.com">info@example.com</a>.';

        self::assertSame(
            $expected,
            (new Linkify(
                new HttpPattern(),
                new EmailPattern(),
            ))->process($text)
        );
    }

    public function testCustomPlugTemplate(): void
    {
        self::assertSame(
            'My site is <a href="https://example.com">example.com</a>.',
            (new Linkify(new HttpPattern()))
                ->withPlugTemplate('~~~~%ID%~~~~')
                ->process('My site is https://example.com.')
        );
    }

    public function dataInvalidPlugTemplate(): array
    {
        return [
            [''],
            ['TAG_ID'],
        ];
    }

    /**
     * @dataProvider dataInvalidPlugTemplate
     */
    public function testInvalidPlugTemplate(string $plug): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Plug should contain %ID%.');
        (new Linkify())->withPlugTemplate($plug);
    }

    public function testImmutability(): void
    {
        $linkify = new Linkify();
        self::assertNotSame($linkify, $linkify->withPlugTemplate('TAG_%ID%'));
    }
}
