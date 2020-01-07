<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Exception;

use Exception;

class CompositeExpressionMustHaveOnlyTwoDelimitersException extends Exception
{
    public function __construct()
    {
        parent::__construct('Composite expression must have only two delimiters');
    }
}
