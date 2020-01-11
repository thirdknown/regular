<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Thirdknown\Regular\Border\Delimiter;
use Thirdknown\Regular\Border\DelimiterInterface;
use Thirdknown\Regular\Border\EndOfLine;
use Thirdknown\Regular\Border\PlusDelimiter;
use Thirdknown\Regular\Border\SlashDelimiter;
use Thirdknown\Regular\Border\StartOfLine;

class BorderTest extends TestCase
{
    public function testAbbreviation(): void
    {
        $this->assertSame('/', (new Delimiter('/'))->__toString());
        $this->assertSame('$', (new EndOfLine())->__toString());
        $this->assertSame('+', (new PlusDelimiter())->__toString());
        $this->assertSame('/', (new SlashDelimiter())->__toString());
        $this->assertSame('^', (new StartOfLine())->__toString());
    }

    public function testInstanceOfInterfaces(): void
    {
        $this->assertInstanceOf(DelimiterInterface::class, new Delimiter('/'));
        $this->assertInstanceOf(DelimiterInterface::class, new PlusDelimiter());
        $this->assertInstanceOf(DelimiterInterface::class, new SlashDelimiter());
    }
}
