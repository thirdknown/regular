<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Group;

use Thirdknown\Regular\Expression\ExpressionInterface;

class Group implements GroupInterface
{
    /**
     * @var \Thirdknown\Regular\Expression\ExpressionInterface[]
     */
    private $expressions = [];

    public function __toString(): string
    {
        return (new OpenRoundBracket())
            . implode(
                (new VerticalBar())->__toString(),
                $this->expressions
            )
            . (new CloseRoundBracket());
    }

    public function addExpression(ExpressionInterface $expression): self
    {
        $this->expressions[] = $expression;

        return $this;
    }
}
