<?php

declare(strict_types=1);

namespace Thirdknown\Regular\Exception;

use Exception;

class BuilderIsAlreadyLockedException extends Exception
{
    public function __construct()
    {
        parent::__construct('Builder is already locked');
    }
}
