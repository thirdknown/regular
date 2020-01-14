<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Group;

use Thirdknown\Regular\Expression\Expression;
use Thirdknown\Regular\Expression\ExpressionInterface;
use Thirdknown\Regular\Quantifier\QuantifiableInterface;
use Thirdknown\Regular\Quantifier\QuantifierTrait;

class Group implements GroupInterface, QuantifiableInterface
{
    use QuantifierTrait;

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
            . (new CloseRoundBracket())
            . ($this->getQuantifier() ?? '');
    }

    public function addExpressionByExpressionInstance(ExpressionInterface $expression): self
    {
        $this->expressions[] = $expression;

        return $this;
    }

    public function addExpression(string $expression): self
    {
        return $this->addExpressionByExpressionInstance(new Expression($expression));
    }
}
