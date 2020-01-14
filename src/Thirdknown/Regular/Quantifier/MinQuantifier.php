<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Quantifier;

class MinQuantifier implements QuantifierInterface
{
    /**
     * @var int
     */
    private $min;

    public function __construct(int $min)
    {
        $this->min = $min;
    }

    public function __toString(): string
    {
        return sprintf('{%s,}', $this->min);
    }

    public static function create(int $min): self
    {
        return new self($min);
    }
}
