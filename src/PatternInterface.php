<?php

declare(strict_types=1);

namespace Vjik\Linkify;

interface PatternInterface
{
    public function getRegularExpression(): string;

    public function callback(array $match): string;
}

