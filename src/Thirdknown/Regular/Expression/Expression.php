<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Expression;

class Expression implements ExpressionInterface
{
    /**
     * @var string
     */
    private $expression;

    public function __construct(string $expression)
    {
        $this->expression = $expression;
    }

    public function __toString(): string
    {
        return $this->expression;
    }

    public static function create(string $expression): self
    {
        return new self($expression);
    }
}
