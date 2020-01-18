<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Thirdknown\Regular\Abbreviation\Dot;
use Thirdknown\Regular\Abbreviation\NonWhitespaceCharacter;
use Thirdknown\Regular\Abbreviation\NumberCharacter;
use Thirdknown\Regular\Abbreviation\Space;

class AbbreviationTest extends TestCase
{
    public function testAbbreviation(): void
    {
        $this->assertSame('.', (new Dot())->__toString());
        $this->assertSame('\S', (new NonWhitespaceCharacter())->__toString());
        $this->assertSame('\d', (new NumberCharacter())->__toString());
        $this->assertSame(' ', (new Space())->__toString());
    }
}
