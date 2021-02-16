<?php

declare(strict_types=1);

namespace Vjik\Linkify;

final class Linkify
{
    private array $protocols;
    private string $plugTemplate = '###_LINKIFY_TAG_%ID%_###';

    public function __construct(LinkifyProtocolInterface ...$protocols)
    {
        $this->protocols = $protocols;
    }

    public function linkify(string $text): string
    {
        $links = [];
        foreach ($this->protocols as $protocol) {


            /** @var string|null $result */
            $result = preg_replace_callback(
                $protocol->getRegularExpression(),
                function (array $match) use ($protocol, &$links) {
                    $plug = str_replace($this->plugTemplate, '%ID%', count($links));
                    $links[$plug] = $protocol->callback($match);
                    return $plug;
                },
                $text
            );
            if (is_string($result)) {
                $text = $result;
            }
        }

        return strtr($text, $links);
    }

    public function withPlugTemplate(string $plug): self
    {
        $new = clone $this;
        $new->plugTemplate = $plug;
        return $new;
    }
}
