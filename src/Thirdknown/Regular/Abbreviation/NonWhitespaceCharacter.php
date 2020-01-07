<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Abbreviation;

class NonWhitespaceCharacter implements AbbreviationInterface
{
    public const EXPRESSION = '\S';

    public function __toString(): string
    {
        return self::EXPRESSION;
    }
}
