<template>
    <div class="works-box">
        <Sidebar></Sidebar>
        <div class="main works">
            <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
                <ul class="layui-tab-title">
                    <li class="layui-this">前端</li>
                    <li>后台</li>
                    <li>设计</li>
                </ul>
                <div class="layui-tab-content"></div>
            </div>
            <div class="item">
                <div class="layui-fluid">
                    <div class="layui-row layui-col-space15">
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
                            <div class="img-text">
                                <a href="javascript:;">
                                    <img src="../assets/img/img1.jpg" alt="">
                                    <p>后台管理网站项目</p>
                                </a>
                            </div>
                        </div>
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
                            <div class="img-text">
                                <a href="javascript:;">
                                    <img src="../assets/img/img2.jpg" alt="">
                                    <p>后台管理网站项目</p>
                                </a>
                            </div>
                        </div>
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
                            <div class="img-text">
                                <a href="javascript:;">
                                    <img src="../assets/img/img3.jpg" alt="">
                                    <p>后台管理网站项目</p>
                                </a>
                            </div>
                        </div>
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
                            <div class="img-text">
                                <a href="javascript:;">
                                    <img src="../assets/img/img4.jpg" alt="">
                                    <p>后台管理网站项目</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="layui-row layui-col-space15">
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
                            <div class="img-text">
                                <a href="javascript:;">
                                    <img src="../assets/img/img1.jpg" alt="">
                                    <p>后台管理网站项目</p>
                                </a>
                            </div>
                        </div>
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
                            <div class="img-text">
                                <a href="javascript:;">
                                    <img src="../assets/img/img2.jpg" alt="">
                                    <p>后台管理网站项目</p>
                                </a>
                            </div>
                        </div>
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
                            <div class="img-text">
                                <a href="javascript:;">
                                    <img src="../assets/img/img3.jpg" alt="">
                                    <p>后台管理网站项目</p>
                                </a>
                            </div>
                        </div>
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
                            <div class="img-text">
                                <a href="javascript:;">
                                    <img src="../assets/img/img4.jpg" alt="">
                                    <p>后台管理网站项目</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="layui-row layui-col-space15">
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
                            <div class="img-text">
                                <a href="javascript:;">
                                    <img src="../assets/img/img1.jpg" alt="">
                                    <p>后台管理网站项目</p>
                                </a>
                            </div>
                        </div>
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
                            <div class="img-text">
                                <a href="javascript:;">
                                    <img src="../assets/img/img2.jpg" alt="">
                                    <p>后台管理网站项目</p>
                                </a>
                            </div>
                        </div>
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
                            <div class="img-text">
                                <a href="javascript:;">
                                    <img src="../assets/img/img3.jpg" alt="">
                                    <p>后台管理网站项目</p>
                                </a>
                            </div>
                        </div>
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
                            <div class="img-text">
                                <a href="javascript:;">
                                    <img src="../assets/img/img4.jpg" alt="">
                                    <p>后台管理网站项目</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="demo1"></div>
            </div>

        </div>
        <Search></Search>
    </div>
</template>

<script>
    import Sidebar from '@/components/Sidebar.vue'
    import Search from '@/components/Search.vue'
    export default {
        name: "Works",
        components: {
            Sidebar,
            Search
        }
    }
</script>

<style scoped>

</style>