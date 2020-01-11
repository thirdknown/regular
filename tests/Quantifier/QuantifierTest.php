<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Thirdknown\Regular\Quantifier\AsteriskQuantifier;
use Thirdknown\Regular\Quantifier\ExactlyQuantifier;
use Thirdknown\Regular\Quantifier\MaxQuantifier;
use Thirdknown\Regular\Quantifier\MinMaxQuantifier;
use Thirdknown\Regular\Quantifier\MinQuantifier;
use Thirdknown\Regular\Quantifier\PlusQuantifier;
use Thirdknown\Regular\Quantifier\QuestionMarkQuantifier;

class QuantifierTest extends TestCase
{
    public function testAbbreviation(): void
    {
        $this->assertSame('*', (new AsteriskQuantifier())->__toString());
        $this->assertSame('{9}', (new ExactlyQuantifier(9))->__toString());
        $this->assertSame('{0,4}', (new MaxQuantifier(4))->__toString());
        $this->assertSame('{11,25}', (new MinMaxQuantifier(11, 25))->__toString());
        $this->assertSame('{7,}', (new MinQuantifier(7))->__toString());
        $this->assertSame('+', (new PlusQuantifier())->__toString());
        $this->assertSame('?', (new QuestionMarkQuantifier())->__toString());
    }
}
