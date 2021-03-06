<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Exception;

use Exception;

class OneCharacterExpressionReceivesOnlyOneCharacterException extends Exception
{
    public function __construct()
    {
        parent::__construct('OneCharacterExpression receives only one character');
    }
}
