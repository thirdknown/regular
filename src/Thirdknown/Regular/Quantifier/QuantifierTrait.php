<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Quantifier;

use Thirdknown\Regular\Expression\ExpressionInterface;

trait QuantifierTrait
{
    /**
     * @var \Thirdknown\Regular\Quantifier\QuantifierInterface
     */
    private $quantifier;

    public function getQuantifier(): ?QuantifierInterface
    {
        return $this->quantifier;
    }

    public function setQuantifier(QuantifierInterface $quantifier): ExpressionInterface
    {
        $this->quantifier = $quantifier;

        return $this;
    }
}
