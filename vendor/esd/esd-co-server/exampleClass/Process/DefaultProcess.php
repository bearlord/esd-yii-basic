<?php


namespace ESD\Server\Co\ExampleClass\Process;


use ESD\Core\Message\Message;
use ESD\Core\Plugins\Logger\Logger;
use ESD\Core\Server\Process\Process;
use ESD\Core\Server\Server;

class DefaultProcess extends Process
{
    /**
     * @var Logger
     */
    protected $log;

    /**
     * 在onProcessStart之前，用于初始化成员变量
     * @return mixed
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function init()
    {
        $this->log = Server::$instance->getLog();
    }

    public function onProcessStart()
    {
        $this->log->info("onProcessStart");
    }

    public function onProcessStop()
    {
        $this->log->info("onProcessStop");
    }

    public function onPipeMessage(Message $message, Process $fromProcess)
    {
        // TODO: Implement onPipeMessage() method.
    }
}