<?php

namespace App\Domains\Reservation\Exceptions;

class TableNotAvailableException extends \Exception
{
    protected $code = 400;

    protected $message = 'No available tables';
}
