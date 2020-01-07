<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Abbreviation;

class Dot implements AbbreviationInterface
{
    public const EXPRESSION = '.';

    public function __toString(): string
    {
        return self::EXPRESSION;
    }
}
