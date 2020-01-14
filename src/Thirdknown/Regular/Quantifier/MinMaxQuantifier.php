<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Quantifier;

class MinMaxQuantifier implements QuantifierInterface
{
    /**
     * @var int
     */
    private $min;

    /**
     * @var int
     */
    private $max;

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
