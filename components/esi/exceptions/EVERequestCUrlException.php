<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 09.10.18
 * Time: 12:31
 */

namespace app\components\esi\exceptions;

use Throwable;

class EVERequestCUrlException extends EVEException
{
    public function __construct(string $message = 'Request cUrl error')
    {
        parent::__construct($message, 500);
    }
}
