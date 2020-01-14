<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Expression;

use Thirdknown\Regular\Exception\OneCharacterExpressionReceivesOnlyOneCharacterException;

class OneCharacterExpression implements ExpressionInterface
{
    /**
     * @var string
     */
    private $expression;

    public function __construct(string $expression)
    {
        if (strlen($expression) > 1) {
            throw new OneCharacterExpressionReceivesOnlyOneCharacterException();
        }

        $this->expression = $expression;
    }

    public function __toString(): string
    {
        return $this->expression;
    }
}
