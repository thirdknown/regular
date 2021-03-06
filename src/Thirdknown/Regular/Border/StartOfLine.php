<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Border;

use Thirdknown\Regular\Expression\ExpressionInterface;

class StartOfLine implements ExpressionInterface
{
    public const EXPRESSION = '^';

    public function __toString(): string
    {
        return self::EXPRESSION;
    }

    public static function create(): self
    {
        return new self();
    }
}
