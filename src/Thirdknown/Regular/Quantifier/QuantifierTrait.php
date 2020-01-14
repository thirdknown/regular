<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Quantifier;

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

    /**
     * @return $this
     */
    public function setQuantifier(QuantifierInterface $quantifier)
    {
        $this->quantifier = $quantifier;

        return $this;
    }
}
