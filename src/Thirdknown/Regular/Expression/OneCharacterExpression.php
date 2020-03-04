<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Expression;

use Thirdknown\Regular\Exception\OneCharacterExpressionReceivesOnlyOneCharacterException;
use Thirdknown\Regular\Quantifier\QuantifiableInterface;
use Thirdknown\Regular\Quantifier\QuantifierTrait;

class OneCharacterExpression implements ExpressionInterface, QuantifiableInterface
{
    use QuantifierTrait;

    private string $expression;

    public function __construct(string $oneCharacter)
    {
        if (strlen($oneCharacter) !== 1) {
            throw new OneCharacterExpressionReceivesOnlyOneCharacterException();
        }

        $this->expression = $oneCharacter;
    }

    public function __toString(): string
    {
        return $this->expression . ($this->getQuantifier() ?? '');
    }

    public static function create(string $oneCharacter): self
    {
        return new self($oneCharacter);
    }
}
