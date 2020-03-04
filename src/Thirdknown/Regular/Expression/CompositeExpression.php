<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Expression;

use Thirdknown\Regular\Border\DelimiterInterface;
use Thirdknown\Regular\Exception\CompositeExpressionMustHaveOnlyTwoDelimitersException;
use Thirdknown\Regular\Exception\CompositeExpressionMustHaveSameDelimitersException;
use Thirdknown\Regular\Exception\CompositeExpressionMustHaveTwoDelimitersException;
use Thirdknown\Regular\Group\GroupInterface;
use Thirdknown\Regular\Of\AnyOfInterface;

class CompositeExpression implements CompositeExpressionInterface
{
    /**
     * @var \Thirdknown\Regular\Expression\ExpressionInterface[]
     */
    private array $expressions = [];

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

    public function addGroup(GroupInterface $group): CompositeExpressionInterface
    {
        return $this->addExpression($group);
    }

    public function addAnyOf(AnyOfInterface $anyOf): CompositeExpressionInterface
    {
        return $this->addExpression($anyOf);
    }

    public function addNoneOf(AnyOfInterface $noneOf): CompositeExpressionInterface
    {
        return $this->addExpression($noneOf);
    }

    public static function create(): self
    {
        return new self();
    }

    private function checkSameDelimiters(ExpressionInterface $currentlyBeingAddedExpression): void
    {
        if (!$currentlyBeingAddedExpression instanceof DelimiterInterface) {
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
     * @return \Thirdknown\Regular\Expression\ExpressionInterface[]
     */
    private function getDelimiters(): array
    {
        return array_filter(
            $this->expressions,
            fn (ExpressionInterface $expression): bool => $expression instanceof DelimiterInterface
        );
    }
}
