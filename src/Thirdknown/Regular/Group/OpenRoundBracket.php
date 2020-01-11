<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Group;

use Thirdknown\Regular\Expression\ExpressionInterface;

class OpenRoundBracket implements ExpressionInterface
{
    public const EXPRESSION = '(';

    public function __toString(): string
    {
        return self::EXPRESSION;
    }
}
