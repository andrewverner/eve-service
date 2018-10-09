<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 09.10.18
 * Time: 12:17
 */

namespace app\components\esi\exceptions;

class WrongRequestTypeException extends EVEException
{
    public function __construct(string $message = 'Wrong request type')
    {
        parent::__construct($message, 400);
    }
}
