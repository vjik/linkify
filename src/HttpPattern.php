<?php

declare(strict_types=1);

namespace Vjik\Linkify;

use Yiisoft\Html\Html;

final class HttpPattern implements PatternInterface
{
    public function getRegularExpression(): string
    {
        return '~(https?)://([^\s,:]+\.[^\s\.,:]+)~iu';
    }

    public function callback(array $match): string
    {
        /**
         * @psalm-var array{
         *      0:string,
         *      1:string,
         *      2:string,
         * }&array<int,string> $match
         */
        return Html::a($match[2], $match[0]);
    }
}

