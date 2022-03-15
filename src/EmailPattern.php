<?php

declare(strict_types=1);

namespace Vjik\Linkify;

use Yiisoft\Html\Html;

final class EmailPattern implements PatternInterface
{
    /**
     * @link https://www.regular-expressions.info/email.html
     */
    public function getRegularExpression(): string
    {
        return '/' .
            '[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+' .
            '(?:\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*' .
            '@' .
            '(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+' .
            '[a-zA-Z0-9]' .
            '(?:[a-zA-Z0-9-]*[a-zA-Z0-9])?' .
            '/u';
    }

    public function callback(array $match): string
    {
        /**
         * @psalm-var array{
         *      0:string,
         * }&array<int,string> $match
         */
        return (string) Html::mailto($match[0]);
    }
}
