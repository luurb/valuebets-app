<?php

namespace App\Exceptions;

use Exception;

class ClassNotFoundException extends Exception
{
    protected $message = 'Incorrect class name';
}
