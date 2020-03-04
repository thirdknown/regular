<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Quantifier;

class MinMaxQuantifier implements QuantifierInterface
{
    private int $min;

    private int $max;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function __toString(): string
    {
        return sprintf('{%s,%s}', $this->min, $this->max);
    }

    public static function create(int $min, int $max): self
    {
        return new self($min, $max);
    }
}
