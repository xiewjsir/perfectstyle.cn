<template>
    <div class="mood-box">
        <Sidebar></Sidebar>
        <div class="main mood">
            <div class="item">
                <div class="item-content">
                    <p class="time"><span><i class="layui-icon layui-icon-date"></i>12:25</span><strong>2018/06/08</strong></p>
                    <p class="brief">八一建军节到了,祝所有的军人节快乐！！八一建军节到了,祝所有的军人节日快乐！！八一建军节到了,祝所有的军人节日快乐</p>
                    <img src="../assets/img/img5.jpg" alt="">
                    <p class="praise"><span><i class="layui-icon layui-icon-praise"></i>1200</span><a href="mood-detail.html"><span><i class="layui-icon layui-icon-dialogue"></i>1200</span></a></p>
                </div>
            </div>
            <div class="item">
                <div class="item-content">
                    <p class="time"><span><i class="layui-icon layui-icon-date"></i>12:25</span><strong>2018/06/08</strong></p>
                    <p class="brief">推荐一波高评分的英剧，可以承包你所有的无聊时光。《扯蛋英国史》9.0分 （喜剧）教科书般一本正经地胡说八道，有太多能戳到笑点的地方，也能让人忍不住去想了解英国史</p>
                    <p class="praise"><span><i class="layui-icon layui-icon-praise"></i>1200</span><a href="mood-detail.html"><span><i class="layui-icon layui-icon-dialogue"></i>1200</span></a></p>
                </div>
            </div>
            <div id="demo1"></div>
        </div>
        <Search></Search>
    </div>
</template>

<script>
    import Sidebar from '@/components/Sidebar.vue'
    import Search from '@/components/Search.vue'
    export default {
        name: "Mood",
        components: {
            Sidebar,
            Search
        }
    }
</script>

<style scoped>

</style>