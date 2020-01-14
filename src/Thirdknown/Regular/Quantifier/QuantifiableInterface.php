<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Quantifier;

use Thirdknown\Regular\Expression\ExpressionInterface;

interface QuantifiableInterface
{
    public function setQuantifier(QuantifierInterface $quantifier): ExpressionInterface;

    public function getQuantifier(): ?QuantifierInterface;
}
