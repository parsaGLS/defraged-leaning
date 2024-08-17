<?php

namespace app\core\exception;

use http\Message;

class ForbiddenException extends \Exception
{
    protected $message = 'you don\'t have permission to access this page.';
    protected $code = 403;

}