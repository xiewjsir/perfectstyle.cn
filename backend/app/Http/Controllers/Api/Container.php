<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/19
 * Time: 12:05
 */

namespace App\Http\Controllers\Api;


class Contner implements ArrayAccess, ContainerContract
{
    /**
     * An array of the types that have been resolved.
     * 记录实例化过的 $abstract ，key 为 $abstract，velue 为布尔值
     */
    protected $resolved = [];

    /**
     * The container's bindings.
     * 容器的 bindings （绑定关系），key 为 $abstract ，value 为程序处理过的 $concrete，为一个关联数组，模型如下：
     * [
     *  'concrete' => Closure,
     *  'shared' => bool
     * ]
     */
    protected $bindings = [];

    /**
     * The container's shared instances.
     * 可共享的 $abstract 的实例, 键为可共享的 $abstract , 值为 $abstract 对应的实例
     */
    protected $instances = [];

    /**
     * The registered type aliases.
     * $abstract 的别名, key 是别名, value 是别名对应的$abstract
     * @var array
     */
    protected $aliases = [];

    /**
     * The extension closures for services.
     * 扩展的 $abstract ，为一个二维数组，key 为 $abstract, vaule 为 Closure 组成的数组
     */
    protected $extenders = [];

    /**
     * All of the registered tags.
     * 注册的 $abstract tags
     * @var array
     */
    protected $tags = [];

    /**
     * The stack of concretions currently being built.
     * 当前正在创建的 concretions 的堆栈
     * @var array
     */
    protected $buildStack = [];

    /**
     * The contextual binding map.
     *
     * @var array
     */
    public $contextual = [];

    /**
     * All of the resolving callbacks by class type.
     * resolving 回调函数
     */
    protected $resolvingCallbacks = [];

    /**
     * All of the after resolving callbacks by class type.
     * Resolving 之后的回调函数
     */
    protected $afterResolvingCallbacks = [];

    /**
     * Define a contextual binding.
     * 定义一个上下文的绑定
     */
    public function when($concrete);

    /**
     * Determine if the given abstract type has been bound.
     * 判断 $abstract 是否绑定过
     */
    public function bound($abstract);

    /**
     * Determine if the given abstract type has been resolved.
     * $abstract 是否实例化过
     */
    public function resolved($abstract);

    /**
     * Register a binding with the container.
     * 在容器上，将 $abstract 绑定到 $concrete
     */
    public function bind($abstract, $concrete = null, $shared = false);

    /**
     * Register a shared binding in the container.
     * 注册一个可共享的绑定到容器
     */
    public function singleton($abstract, $concrete = null);

    /**
     * "Extend" an abstract type in the container.
     * 在容器上扩展一个 $abstract
     */
    public function extend($abstract, Closure $closure);

    /**
     * Register an existing instance as shared in the container.
     * 注册一个可共享的实例到容器
     * @return void
     */
    public function instance($abstract, $instance);

    /**
     * Assign a set of tags to a given binding.
     * 给一组 $abstract 打上一组 tag
     */
    public function tag($abstracts, $tags);

    /**
     * Resolve all of the bindings for a given tag.
     * 实例化 $tag 下的 $abstract
     */
    public function tagged($tag);

    /**
     * Alias a type to a different name.
     * 给 $abstract 起别名 $alias
     */
    public function alias($abstract, $alias);


    /**
     * Call the given Closure / class@method and inject its dependencies.
     * 调用给定匿名函数或者 class@method 描述的类的方法，并且自动注入依赖参数
     */
    public function call($callback, array $parameters = [], $defaultMethod = null);

    /**
     * Resolve the given type from the container.
     * 实例化 $abstract 绑定的 $concrete
     */
    public function make($abstract, array $parameters = []);

    /**
     * Get the alias for an abstract if available.
     * 返回 $abstract 作为别名对应的真正的 $abstract。
     */
    public function getAlias($abstract);
}
