<?php

declare(strict_types=1);

namespace Vjik\Linkify;

interface LinkifyProtocolInterface
{
    public function getRegularExpression(): string;

    public function callback(array $match): string;
}

