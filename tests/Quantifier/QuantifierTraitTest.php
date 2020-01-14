<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Thirdknown\Regular\Abbreviation\Dot;
use Thirdknown\Regular\Abbreviation\NonWhitespaceCharacter;
use Thirdknown\Regular\Abbreviation\NumberCharacter;
use Thirdknown\Regular\Expression\Expression;
use Thirdknown\Regular\Expression\OneCharacterExpression;
use Thirdknown\Regular\Group\Group;
use Thirdknown\Regular\Of\AnyOf;
use Thirdknown\Regular\Of\NoneOf;
use Thirdknown\Regular\Of\Range;
use Thirdknown\Regular\Quantifier\AsteriskQuantifier;
use Thirdknown\Regular\Quantifier\ExactlyQuantifier;
use Thirdknown\Regular\Quantifier\MaxQuantifier;
use Thirdknown\Regular\Quantifier\MinMaxQuantifier;
use Thirdknown\Regular\Quantifier\MinQuantifier;
use Thirdknown\Regular\Quantifier\PlusQuantifier;
use Thirdknown\Regular\Quantifier\QuestionMarkQuantifier;

class QuantifierTraitTest extends TestCase
{
    public function testAbbreviation(): void
    {
        /** @var \Thirdknown\Regular\Quantifier\QuantifiableInterface $expressions */
        $expressions = [
            '.' => new Dot(),
            '\S' => new NonWhitespaceCharacter(),
            '\d' => new NumberCharacter(),
            '(firstname|lastname)' =>
                (new Group())
                    ->addExpression(new Expression('firstname'))
                    ->addExpression(new Expression('lastname')),
            '[c-p]' =>
                (new AnyOf())
                    ->addExpression(
                        new Range(
                            new Expression('c'),
                            new Expression('p')
                        )
                    ),
            '[^dv]' =>
                (new NoneOf())
                    ->addExpression(new Expression('d'))
                    ->addExpression(new Expression('v')),
            'e' => new OneCharacterExpression('e'),
        ];

        /** @var \Thirdknown\Regular\Quantifier\QuantifierInterface $quantifiers */
        $quantifiers = [
            '*' => new AsteriskQuantifier(),
            '{9}' => new ExactlyQuantifier(9),
            '{0,4}' => new MaxQuantifier(4),
            '{11,25}' => new MinMaxQuantifier(11, 25),
            '{7,}' => new MinQuantifier(7),
            '+' => new PlusQuantifier(),
            '?' => new QuestionMarkQuantifier(),
        ];

        /**
         * @var string
         * @var \Thirdknown\Regular\Quantifier\QuantifiableInterface $expression
         */
        foreach ($expressions as $expressionStringReprezentation => $expression) {

            /**
             * @var string
             * @var \Thirdknown\Regular\Quantifier\QuantifierInterface  $quantifier
             */
            foreach ($quantifiers as $quantifierTextReprezentation => $quantifier) {
                $this->assertSame(
                    $expressionStringReprezentation . $quantifierTextReprezentation,
                    (clone $expression)->setQuantifier((clone $quantifier))->__toString()
                );
            }
        }
    }
}
