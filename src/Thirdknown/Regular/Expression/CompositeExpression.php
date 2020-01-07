<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Expression;

use Thirdknown\Regular\Border\DelimiterInterface;
use Thirdknown\Regular\Exception\CompositeExpressionMustHaveOnlyTwoDelimitersException;
use Thirdknown\Regular\Exception\CompositeExpressionMustHaveSameDelimitersException;
use Thirdknown\Regular\Exception\CompositeExpressionMustHaveTwoDelimitersException;

class CompositeExpression implements CompositeExpressionInterface
{
    /**
     * @var \Thirdknown\Regular\Expression\ExpressionInterface[]
     */
    private $expressions = [];

    public function __toString(): string
    {
        if (count($this->getDelimiters()) !== 2) {
            throw new CompositeExpressionMustHaveTwoDelimitersException();
        }

        return implode('', $this->expressions);
    }

    public function addExpression(ExpressionInterface $expression): CompositeExpressionInterface
    {
        $this->checkSameDelimiters($expression);

        $this->expressions[] = $expression;

        return $this;
    }

    private function checkSameDelimiters(ExpressionInterface $currentlyBeingAddedExpression): void
    {
        if (($currentlyBeingAddedExpression instanceof DelimiterInterface) === false) {
            return;
        }

        $delimiters = $this->getDelimiters();

        if (count($delimiters) === 2) {
            throw new CompositeExpressionMustHaveOnlyTwoDelimitersException();
        }

        if (
            count($delimiters) === 1
            && array_shift($delimiters) !== $currentlyBeingAddedExpression
        ) {
            throw new CompositeExpressionMustHaveSameDelimitersException();
        }
    }

    /**
     * @return \Thirdknown\Regular\Border\DelimiterInterface[]
     */
    private function getDelimiters(): array
    {
        $delimiters = [];
        foreach ($this->expressions as $expression) {
            if ($expression instanceof DelimiterInterface) {
                $delimiters[] = $expression;
            }
        }

        return $delimiters;
    }
}
