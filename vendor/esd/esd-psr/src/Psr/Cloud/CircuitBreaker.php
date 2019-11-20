<?php
/**
 * Created by PhpStorm.
 * User: 白猫
 * Date: 2019/6/12
 * Time: 12:40
 */

namespace ESD\Psr\Cloud;


interface CircuitBreaker
{
    public function failure($service);
    public function success($service);
    public function isAvailable($service);
    public function reset();
    public function setEnable($enable);
    public function isEnable();
}