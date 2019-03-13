<?php
/**
 * 结构型模式
 *
 * php适配器模式
 * 将一个类的接口，转换成客户期望的另一个接口。适配器让原本不兼容的类可以合作无间。
 *
 * @author  TIGERB <https://github.com/TIGERB>
 * @example 运行 php test.php
 */


// 注册自加载
spl_autoload_register('autoload');

function autoload($class)
{
  require dirname($_SERVER['SCRIPT_FILENAME']) . '//..//' . str_replace('\\', '/', $class) . '.php';
}

/************************************* test *************************************/

use adapter\AudioPlayer;

try {
  //生产一台设备
  $mp4 = new AudioPlayer();
  // 播放一个mp3
  $mp4->play('忍者', 'mp3');
  // 播放一个wma
  $mp4->play('彩虹', 'wma');
  // 播放一个mp4
  $mp4->play('龙卷风mv', 'mp4');
} catch (\Exception $e) {
  echo $e->getMessage();
}
