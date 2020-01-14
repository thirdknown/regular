<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Abbreviation;

use Thirdknown\Regular\Quantifier\QuantifiableInterface;
use Thirdknown\Regular\Quantifier\QuantifierTrait;

class NumberCharacter implements AbbreviationInterface, QuantifiableInterface
{
    use QuantifierTrait;

    public const EXPRESSION = '\d';

    public function __toString(): string
    {
        return self::EXPRESSION . ($this->getQuantifier() ?? '');
    }
}
