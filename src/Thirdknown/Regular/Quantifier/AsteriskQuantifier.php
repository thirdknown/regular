<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Quantifier;

class AsteriskQuantifier implements QuantifierInterface
{
    public const EXPRESSION = '*';

    public function __toString(): string
    {
        return self::EXPRESSION;
    }

    public static function create(): self
    {
        return new self();
    }
}
