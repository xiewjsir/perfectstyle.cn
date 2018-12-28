<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('test:redis', function () {
    $this->alert(Redis::getRange('text-a', 1, 2));

    /**
     * string
     * set get
     * incr
     * incrBy
     * incrByFloat
     * decr
     * decrBy,
     * ecrByFloat
     * mset
     * mget
     * del
     * setBit
     * getBit
     * bitPos
     */
    $friendsKey = 'user:1:friends';
    Redis::del($friendsKey);
    Redis::set($friendsKey, 1);
    $this->line(Redis::get($friendsKey));

    /**
     * hash 散列（二维列表）
     *
     * hset
     * hget
     * hsetnx
     * hmset
     * hmget
     * hgetall
     * hexsits
     * hdel
     * hkeys
     * hvals
     */
    $articleKey = 'user:1:article.learn';
    //Redis::hDel($articleKey,'update_at');
    Redis::hSet($articleKey, 'title', '一叶知秋');
    Redis::hSet($articleKey, 'content', '这不只是一片叶子');
    Redis::hSet($articleKey, 'created_at', time());
    Redis::hMSet($articleKey, ['user_id' => 1, 'update_at' => time()]);
    print_r(Redis::hGetAll($articleKey));
    print_r(Redis::hMGet($articleKey, ['title', 'content']));


    /**
     * 列表
     * lpush
     * rpush
     * lpop 取出并删除
     * rpop
     * llen
     * lrange
     * lrem
     * lindex
     * lset
     * ltrim
     * linsert
     * rpoplpush  将元素从一个列表转移到另一个列表
     */
    $idKey = "user:1:article.ids";
    //Redis::lRem($idKey,'a',2);
    Redis::lPush($idKey, 'a', 'b');
    Redis::lPush($idKey, 'c');
    Redis::rPush($idKey, 'd');
    $this->line(Redis::lLen($idKey));
    $this->line(Redis::lRange($idKey, 0, -1));

    /**
     * set 集合
     * sAdd
     * sRem
     * sMember
     * sDiff
     * sInter
     * sUnion
     * sCard
     * sRandMember
     * spop
     */
    $setKey = "user:1:posts.tags";
    Redis::sAdd($setKey, 'a', 'b', 'c');
    Redis::sRem($setKey, 'b', 'c');
    $this->line(Redis::sMembers($setKey));

    /**
     * 有序集合
     *zadd
     *zscore
     */
    $sortSetKey = "user:1:posts.comments";
    Redis::zAdd($sortSetKey, 89, 'dadi', 86, 'liyi');
    $this->line(Redis::zScore($sortSetKey, 'dadi'));

    /**
     * 事务
     * multi
     * exce
     */
});
