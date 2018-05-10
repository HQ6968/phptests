<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/5/10
 * Time: 下午2:46
 */

namespace app\entity;


use Throwable;

class Exception extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}