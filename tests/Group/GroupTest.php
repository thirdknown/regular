<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Thirdknown\Regular\Abbreviation\NumberCharacter;
use Thirdknown\Regular\Expression\Expression;
use Thirdknown\Regular\Group\CloseRoundBracket;
use Thirdknown\Regular\Group\Group;
use Thirdknown\Regular\Group\OpenRoundBracket;
use Thirdknown\Regular\Group\VerticalBar;

class GroupTest extends TestCase
{
    public function testGroup(): void
    {
        $group = new Group();
        $group
            ->addExpressionByExpressionInstance(new NumberCharacter())
            ->addExpression('c')
            ->addExpressionByExpressionInstance(new Expression('#'));
        $this->assertSame('(\d|c|#)', $group->__toString());
    }

    public function testSimpleExpression(): void
    {
        $this->assertSame('(', (new OpenRoundBracket())->__toString());
        $this->assertSame(')', (new CloseRoundBracket())->__toString());
        $this->assertSame('|', (new VerticalBar())->__toString());
    }
}
