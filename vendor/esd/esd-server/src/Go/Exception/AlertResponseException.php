<?php
/**
 * Created by PhpStorm.
 * User: anythink
 * Date: 2019/5/30
 * Time: 11:46 AM
 */
namespace ESD\Go\Exception;

use ESD\Core\Plugins\Logger\GetLogger;

class AlertResponseException extends \Exception{

    use GetLogger;
    function __construct($message = null, $code = 500, \Throwable $previous = null)
    {
        if(is_null($message)){
            $message = "内部服务器错误，请稍后再试";
        }
        $this->alert($message);
        $this->alert($this);
        return parent::__construct($message, $code, $previous);
    }
}