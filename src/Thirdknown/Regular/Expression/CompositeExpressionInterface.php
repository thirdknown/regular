<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Expression;

interface CompositeExpressionInterface extends ExpressionInterface
{
    public function addExpression(ExpressionInterface $expression): self;
}
