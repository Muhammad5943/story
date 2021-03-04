import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import store from '../store'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/login',
    name: 'auth.login',
    // route level code-splitting
    // this generates a separate chunk (Login.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "Login" */ '../views/auth/Login.vue')
  },
  {
    path: '/posts/new',
    name: 'posts.new',
    component:  () => import(/* webpackChunkName: "New Post" */ '../views/posts/New.vue'),
    meta: {
      auth: true
    }
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  linkActiveClass: 'active',
  routes
})

router.beforeEach((to, from, next) => {
  if (to.meta.auth == true && !store.getters['auth/check']) next('/login')
  else next() 

  if (to.name == 'auth.login' && store.getters['auth/check']) next({ name: 'home' })
  else next()
})

export default router
