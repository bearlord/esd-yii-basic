<?php
/**
 * Created by PhpStorm.
 * User: 白猫
 * Date: 2019/5/5
 * Time: 15:30
 */

namespace ESD\Plugins\EasyRoute\Controller;


use DI\Annotation\Inject;
use ESD\Core\ParamException;
use ESD\Core\Server\Beans\Request;
use ESD\Core\Server\Beans\Response;
use ESD\Plugins\EasyRoute\MethodNotAllowedException;
use ESD\Plugins\EasyRoute\RouteException;
use ESD\Plugins\Pack\ClientData;
use Psr\Log\LoggerInterface;

abstract class EasyController implements IController
{
    /**
     * @Inject()
     * @var Request
     */
    protected $request;
    /**
     * @Inject()
     * @var Response
     */
    protected $response;
    /**
     * @Inject()
     * @var ClientData
     */
    protected $clientData;
    /**
     * @Inject()
     * @var LoggerInterface
     */
    protected $log;

    public function __construct()
    {

    }

    /**
     * 调用方法
     * @param string|null $controllerName
     * @param string|null $methodName
     * @param array|null $params
     * @return mixed
     * @throws \Throwable
     */
    public function handle(?string $controllerName, ?string $methodName, ?array $params)
    {
        if (!is_callable([$this, $methodName]) || $methodName == null) {
            $callMethodName = 'defaultMethod';
        } else {
            $callMethodName = $methodName;
        }
        try {
            $result = $this->initialization($controllerName, $methodName);
            if ($result != null) {
                return $result;
            }
            if ($params == null) {
                if ($callMethodName == "defaultMethod") {
                    return $this->defaultMethod($methodName);
                } else {
                    return call_user_func([$this, $callMethodName]);
                }
            } else {
                $params = array_values($params);
                return call_user_func_array([$this, $callMethodName], $params);
            }
        } catch (\Throwable $e) {
            setContextValue("lastException", $e);
            return $this->onExceptionHandle($e);
        }
    }

    /**
     * 每次请求都会调用
     * @param string|null $controllerName
     * @param string|null $methodName
     * @return mixed
     */
    public function initialization(?string $controllerName, ?string $methodName)
    {

    }

    /**
     * 找不到方法时调用
     * @param $methodName
     * @return mixed
     */
    abstract protected function defaultMethod(?string $methodName);

    /**
     * 处理异常
     * @param $e
     * @return mixed
     * @throws \Throwable
     */
    public function onExceptionHandle(\Throwable $e)
    {
        if ($this->clientData->getResponse() != null) {
            $this->response->withStatus(404);
            $this->response->withHeader("Content-Type", "text/html;charset=UTF-8");

            if ($e instanceof RouteException) {
                $msg = '404 Not found / ' . $e->getMessage();
            } elseif ($e instanceof ParamException) {
                $this->response->withStatus(400);
                $msg = '400 Bad request / ' . $e->getMessage();
            } else if ($e instanceof MethodNotAllowedException) {
                $this->response->withStatus(405);
                $msg = '405 method not allowed';
            } else {
                $this->response->withStatus(500);
                $msg = '500 internal server error';
            }
            return $msg;
        } else {
            return $e->getMessage();
        }
    }
}
