<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Exception;

use Exception;

class OneCharacterExpressionReceivesOnlyOneCharacterException extends Exception
{
    public function __construct()
    {
        parent::__construct('OneCharacterEpression receives only one character');
    }
}
