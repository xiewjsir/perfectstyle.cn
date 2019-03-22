<?php

/**
  * 命令模式
 * 将请求封装为一个对象，从而使你可用不同的请求对客户进行参数化;对请求排队或记录请求日志，以及支持可撤回的操作。
 */
/* * 命令接收者
 * Class Tv
 */
class Tv {
    public $curr_channel = 0;
    /**
     * 打开电视机
     */
    public function turnOn() {
        echo "The television is on." . "<br/>";
    }

    /**
     * 关闭电视机
     */
    public function turnOff() {
        echo "The television is off." . "<br/>";
    }

    /*
     * 切换频道
     * @param $channel    频道
     */
    public function turnChannel($channel) {
        $this->curr_channel = $channel;
        echo "This TV Channel is " . $this->curr_channel . "<br/>";
    }
}

/* * 执行命令接口
 * Interface ICommand
 */
interface ICommand {
    function execute();
}

/* * 开机命令
 * Class CommandOn
 */
class CommandOn implements ICommand {
    private $tv;
    public function __construct($tv) {
        $this->tv = $tv;
    }

    public function execute() {
        $this->tv->turnOn();
    }
}

/* * 关机命令
 * Class CommandOn
 */
class CommandOff implements ICommand {
    private $tv;
    public function __construct($tv) {
        $this->tv = $tv;
    }

    public function execute() {
        $this->tv->turnOff();
    }
}

/* * 切换频道命令
 * Class CommandOn
 */

class CommandChannel implements ICommand {
    private $tv;
    private $channel;
    public function __construct($tv, $channel) {
        $this->tv = $tv;
        $this->channel = $channel;
    }

    public function execute() {
        $this->tv->turnChannel($this->channel);
    }
}

/* * 遥控器
 * Class Control
 */

class Control {
    private $_onCommand;
    private $_offCommand;
    private $_changeChannel;
    public function __construct($on, $off, $channel) {
        $this->_onCommand = $on;
        $this->_offCommand = $off;
        $this->_changeChannel = $channel;
    }

    public function turnOn() {
        $this->_onCommand->execute();
    }

    public function turnOff() {
        $this->_offCommand->execute();
    }

    public function changeChannel() {
        $this->_changeChannel->execute();
    }
}

header("Content-Type:text/html;charset=utf-8");
//----------------------命令模式--------------------
// 命令接收者 　
$myTv = new Tv();
// 开机命令 　
$on = new CommandOn($myTv);
// 关机命令 　
$off = new CommandOff($myTv);

// 频道切换命令 　
$channel = new CommandChannel($myTv, 2);
// 命令控制对象　
$control = new Control($on, $off, $channel);
// 开机 　
$control->turnOn();
// 切换频道 　
$control->changeChannel();
// 关机 　
$control->turnOff();
