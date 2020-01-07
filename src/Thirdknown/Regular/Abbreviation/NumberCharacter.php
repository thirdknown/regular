<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Abbreviation;

class NumberCharacter implements AbbreviationInterface
{
    public const EXPRESSION = '\d';

    public function __toString(): string
    {
        return self::EXPRESSION;
    }
}
