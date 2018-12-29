<?php

//每隔2000ms触发一次
swoole_timer_tick(10, function ($timer_id) {
    echo "tick-10ms\n";
});

//3000ms后执行此函数
swoole_timer_after(3000, function () {
    echo "after 3000ms.\n";
});