<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Border;

class SlashDelimiter implements DelimiterInterface
{
    public const EXPRESSION = '/';

    public function __toString(): string
    {
        return self::EXPRESSION;
    }
}
