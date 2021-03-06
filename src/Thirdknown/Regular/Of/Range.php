<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Of;

use Thirdknown\Regular\Expression\ExpressionInterface;

class Range implements AnyOfInterface
{
    private ExpressionInterface $first;

    private ExpressionInterface $last;

    public function __construct(ExpressionInterface $first, ExpressionInterface $last)
    {
        $this->first = $first;
        $this->last = $last;
    }

    public function __toString(): string
    {
        return $this->first . (new Dash()) . $this->last;
    }
}
