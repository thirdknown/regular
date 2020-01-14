<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Expression;

use Thirdknown\Regular\Border\DelimiterInterface;
use Thirdknown\Regular\Exception\CompositeExpressionMustHaveOnlyTwoDelimitersException;
use Thirdknown\Regular\Exception\CompositeExpressionMustHaveSameDelimitersException;
use Thirdknown\Regular\Exception\CompositeExpressionMustHaveTwoDelimitersException;
use Thirdknown\Regular\Quantifier\QuantifiableInterface;
use Thirdknown\Regular\Quantifier\QuantifierTrait;

class CompositeExpression implements CompositeExpressionInterface, QuantifiableInterface
{
    use QuantifierTrait;

    /**
     * @var \Thirdknown\Regular\Expression\ExpressionInterface[]
     */
    private $expressions = [];

    public function __toString(): string
    {
        if (count($this->getDelimiters()) !== 2) {
            throw new CompositeExpressionMustHaveTwoDelimitersException();
        }

        return implode('', $this->expressions) . ($this->getQuantifier() ?? '');
    }

    public function addExpression(ExpressionInterface $expression): CompositeExpressionInterface
    {
        $this->checkSameDelimiters($expression);

        $this->expressions[] = $expression;

        return $this;
    }

    private function checkSameDelimiters(ExpressionInterface $currentlyBeingAddedExpression): void
    {
        if (! $currentlyBeingAddedExpression instanceof DelimiterInterface) {
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
        return array_filter($this->expressions, function (ExpressionInterface $expression): bool {
            return $expression instanceof DelimiterInterface;
        });
    }
}
