<?php

namespace SuperStation\Gamehub\Exceptions;

use Exception;
use Illuminate\Support\Arr;
use Throwable;

class ApiException extends Exception
{
    public function __construct(Exception $exception)
    {
        $message = Arr::get($this->systemErrorCodes, $exception->getCode(), '未知的錯誤');
        $code = $exception->getCode();

        parent::__construct($message, $code, $exception);
    }
}