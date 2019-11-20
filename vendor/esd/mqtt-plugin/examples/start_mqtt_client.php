<?php


use ESD\Coroutine\Co;
use ESD\Plugins\MQTT\Debug;
use ESD\Plugins\MQTT\ExampleClass\MqttMessageHandle;
use ESD\Plugins\MQTT\MQTT;

require __DIR__ . '/../vendor/autoload.php';
Co::enableCo();
enableRuntimeCoroutine();
Debug::Disable();

$messageHandle = new MqttMessageHandle();

$mqtt1 = new MQTT("localhost:8090");
$mqtt1->setHandler($messageHandle);
$topics['mqtttest/#'] = 2;
$mqtt1->subscribe($topics);
$mqtt1->connectAndLoop();

$mqtt2 = new MQTT("localhost:8090");
$mqtt2->setHandler($messageHandle);
$topics['mqtttest/#'] = 2;
$mqtt2->subscribe($topics);
$mqtt2->connectAndLoop();


$mqtt2->publish("mqtttest","test");

