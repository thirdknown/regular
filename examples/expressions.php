<?php

declare(strict_types=1);

use Thirdknown\Regular\Border\SlashDelimiter;
use Thirdknown\Regular\Expression\CompositeExpression;
use Thirdknown\Regular\Expression\OneCharacterExpression;
use Thirdknown\Regular\Quantifier\ExactlyQuantifier;

require __DIR__ . '/bootstrap.php';

$compositeExpression = new CompositeExpression();

$compositeExpression
    ->addExpression(new SlashDelimiter())
    ->addExpression(new OneCharacterExpression('name'))
    ->addExpression(new ExactlyQuantifier(1))
    ->addExpression(new SlashDelimiter());

echo $compositeExpression;
