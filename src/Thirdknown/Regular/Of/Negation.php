<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Of;

use Thirdknown\Regular\Expression\ExpressionInterface;

class Negation implements ExpressionInterface
{
    public const EXPRESSION = '^';

    public function __toString(): string
    {
        return self::EXPRESSION;
    }
}
