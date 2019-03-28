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
            <li  v-for="item of columns" :key="item.id" class="layui-nav-item  layui-this">
                <router-link :to="{path:'/'+item.slug}">{{item.name}}<br/>{{item.slug}}</router-link>
            </li>
        </ul>
    </div>
</template>

<script>
    import {getColumns} from "../api/base";

    export default {
        name: "Sidebar",
        data(){
            return {
                columns:[]
            }
        },
        mounted(){
            console.log(process.env.VUE_APP_BASE_API)
            this.getColumns(0)
        },
        methods:{
            getColumns:function(parentId){
                getColumns(parentId).then(reponse=>{
                    console.log(reponse)
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
</script>

<style scoped>

</style>