<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Thirdknown\Regular\Abbreviation\NonWhitespaceCharacter;
use Thirdknown\Regular\Abbreviation\NumberCharacter;
use Thirdknown\Regular\Expression\OneCharacterExpression;
use Thirdknown\Regular\Of\AnyOf;
use Thirdknown\Regular\Of\CloseSquareBracket;
use Thirdknown\Regular\Of\Dash;
use Thirdknown\Regular\Of\Negation;
use Thirdknown\Regular\Of\NoneOf;
use Thirdknown\Regular\Of\OpenSquareBracket;
use Thirdknown\Regular\Of\Range;

class OfTest extends TestCase
{
    public function testAnyOf(): void
    {
        $anyOf = new AnyOf();
        $anyOf
            ->addExpression(new NonWhitespaceCharacter())
            ->addExpression(new OneCharacterExpression('9'))
            ->addExpression(new OneCharacterExpression('@'));
        $this->assertSame('[\S9@]', $anyOf->__toString());
    }

    public function testNoneOf(): void
    {
        $noneOf = new NoneOf();
        $noneOf
            ->addExpression(new OneCharacterExpression('d'))
            ->addExpression(new NumberCharacter())
            ->addExpression(new OneCharacterExpression('f'));
        $this->assertSame('[^d\df]', $noneOf->__toString());
    }

    public function testRange(): void
    {
        $range = new Range(
            new OneCharacterExpression('b'),
            new OneCharacterExpression('p')
        );
        $this->assertSame('b-p', $range->__toString());

        $numericRange = new Range(
            new OneCharacterExpression('3'),
            new OneCharacterExpression('7')
        );
        $this->assertSame('3-7', $numericRange->__toString());
    }

    public function testSimpleExpression(): void
    {
        $this->assertSame('^', (new Negation())->__toString());
        $this->assertSame('-', (new Dash())->__toString());
        $this->assertSame('[', (new OpenSquareBracket())->__toString());
        $this->assertSame(']', (new CloseSquareBracket())->__toString());
    }
}
