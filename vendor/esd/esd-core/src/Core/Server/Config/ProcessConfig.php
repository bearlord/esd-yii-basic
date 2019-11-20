<?php
/**
 * Created by PhpStorm.
 * User: 白猫
 * Date: 2019/4/19
 * Time: 9:29
 */

namespace ESD\Core\Server\Config;

use ESD\Core\Plugins\Config\BaseConfig;
use ESD\Core\Plugins\Config\ConfigException;
use ESD\Core\Server\Process\Process;

/**
 * 进程配置
 * Class ProcessConfig
 * @package ESD\Core\Server\Config
 */
class ProcessConfig extends BaseConfig
{
    const key = "esd.process";
    protected $name;
    protected $className;
    protected $groupName;

    /**
     * ProcessConfig constructor.
     * @param $name
     * @param $className
     * @param string $groupName
     * @throws ConfigException
     * @throws \ReflectionException
     */
    public function __construct($className = null, $name = null, $groupName = Process::DEFAULT_GROUP)
    {
        parent::__construct(self::key, true, "name");
        if ($groupName == Process::WORKER_GROUP) {
            throw new ConfigException("自定义进程不允许使用WORKER_GROUP组名");
        }
        $this->groupName = $groupName;
        $this->name = $name;
        $this->className = $className;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param mixed $className
     */
    public function setClassName($className): void
    {
        $this->className = $className;
    }

    /**
     * @return mixed
     */
    public function getGroupName()
    {
        return $this->groupName;
    }

    /**
     * @param mixed $groupName
     */
    public function setGroupName($groupName): void
    {
        $this->groupName = $groupName;
    }
}