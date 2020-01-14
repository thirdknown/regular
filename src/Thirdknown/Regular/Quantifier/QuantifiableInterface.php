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

    /**
     * @return $this
     */
    public function setFromZeroToInfinityQuantifier();

    /**
     * @return $this
     */
    public function setFromOneToInfinityQuantifier();

    /**
     * @return $this
     */
    public function setFromZeroToOneQuantifier();

    /**
     * @return $this
     */
    public function setMinQuantifier(int $min);

    /**
     * @return $this
     */
    public function setMinMaxQuantifier(int $min, int $max);

    /**
     * @return $this
     */
    public function setMaxQuantifier(int $max);

    /**
     * @return $this
     */
    public function setExactlyQuantifier(int $exactly);
}
