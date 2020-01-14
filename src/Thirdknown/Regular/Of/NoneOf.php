<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Of;

use Thirdknown\Regular\Expression\ExpressionInterface;
use Thirdknown\Regular\Quantifier\QuantifiableInterface;
use Thirdknown\Regular\Quantifier\QuantifierTrait;

class NoneOf implements AnyOfInterface, QuantifiableInterface
{
    use QuantifierTrait;

    /**
     * @var \Thirdknown\Regular\Expression\ExpressionInterface[]
     */
    private $expressions = [];

    public function __toString(): string
    {
        return (new OpenSquareBracket())
            . (new Negation())
            . implode('', $this->expressions)
            . (new CloseSquareBracket())
            . ($this->getQuantifier() ?? '');
    }

    public function addExpression(ExpressionInterface $expression): self
    {
        $this->expressions[] = $expression;

        return $this;
    }

    public static function create(): self
    {
        return new self();
    }
}
