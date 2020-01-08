<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Quantifier;

class ExactlyQuantifier implements QuantifierInterface
{
    /**
     * @var int
     */
    private $exactly;

    public function __construct(int $exactly)
    {
        $this->exactly = $exactly;
    }

    public function __toString(): string
    {
        return sprintf('{%s}', $this->exactly);
    }
}