<?php
/**
 * Created by PhpStorm.
 * User: 白猫
 * Date: 2019/4/16
 * Time: 15:48
 */

namespace ESD\Core\Server\Beans;

/**
 * WebSocketFrame结构
 * Class WebSocketFrame
 * @package ESD\Core\Server\Beans
 */
class WebSocketFrame
{
    private $fd;
    private $data;
    private $opcode;
    private $finish;
    private $swooleFrame;

    public function __construct($frame)
    {
        $this->swooleFrame = $frame;
        $this->fd = $frame->fd;
        $this->opcode = $frame->opcode;
        $this->data = $frame->data;
        $this->finish = $frame->finish;
    }

    /**
     * @return mixed
     */
    public function getFd()
    {
        return $this->fd;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getOpcode()
    {
        return $this->opcode;
    }

    /**
     * @return mixed
     */
    public function getFinish()
    {
        return $this->finish;
    }

    /**
     * @return mixed
     */
    public function getSwooleFrame()
    {
        return $this->swooleFrame;
    }

    /**
     * @param mixed $fd
     */
    public function setFd($fd): void
    {
        $this->fd = $fd;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @param mixed $opcode
     */
    public function setOpcode($opcode): void
    {
        $this->opcode = $opcode;
    }

    /**
     * @param mixed $finish
     */
    public function setFinish($finish): void
    {
        $this->finish = $finish;
    }
}