import Vue from 'vue'
import Router from 'vue-router'
import Article from './views/Article.vue'
import ArticleDetail from './views/ArticleDetail.vue'
import Mood from './views/Mood.vue'
import Works from './views/Works.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
        path: '/',
        name: 'article',
        component: Article
    },
      {
          path: '/article-detail',
          name: 'article-detail',
          component: ArticleDetail
      },
      {
          path: '/mood',
          name: 'mood',
          component: Mood
      },
      {
          path: '/works',
          name: 'works',
          component: Works
      },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import(/* webpackChunkName: "about" */ './views/About.vue')
    }
  ]
})
