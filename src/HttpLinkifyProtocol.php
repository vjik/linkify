<?php

declare(strict_types=1);

namespace Vjik\Linkify;

use Yiisoft\Html\Html;

final class HttpLinkifyProtocol implements LinkifyProtocolInterface
{
    public function getRegularExpression(): string
    {
        return '~(https?)://([^\s,:]+\.[^\s\.,:]+)~iu';
    }

    public function callback(array $match): string
    {
        return Html::a($match[2], $match[0]);
    }
}

