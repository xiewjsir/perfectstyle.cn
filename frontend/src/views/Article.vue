<template>
  <div class="article-box">
    <Sidebar></Sidebar>
    <tags></tags>
    <!-- 主要内容 -->
    <div class="main article">
      <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
        <ul class="layui-tab-title">
          <li class="layui-this">专业文章</li>
          <li>前端开发</li>
          <li>随机散文</li>
        </ul>
        <div class="layui-tab-content"></div>
      </div>
      <div class="item">
        <img src="../assets/img/book.jpg" alt="">
        <div class="item-content">
          <h3>学好JS,走哪儿都不怕</h3>
          <span class="Subtitle">html</span><br />
          <p>对于想学习Javascript的读者来说, 很可能已经掌握了HTML和Web页面设计的基本知识,希望为页面添加一些更好的互动性,或者,目前是在使用其他语言进行编程,想了解一下JavaScript能够提供哪些更多的功能供哪些更多的功能</p>
          <router-link to="/article-detail"><button class="layui-btn">阅读全文</button></router-link>
        </div>
        <div class="date-box">
          <div class="date">
            <h4>29</h4>
            <span>2018/06</span>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="../assets/img/book.jpg" alt="">
        <div class="item-content">
          <h3>学好JS,走哪儿都不怕</h3>
          <span class="Subtitle">html</span><br />

          <p>对于想学习Javascript的读者来说, 很可能已经掌握了HTML和Web页面设计的基本知识,希望为页面添加一些更好的互动性,或者,目前是在使用其他语言进行编程,想了解一下JavaScript能够提供哪些更多的功能供哪些更多的功能</p>
          <a href="article-detail.html" onclick="javascript:window.open(this.href)"><button class="layui-btn">阅读全文</button></a>
        </div>
        <div class="date-box">
          <div class="date">
            <h4>29</h4>
            <span>2018/06</span>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="item-content">
          <h3>学好JS,走哪儿都不怕</h3>
          <span class="Subtitle">html</span><br />
          <p>对于想学习Javascript的读者来说, 很可能已经掌握了HTML和Web页面设计的基本知识,希望为页面添加一些更好的互动性,或者,目前是在使用其他语言进行编程,想了解一下JavaScript能够提供哪些更多的功能供哪些更多的功能</p>
          <a href="article-detail.html" onclick="javascript:window.open(this.href)"><button class="layui-btn">阅读全文</button></a>
        </div>
        <div class="date-box">
          <div class="date">
            <h4>29</h4>
            <span>2018/06</span>
          </div>
        </div>
      </div>
      <div id="page-box">
        <div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-1">
          <a href="javascript:;" class="layui-laypage-prev layui-disabled" data-page="0">上一页</a>
          <span class="layui-laypage-curr">
                <em class="layui-laypage-em"></em><em>1</em>
            </span>
          <a href="javascript:;" data-page="2">2</a>
          <a href="javascript:;" data-page="3">3</a>
          <a href="javascript:;" data-page="4">4</a>
          <a href="javascript:;" data-page="5">5</a>
          <span class="layui-laypage-spr">…</span>
          <a href="javascript:;" class="layui-laypage-last" title="尾页" data-page="10">10</a>
          <a href="javascript:;" class="layui-laypage-next" data-page="2">下一页</a>
        </div>
      </div>
    </div>
    <Search></Search>
  </div>
</template>

<script>
// @ is an alias to /src
import Sidebar from '@/components/Sidebar.vue'
import Tags from '@/components/Tags.vue'
import Search from '@/components/Search.vue'
import {usersInfo} from "@/api/auth"
import { mapActions } from 'vuex'

export default {
  name: 'article',
  components: {
      Sidebar,
      Tags,
      Search
  },
  data(){
    return {
      loginForm:{
        username:"admin",
        password:"123456"
      },
      tipMessage:''
    }
  },
  mounted(){
    //this.handleLogin();
    this.test();
  },
  methods:{
    test(){
      usersInfo().then(response => {
          console.log(response);
        }).catch(error => {
          console.log(error)
        })
    },
    handleLogin(){
      this.login(this.loginForm).then(()=>{
        this.tipMessage = '登录成功';

        this.$router.push({ path: "/" });
      }).catch(error=>{
        let result = error.response;
        this.tipMessage = '登录的失败';
      })
    },
    ...mapActions(['login'])
  }
}
</script>
