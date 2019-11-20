<?php

use ESD\Core\Server\Config\ServerConfig;
use ESD\Server\Co\ExampleClass\DefaultServer;
use ESD\Server\Co\ExampleClass\Port\DefaultPort;
use ESD\Server\Co\ExampleClass\Process\DefaultProcess;

require __DIR__ . '/../vendor/autoload.php';

define("ROOT_DIR", __DIR__ . "/../");
define("RES_DIR", __DIR__ . "/resources");

$server = new DefaultServer(
    new ServerConfig(),
    DefaultPort::class,
    DefaultProcess::class);

$server->configure();
$server->start();