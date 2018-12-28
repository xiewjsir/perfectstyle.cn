<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/19
 * Time: 11:58
 */

namespace App\Http\Controllers\Api;


interface Container
{
    /**
     * Determine if the given abstract type has been bound.
     * 判断给定 $abstract 是否已经被绑定
     */
    public function bound($abstract);

    /**
     * Alias a type to a different name.
     * 给一下 $abstract 起一个别名
     */
    public function alias($abstract, $alias);

    /**
     * Assign a set of tags to a given binding.
     * 给一组 $abstracts 打上一组tag
     */
    public function tag($abstracts, $tags);

    /**
     * Resolve all of the bindings for a given tag.
     * 创建给定 tag 下所有 $abstract 的实例
     */
    public function tagged($tag);

    /**
     * Register a binding with the container.
     * 注册一个 $abstract 到 $concrete 的绑定到容器。
     */
    public function bind($abstract, $concrete = null, $shared = false);

    /**
     * Register a binding if it hasn't already been registered.
     * 如果 $abstract 没有被注册的话，注册一个 $abstract 到 $concrete 的绑定到容器。
     */
    public function bindIf($abstract, $concrete = null, $shared = false);

    /**
     * Register a shared binding in the container.
     * 注册一个可共享的绑定到容器
     */
    public function singleton($abstract, $concrete = null);

    /**
     * "Extend" an abstract type in the container.
     * 使用 $closure 扩展容器中的 $abstract
     */
    public function extend($abstract, Closure $closure);

    /**
     * Register an existing instance as shared in the container.
     * 注册一个实例到容器中
     */
    public function instance($abstract, $instance);

    /**
     * Define a contextual binding.
     * 定义一个上下文的绑定
     */
    public function when($concrete);

    /**
     * Resolve the given type from the container.
     * 根据容器中的绑定，给出 $abstract 的实例。
     */
    public function make($abstract, array $parameters = []);

    /**
     * Call the given Closure / class@method and inject its dependencies.
     * 调用给定匿名函数或者 class@method 描述的类的方法，并且自动注入依赖参数
     */
    public function call($callback, array $parameters = [], $defaultMethod = null);

    /**
     * Determine if the given abstract type has been resolved.
     * 判断一个 $abstract 是否实例化过
     */
    public function resolved($abstract);

    /**
     * Register a new resolving callback.
     * 注册一个 $abstract 实例化的回调函数
     */
    public function resolving($abstract, Closure $callback = null);

    /**
     * Register a new after resolving callback.
     * 注册一个 $abstract 实例化之后的回调函数
     */
    public function afterResolving($abstract, Closure $callback = null);
}
