<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Quantifier;

class PlusQuantifier implements QuantifierInterface
{
    public const EXPRESSION = '+';

    public function __toString(): string
    {
        return self::EXPRESSION;
    }
}
