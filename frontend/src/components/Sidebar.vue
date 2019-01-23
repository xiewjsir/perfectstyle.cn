<template>
    <!-- 侧边内容 -->
    <div class="sidebar-content">
        <div class="layui-card">
            <div class="layui-card-header">
                <img src="../assets/img/portrait.jpg" alt=""><br />
                <span>小明</span>
            </div>
            <div class="layui-card-body">
                <ul>
                    <li class="txt">
                        <span>1000</span><br />
                        <span>文章</span>
                    </li>
                    <li class="item">
                        <span>50</span><br />
                        <span>项目</span>
                    </li>
                    <li class="visitors">
                        <span>5008</span><br />
                        <span>访问人数</span>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="layui-nav">
            <!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
            <li class="layui-nav-item  layui-this">
                <router-link to="/">文章<br/>ARTICLE</router-link>
            </li>
            <li class="layui-nav-item">
                <router-link to="/mood">微语<br/>MOOD</router-link>
            </li>
            <li class="layui-nav-item">
                <router-link to="/works">作品<br/>WORKS</router-link>
            </li>
            <li class="layui-nav-item">
                <a href="message.html">留言<br/>MESSAGE</a>
            </li>
            <li class="layui-nav-item last">
                <a href="about.html">关于<br/>ABOUT</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "Sidebar"
    }
</script>

<style scoped>

</style>