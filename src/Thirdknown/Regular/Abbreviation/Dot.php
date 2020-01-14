<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Abbreviation;

use Thirdknown\Regular\Quantifier\QuantifiableInterface;
use Thirdknown\Regular\Quantifier\QuantifierTrait;

class Dot implements AbbreviationInterface, QuantifiableInterface
{
    use QuantifierTrait;

    public const EXPRESSION = '.';

    public function __toString(): string
    {
        return self::EXPRESSION . ($this->getQuantifier() ?? '');
    }

    public static function create(): self
    {
        return new self();
    }
}
