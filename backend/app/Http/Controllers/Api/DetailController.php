<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/12
 * Time: 10:57
 */

namespace App\Http\Controllers\Api;

use Pimple\Container;
class DetailController
{
    public function index(){
//        $reflector = new \ReflectionClass('ReflectionClass');
//        echo $reflector->getName();
//        $constructor = $reflector->getConstructor();
//        dd($constructor->getParameters());

        $reflector = new \ReflectionClass(DetailController::class);
        $object = $reflector->newInstance();
        $object->test();
    }

    public function test(){
        $container = new Container();
        echo 'hello world';
    }
}