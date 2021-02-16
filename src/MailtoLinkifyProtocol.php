<?php

declare(strict_types=1);

namespace Vjik\Linkify;

use Yiisoft\Html\Html;

final class MailtoLinkifyProtocol implements LinkifyProtocolInterface
{
    /**
     * @link https://www.regular-expressions.info/email.html
     */
    public function getRegularExpression(): string
    {
        return '/[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?/u';
    }

    public function callback(array $match): string
    {
        return Html::mailto($match[0]);
    }
}
