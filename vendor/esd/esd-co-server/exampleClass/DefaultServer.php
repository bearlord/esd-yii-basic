<?php

namespace ESD\Server\Co\ExampleClass;

use ESD\Core\Server\Config\ServerConfig;
use ESD\Core\Server\Process\Process;
use ESD\Server\Co\ExampleClass\Port\DefaultPort;
use ESD\Server\Co\ExampleClass\Process\DefaultProcess;
use ESD\Server\Co\Server;

class DefaultServer extends Server
{
    public function __construct(?ServerConfig $serverConfig = null, string $defaultPortClass = DefaultPort::class, string $defaultProcessClass = DefaultProcess::class)
    {
        parent::__construct($serverConfig, $defaultPortClass, $defaultProcessClass);
    }

    /**
     * 所有的配置插件已初始化好
     * @return mixed
     */
    public function configureReady()
    {
        // TODO: Implement configureReady() method.
    }

    public function onStart()
    {
        // TODO: Implement onStart() method.
    }

    public function onShutdown()
    {
        // TODO: Implement onShutdown() method.
    }

    public function onWorkerError(Process $process, int $exit_code, int $signal)
    {
        // TODO: Implement onWorkerError() method.
    }

    public function onManagerStart()
    {
        // TODO: Implement onManagerStart() method.
    }

    public function onManagerStop()
    {
        // TODO: Implement onManagerStop() method.
    }

    /**
     * 插件初始化结束
     * @return mixed
     */
    public function pluginInitialized()
    {
        // TODO: Implement pluginInitialized() method.
    }
}