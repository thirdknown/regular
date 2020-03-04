<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Quantifier;

class ExactlyQuantifier implements QuantifierInterface
{
    private int $exactly;

    public function __construct(int $exactly)
    {
        $this->exactly = $exactly;
    }

    public function __toString(): string
    {
        return sprintf('{%s}', $this->exactly);
    }

    public static function create(int $exactly): self
    {
        return new self($exactly);
    }
}
