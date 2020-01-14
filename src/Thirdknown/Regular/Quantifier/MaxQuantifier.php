<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Quantifier;

class MaxQuantifier implements QuantifierInterface
{
    /**
     * @var int
     */
    private $max;

    public function __construct(int $max)
    {
        $this->max = $max;
    }

    public function __toString(): string
    {
        return sprintf('{0,%s}', $this->max);
    }

    public static function create(int $max): self
    {
        return new self($max);
    }
}
