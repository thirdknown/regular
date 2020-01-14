<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Quantifier;

interface QuantifiableInterface
{
    /**
     * @return $this
     */
    public function setQuantifier(QuantifierInterface $quantifier);

    public function getQuantifier(): ?QuantifierInterface;
}
