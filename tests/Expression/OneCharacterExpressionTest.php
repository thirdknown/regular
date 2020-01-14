<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Thirdknown\Regular\Exception\OneCharacterExpressionReceivesOnlyOneCharacterException;
use Thirdknown\Regular\Expression\OneCharacterExpression;

class OneCharacterExpressionTest extends TestCase
{
    public function testOneCharacterExpression(): void
    {
        $expression = new OneCharacterExpression('e');
        $this->assertSame('e', $expression->__toString());
    }

    public function testOneCharacterExpressionThrowsExceptionForNotOneCharacter(): void
    {
        $this->expectException(OneCharacterExpressionReceivesOnlyOneCharacterException::class);

        new OneCharacterExpression('^some (expression)*$');
    }
}
