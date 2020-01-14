<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Thirdknown\Regular\Abbreviation\NumberCharacter;
use Thirdknown\Regular\Expression\OneCharacterExpression;
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
            ->addExpression(new NumberCharacter())
            ->addExpression(new OneCharacterExpression('c'))
            ->addExpression(new OneCharacterExpression('#'));
        $this->assertSame('(\d|c|#)', $group->__toString());
    }

    public function testSimpleExpression(): void
    {
        $this->assertSame('(', (new OpenRoundBracket())->__toString());
        $this->assertSame(')', (new CloseRoundBracket())->__toString());
        $this->assertSame('|', (new VerticalBar())->__toString());
    }
}
