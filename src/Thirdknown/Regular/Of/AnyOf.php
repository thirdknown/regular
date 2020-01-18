<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Of;

use Thirdknown\Regular\Expression\ExpressionInterface;
use Thirdknown\Regular\Expression\OneCharacterExpression;
use Thirdknown\Regular\Quantifier\QuantifiableInterface;
use Thirdknown\Regular\Quantifier\QuantifierTrait;

class AnyOf implements AnyOfInterface, QuantifiableInterface
{
    use QuantifierTrait;

    /**
     * @var \Thirdknown\Regular\Expression\ExpressionInterface[]
     */
    private $expressions = [];

    public function __toString(): string
    {
        return (new OpenSquareBracket())
            . implode('', $this->expressions)
            . (new CloseSquareBracket())
            . ($this->getQuantifier() ?? '');
    }

    public function addExpressionByInstance(ExpressionInterface $expression): self
    {
        $this->expressions[] = $expression;

        return $this;
    }

    public function addRange(string $first, string $last): self
    {
        return $this->addExpressionByInstance(
            new Range(
                new OneCharacterExpression($first), new OneCharacterExpression($last)
            )
        );
    }

    public function addOneCharacter(string $oneCharacter): self
    {
        return $this->addExpressionByInstance(new OneCharacterExpression($oneCharacter));
    }

    public static function create(): self
    {
        return new self();
    }
}
