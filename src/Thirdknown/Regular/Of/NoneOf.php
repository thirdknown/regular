<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Of;

use Thirdknown\Regular\Expression\ExpressionInterface;

class NoneOf implements AnyOfInterface
{
    /**
     * @var \Thirdknown\Regular\Expression\ExpressionInterface[]
     */
    private $expressions = [];

    public function __toString(): string
    {
        return (new OpenSquareBracket())
            . (new Negation())
            . implode('', $this->expressions)
            . (new CloseSquareBracket());
    }

    public function addExpression(ExpressionInterface $expression): self
    {
        $this->expressions[] = $expression;

        return $this;
    }
}
