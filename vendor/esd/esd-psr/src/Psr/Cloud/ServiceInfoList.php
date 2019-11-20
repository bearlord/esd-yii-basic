<?php
/**
 * Created by PhpStorm.
 * User: 白猫
 * Date: 2019/6/10
 * Time: 13:57
 */

namespace ESD\Psr\Cloud;


class ServiceInfoList
{
    /**
     * @var string
     */
    private $serviceName;

    /**
     * @var ServiceInfo[]
     */
    private $serviceInfos;

    public function __construct(string $serviceName, array $serviceInfos)
    {
        $this->serviceName = $serviceName;
        $this->serviceInfos = $serviceInfos;
    }

    /**
     * @return string
     */
    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    /**
     * @param string $serviceName
     */
    public function setServiceName(string $serviceName): void
    {
        $this->serviceName = $serviceName;
    }

    /**
     * @return ServiceInfo[]
     */
    public function getServiceInfos(): array
    {
        return $this->serviceInfos;
    }

    /**
     * @param ServiceInfo[] $serviceInfos
     */
    public function setServiceInfos(array $serviceInfos): void
    {
        $this->serviceInfos = $serviceInfos;
    }
}