<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Quantifier;

trait QuantifierTrait
{
    private ?QuantifierInterface $quantifier = null;

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

    /**
     * @return $this
     */
    public function setFromZeroToInfinityQuantifier()
    {
        return $this->setQuantifier(new AsteriskQuantifier());
    }

    /**
     * @return $this
     */
    public function setFromOneToInfinityQuantifier()
    {
        return $this->setQuantifier(new PlusQuantifier());
    }

    /**
     * @return $this
     */
    public function setFromZeroToOneQuantifier()
    {
        return $this->setQuantifier(new QuestionMarkQuantifier());
    }

    /**
     * @return $this
     */
    public function setMinQuantifier(int $min)
    {
        return $this->setQuantifier(new MinQuantifier($min));
    }

    /**
     * @return $this
     */
    public function setMinMaxQuantifier(int $min, int $max)
    {
        return $this->setQuantifier(new MinMaxQuantifier($min, $max));
    }

    /**
     * @return $this
     */
    public function setMaxQuantifier(int $max)
    {
        return $this->setQuantifier(new MaxQuantifier($max));
    }

    /**
     * @return $this
     */
    public function setExactlyQuantifier(int $exactly)
    {
        return $this->setQuantifier(new ExactlyQuantifier($exactly));
    }
}
