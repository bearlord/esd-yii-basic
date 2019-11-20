<?php

use ESD\Core\Server\Config\PortConfig;
use ESD\Core\Server\Config\ServerConfig;
use ESD\Plugins\Aop\AopConfig;
use ESD\Plugins\Aop\AopPlugin;
use ESD\Plugins\EasyRoute\EasyRouteConfig;
use ESD\Plugins\EasyRoute\EasyRoutePlugin;
use ESD\Plugins\Pack\PackTool\LenJsonPack;
use ESD\Plugins\Pack\PackTool\NonJsonPack;
use ESD\Server\Co\ExampleClass\DefaultServer;

require __DIR__ . '/../vendor/autoload.php';


//----多端口配置----
$httpPortConfig = new EasyRouteConfig();
$httpPortConfig->setHost("0.0.0.0");
$httpPortConfig->setPort(8082);
$httpPortConfig->setSockType(PortConfig::SWOOLE_SOCK_TCP);
$httpPortConfig->setOpenHttpProtocol(true);
$httpPortConfig->setControllerNameSpace("ESD\Plugins\EasyRoute\ExampleClass");
$httpPortConfig->setPackTool(LenJsonPack::class);
$httpPortConfig->setMethodPrefix("http_");

$wsPortConfig = new EasyRouteConfig();
$wsPortConfig->setHost("0.0.0.0");
$wsPortConfig->setPort(8081);
$wsPortConfig->setSockType(PortConfig::SWOOLE_SOCK_TCP);
$wsPortConfig->setOpenWebsocketProtocol(true);
$wsPortConfig->setControllerNameSpace("ESD\Plugins\EasyRoute\ExampleClass");
$wsPortConfig->setPackTool(NonJsonPack::class);
$wsPortConfig->setMethodPrefix("ws_");

//---服务器配置---
$serverConfig = new ServerConfig();
$serverConfig->setWorkerNum(4);
$serverConfig->setRootDir(__DIR__ . "/../");

$server = new DefaultServer($serverConfig);
//添加端口
$server->addPort("http", $httpPortConfig);
$server->addPort("ws", $wsPortConfig);
//添加插件
$aopPlugin = new AopPlugin(new AopConfig(__DIR__ . "/../exampleClass"));
$server->getPlugManager()->addPlug($aopPlugin);
//添加路由信息
$easyRoutePlugin = new EasyRoutePlugin();
$server->getPlugManager()->addPlug($easyRoutePlugin);
//添加进程
$server->addProcess("test1");
$server->addProcess("test2");//使用自定义实例
//配置
$server->configure();
//configure后可以获取实例
$test1Process = $server->getProcessManager()->getProcessFromName("test1");
$test2Process = $server->getProcessManager()->getProcessFromName("test2");
$httpPort = $server->getPortManager()->getPortFromName("http");
$wsPort = $server->getPortManager()->getPortFromName("ws");
//启动
$server->start();
