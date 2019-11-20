<?php
/**
 * Created by PhpStorm.
 * User: 白猫
 * Date: 2019/6/10
 * Time: 13:47
 */

namespace ESD\Psr\Cloud;


interface Services
{
    /**
     * 获取服务的所有信息
     * @param string $service
     * @return ServiceInfoList
     */
    public function getServices(string $service): ?ServiceInfoList;

    /**
     * 获取服务的一个信息
     * @param string $service
     * @return ServiceInfo
     */
    public function getService(string $service): ?ServiceInfo;
}