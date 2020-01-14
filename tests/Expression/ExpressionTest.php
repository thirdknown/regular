<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Thirdknown\Regular\Expression\OneCharacterExpression;

class ExpressionTest extends TestCase
{
    public function testExpression(): void
    {
        $expression = new OneCharacterExpression('^some (expression)*$');

        $this->assertSame('^some (expression)*$', $expression->__toString());
    }
}
