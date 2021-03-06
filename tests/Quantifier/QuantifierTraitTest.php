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
    public function testQuantifierTraitSimpleSet(): void
    {
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
        foreach ($this->getExpressions() as $expressionStringReprezentation => $expression) {

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

    public function testQuantifierTraitAdvancedSet(): void
    {
        /**
         * @var string
         * @var \Thirdknown\Regular\Quantifier\QuantifiableInterface $expression
         */
        foreach ($this->getExpressions() as $expressionStringReprezentation => $expression) {
            $this->assertSame(
                $expressionStringReprezentation . '*',
                (clone $expression)->setFromZeroToInfinityQuantifier()->__toString()
            );

            $this->assertSame(
                $expressionStringReprezentation . '+',
                (clone $expression)->setFromOneToInfinityQuantifier()->__toString()
            );

            $this->assertSame(
                $expressionStringReprezentation . '?',
                (clone $expression)->setFromZeroToOneQuantifier()->__toString()
            );

            $this->assertSame(
                $expressionStringReprezentation . '{17,}',
                (clone $expression)->setMinQuantifier(17)->__toString()
            );

            $this->assertSame(
                $expressionStringReprezentation . '{33,74}',
                (clone $expression)->setMinMaxQuantifier(33, 74)->__toString()
            );

            $this->assertSame(
                $expressionStringReprezentation . '{0,29}',
                (clone $expression)->setMaxQuantifier(29)->__toString()
            );

            $this->assertSame(
                $expressionStringReprezentation . '{92}',
                (clone $expression)->setExactlyQuantifier(92)->__toString()
            );

            $this->assertSame(
                $expressionStringReprezentation . '?',
                (clone $expression)
                    ->setMinQuantifier(41)
                    ->setFromZeroToInfinityQuantifier()
                    ->setFromZeroToOneQuantifier()
                    ->__toString()
            );
        }
    }

    /**
     * @return \Thirdknown\Regular\Quantifier\QuantifiableInterface[]
     */
    private function getExpressions(): array
    {
        return [
            '.' => new Dot(),
            '\S' => new NonWhitespaceCharacter(),
            '\d' => new NumberCharacter(),
            '(firstname|lastname)' =>
                (new Group())
                    ->addExpressionByExpressionInstance(new Expression('firstname'))
                    ->addExpression('lastname'),
            '[c-p]' =>
                (new AnyOf())
                    ->addExpressionByInstance(
                        new Range(
                            new Expression('c'),
                            new Expression('p')
                        )
                    ),
            '[^dv]' =>
                (new NoneOf())
                    ->addExpressionByInstance(new Expression('d'))
                    ->addExpressionByInstance(new Expression('v')),
            'e' => new OneCharacterExpression('e'),
        ];
    }
}
