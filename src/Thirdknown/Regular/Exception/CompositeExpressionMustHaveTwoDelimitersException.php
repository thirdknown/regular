<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Exception;

use Exception;

class CompositeExpressionMustHaveTwoDelimitersException extends Exception
{
    public function __construct()
    {
        parent::__construct('Composite expression must have two delimiters');
    }
}
