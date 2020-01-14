<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Builder;

use Thirdknown\Regular\Border\DelimiterInterface;
use Thirdknown\Regular\Border\EndOfLine;
use Thirdknown\Regular\Border\PlusDelimiter;
use Thirdknown\Regular\Border\SlashDelimiter;
use Thirdknown\Regular\Border\StartOfLine;
use Thirdknown\Regular\Exception\BuilderIsAlreadyLockedException;
use Thirdknown\Regular\Expression\CompositeExpression;
use Thirdknown\Regular\Expression\CompositeExpressionInterface;
use Thirdknown\Regular\Expression\ExpressionInterface;

class Builder extends CompositeExpression
{
    /**
     * @var bool
     */
    private $locked = false;

    public function addExpression(ExpressionInterface $expression): CompositeExpressionInterface
    {
        $this->checkLocked();
        parent::addExpression($expression);

        return $this;
    }

    public function lockWithDelimiters(DelimiterInterface $delimiter): self
    {
        $this->checkLocked();
        array_unshift($this->expressions, $delimiter);
        $this->expressions[] = $delimiter;

        $this->locked = true;

        return $this;
    }

    public function startOfLine(): self
    {
        $this->addExpression(new StartOfLine());

        return $this;
    }

    public function endOfLine(): self
    {
        $this->addExpression(new EndOfLine());

        return $this;
    }

    public function lockWithSlashDelimiters(): self
    {
        $this->lockWithDelimiters(new SlashDelimiter());

        return $this;
    }

    public function lockWithPlusDelimiters(): self
    {
        $this->lockWithDelimiters(new PlusDelimiter());

        return $this;
    }

    private function checkLocked(): void
    {
        if ($this->locked) {
            throw new BuilderIsAlreadyLockedException();
        }
    }
}
