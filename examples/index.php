<?php

declare(strict_types=1);

use Thirdknown\Regular\Expression;
use Tracy\Debugger;

require __DIR__ . '/../vendor/autoload.php';

Debugger::enable();

new Expression();
