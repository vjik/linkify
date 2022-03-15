<?php

declare(strict_types=1);

namespace Vjik\Linkify;

use InvalidArgumentException;

use function count;
use function is_string;

final class Linkify
{
    private const VAR_ID = '%ID%';

    /**
     * @var PatternInterface[]
     */
    private array $patterns;
    private string $plugTemplate = '###_LINKIFY_TAG_' . self::VAR_ID . '_###';

    public function __construct(PatternInterface ...$patterns)
    {
        $this->patterns = $patterns;
    }

    public function process(string $text): string
    {
        /** @psalm-var array<string, string> $links */
        $links = [];
        foreach ($this->patterns as $pattern) {
            $result = preg_replace_callback(
                $pattern->getRegularExpression(),
                function (array $match) use ($pattern, &$links): string {
                    /** @psalm-var array<string, string> $links */
                    $plug = str_replace(self::VAR_ID, (string) count($links), $this->plugTemplate);
                    $links[$plug] = $pattern->callback($match);
                    return $plug;
                },
                $text
            );
            if (is_string($result)) {
                $text = $result;
            }
        }

        /** @psalm-var array<string, string> $links */

        return strtr($text, $links);
    }

    public function withPlugTemplate(string $plug): self
    {
        if (strpos($plug, self::VAR_ID) === false) {
            throw new InvalidArgumentException('Plug should contain ' . self::VAR_ID . '.');
        }

        $new = clone $this;
        $new->plugTemplate = $plug;
        return $new;
    }
}
