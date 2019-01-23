<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/11
 * Time: 11:07
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Test;

class TestController extends Controller{
    public function index(){
        Test::getMessage('hello world');

        echo '<br>';

        $test =  app()->make('test');
        $test->getMessage();
        dd(get_class_methods(get_class($test)));
    }

    public function reflection(){
        $reflecter = new \ReflectionClass('App\Lib\Utils\Testcc');
        \Reflection::export($reflecter);

        $calss = get_class($reflecter);
        print_r($calss);

        $methods = get_class_methods($reflecter);
        print_r($methods);

        $vars = get_class_vars($calss);
        dd($vars);
    }

    public function spl(){
        class_alias('Person','Pepole');
        $p_person = new Person('zhaofei',23,185,72);
        var_dump($p_person);

        $p_pepole = new Pepole('xiaoming',27,175,62);
        var_dump($p_pepole);
        // the objects are the same
        var_dump($p_person == $p_pepole, $p_person === $p_pepole);
        var_dump($p_person instanceof $p_pepole);

        // the classes are the same
        var_dump($p_person instanceof Person);
        var_dump($p_person instanceof Pepole);

        var_dump($p_pepole instanceof Person);
        var_dump($p_pepole instanceof Pepole);

        spl_autoload_register([$this, 'load'], true, true);
    }

    protected function load($alias){
        $aliases = config('app.aliases');
        return class_alias($aliases[$alias], $alias);
    }

    public function test2(){
        //    use Illuminate\Support\Facades\Storage;
        //    use App\Http\Controllers\VideoController;
        //    use App\Http\Controllers\PhotoControllers;
        //    use Illuminate\Contracts\Filesystem\Filesystem;

        app()->when(PhotoController::class)
            ->needs(Filesystem::class)
            ->give(function () {
                return Storage::disk('local');
            });

        app()->when(VideoController::class)
            ->needs(Filesystem::class)
            ->give(function () {
                return Storage::disk('s3');
            });
    }
}
