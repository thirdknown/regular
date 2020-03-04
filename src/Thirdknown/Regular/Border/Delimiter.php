<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Border;

class Delimiter implements DelimiterInterface
{
    private string $delimiter;

    public function __construct(string $delimiter)
    {
        $this->delimiter = $delimiter;
    }

    public function __toString(): string
    {
        return $this->delimiter;
    }

    public static function create(string $delimiter): self
    {
        return new self($delimiter);
    }
}
