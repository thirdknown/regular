<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Thirdknown\Regular\Abbreviation\Dot;
use Thirdknown\Regular\Abbreviation\NonWhitespaceCharacter;
use Thirdknown\Regular\Abbreviation\NumberCharacter;
use Thirdknown\Regular\Border\Delimiter;
use Thirdknown\Regular\Border\EndOfLine;
use Thirdknown\Regular\Border\PlusDelimiter;
use Thirdknown\Regular\Border\SlashDelimiter;
use Thirdknown\Regular\Border\StartOfLine;
use Thirdknown\Regular\Exception\CompositeExpressionMustHaveOnlyTwoDelimitersException;
use Thirdknown\Regular\Exception\CompositeExpressionMustHaveSameDelimitersException;
use Thirdknown\Regular\Exception\CompositeExpressionMustHaveTwoDelimitersException;
use Thirdknown\Regular\Expression\CompositeExpression;
use Thirdknown\Regular\Expression\OneCharacterExpression;
use Thirdknown\Regular\Quantifier\AsteriskQuantifier;
use Thirdknown\Regular\Quantifier\ExactlyQuantifier;
use Thirdknown\Regular\Quantifier\MinQuantifier;
use Thirdknown\Regular\Quantifier\QuestionMarkQuantifier;

class CompositeExpressionTest extends TestCase
{
    public function testCompositeExpressionCommonBehavior(): void
    {
        $compositeExpressionWithExactlyQuantifier = new CompositeExpression();
        $slashDelimiter = new SlashDelimiter();
        $compositeExpressionWithExactlyQuantifier
            ->addExpression($slashDelimiter)
            ->addExpression(new StartOfLine())
            ->addExpression(new OneCharacterExpression('(name)'))
            ->addExpression(new ExactlyQuantifier(1))
            ->addExpression(new Dot())
            ->addExpression(new QuestionMarkQuantifier())
            ->addExpression(new NonWhitespaceCharacter())
            ->addExpression(new EndOfLine())
            ->addExpression($slashDelimiter);

        $compositeExpressionWithPlusQuantifier = new CompositeExpression();
        $plusDelimiter = new PlusDelimiter();
        $compositeExpressionWithPlusQuantifier
            ->addExpression($plusDelimiter)
            ->addExpression(new OneCharacterExpression('(name)'))
            ->addExpression(new AsteriskQuantifier())
            ->addExpression(new OneCharacterExpression('(surname)'))
            ->addExpression(new MinQuantifier(1))
            ->addExpression(new OneCharacterExpression(', job position: [a-z]'))
            ->addExpression(new NumberCharacter())
            ->addExpression($plusDelimiter);

        $this->assertSame('/^(name){1}.?\S$/', $compositeExpressionWithExactlyQuantifier->__toString());
        $this->assertSame('+(name)*(surname){1,}, job position: [a-z]\d+', $compositeExpressionWithPlusQuantifier->__toString());
    }

    public function testCompositeExpressionDelimiters(): void
    {
        $compositeExpressionWithSlashDelimiter = new CompositeExpression();
        $slashDelimiter = new SlashDelimiter();
        $compositeExpressionWithSlashDelimiter
            ->addExpression($slashDelimiter)
            ->addExpression(new OneCharacterExpression('expression'))
            ->addExpression($slashDelimiter);

        $compositeExpressionWithPlusDelimiter = new CompositeExpression();
        $plusDelimiter = new PlusDelimiter();
        $compositeExpressionWithPlusDelimiter
            ->addExpression($plusDelimiter)
            ->addExpression(new OneCharacterExpression('expression'))
            ->addExpression($plusDelimiter);

        $compositeExpressionWithCustomDelimiter = new CompositeExpression();
        $delimiter = new Delimiter('@');
        $compositeExpressionWithCustomDelimiter
            ->addExpression($delimiter)
            ->addExpression(new OneCharacterExpression('expression'))
            ->addExpression($delimiter);

        $this->assertSame('/expression/', $compositeExpressionWithSlashDelimiter->__toString());
        $this->assertSame('+expression+', $compositeExpressionWithPlusDelimiter->__toString());
        $this->assertSame('@expression@', $compositeExpressionWithCustomDelimiter->__toString());
    }

    public function testCompositeExpressionSameDelimiters(): void
    {
        $this->expectException(CompositeExpressionMustHaveSameDelimitersException::class);

        $compositeExpressionWithNotSameDelimiters = new CompositeExpression();
        $delimiter1 = new Delimiter('@');
        $delimiter2 = new Delimiter('@');
        $compositeExpressionWithNotSameDelimiters
            ->addExpression($delimiter1)
            ->addExpression(new OneCharacterExpression('expression'))
            ->addExpression($delimiter2);
    }

    public function testCompositeExpressionUpToTwoDelimiters(): void
    {
        $this->expectException(CompositeExpressionMustHaveOnlyTwoDelimitersException::class);

        $compositeExpressionWithNotSameDelimiters = new CompositeExpression();
        $delimiter = new Delimiter('@');
        $compositeExpressionWithNotSameDelimiters
            ->addExpression($delimiter)
            ->addExpression(new OneCharacterExpression('expression'))
            ->addExpression($delimiter)
            ->addExpression($delimiter);
    }

    public function testCompositeExpressionTwoDelimiters(): void
    {
        $this->expectException(CompositeExpressionMustHaveTwoDelimitersException::class);

        $compositeExpressionWithNotSameDelimiters = new CompositeExpression();
        $delimiter = new Delimiter('@');
        $compositeExpressionWithNotSameDelimiters
            ->addExpression($delimiter)
            ->addExpression(new OneCharacterExpression('expression'));

        $compositeExpressionWithNotSameDelimiters->__toString();
    }
}
