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
use Thirdknown\Regular\Expression\CompositeExpression;
use Thirdknown\Regular\Expression\Expression;
use Thirdknown\Regular\Expression\ExpressionInterface;
use Thirdknown\Regular\Expression\OneCharacterExpression;
use Thirdknown\Regular\Group\Group;
use Thirdknown\Regular\Of\AnyOf;
use Thirdknown\Regular\Of\NoneOf;
use Thirdknown\Regular\Quantifier\AsteriskQuantifier;
use Thirdknown\Regular\Quantifier\ExactlyQuantifier;
use Thirdknown\Regular\Quantifier\MaxQuantifier;
use Thirdknown\Regular\Quantifier\MinMaxQuantifier;
use Thirdknown\Regular\Quantifier\MinQuantifier;
use Thirdknown\Regular\Quantifier\PlusQuantifier;
use Thirdknown\Regular\Quantifier\QuestionMarkQuantifier;

class InstanceTest extends TestCase
{
    public function testStaticFactoryOfClassesConstructorWithAtLeastOneParameter(): void
    {
        foreach ($this->classesWithConstructorWithNoParameter() as $class) {
            $this->assertOutputAndInstanceOfSpecificClassByStaticFactory($class, []);
        }

        foreach ($this->classesWithSampleConstructorParameters() as $class => $parameters) {
            $this->assertOutputAndInstanceOfSpecificClassByStaticFactory($class, $parameters);
        }
    }

    /**
     * @param string[] $classConstructorParameters
     */
    public function assertOutputAndInstanceOfSpecificClassByStaticFactory(string $class, array $classConstructorParameters): void
    {
        $this->assertInstanceOf(
            $class,
            call_user_func_array([$class, 'create'], $classConstructorParameters)
        );

        $this->assertInstanceOf(
            ExpressionInterface::class,
            call_user_func_array([$class, 'create'], $classConstructorParameters)
        );

        $reflection = new ReflectionClass($class);
        $instanceFromReflection = $reflection->newInstanceArgs($classConstructorParameters);
        $instanceFromStaticFactory = call_user_func_array([$class, 'create'], $classConstructorParameters);

        if ($class === CompositeExpression::class) {
            $delimiter = Delimiter::create('@');
            $instanceFromReflection->addExpression($delimiter);
            $instanceFromReflection->addExpression($delimiter);
            $instanceFromStaticFactory->addExpression($delimiter);
            $instanceFromStaticFactory->addExpression($delimiter);
        }

        $this->assertSame(
            $instanceFromReflection->__toString(),
            $instanceFromStaticFactory->__toString()
        );
    }

    /**
     * @return string[]
     */
    private function classesWithConstructorWithNoParameter(): array
    {
        return [
            Dot::class,
            NonWhitespaceCharacter::class,
            NumberCharacter::class,
            EndOfLine::class,
            PlusDelimiter::class,
            SlashDelimiter::class,
            StartOfLine::class,
            Group::class,
            AnyOf::class,
            NoneOf::class,
            AsteriskQuantifier::class,
            PlusQuantifier::class,
            QuestionMarkQuantifier::class,
            CompositeExpression::class,
        ];
    }

    /**
     * @return string[]
     */
    private function classesWithSampleConstructorParameters(): array
    {
        return [
            Delimiter::class => ['%'],
            Expression::class => ['asdf'],
            OneCharacterExpression::class => ['p'],
            ExactlyQuantifier::class => [94],
            MaxQuantifier::class => [127],
            MinMaxQuantifier::class => [7, 32],
            MinQuantifier::class => [20],
        ];
    }
}
