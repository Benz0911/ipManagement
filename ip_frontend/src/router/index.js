import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AboutView from '../views/AboutView.vue'
import Login from '@/views/pages/Login.vue'
import IpView from '@/views/pages/IpView.vue'
import {useAuthUserStore} from '@/stores/auth'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    meta: {
      title: 'Home',
      requiresAuth: true,
    }
  },
  {
    path: '/about',
    name: 'about',
    component: AboutView,
    meta: {
      title: 'About',
      requiresAuth: true,
    }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
        title: 'Login',
        requiresAuth: false,
    }
  },
  {
    path: '/ip',
    name: 'ip',
    component: IpView,
    meta: {
      title: 'IpView',
      requiresAuth: true,
    }
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {

  const auth = useAuthUserStore()
  auth.$patch(async (state) => {
      if (localStorage.getItem('token')) {
          auth.token = localStorage.getItem('token')
          const response = await auth.attempt()
      }

      if(to.meta.requiresAuth) {
        if(auth.authenticated){
          next() 
        }else{
          if(to.name === 'notfound'){
            next()
          }else{
            next({ name: 'login' })
          }
        }
      }
      else {
        if(auth.authenticated){
          if(to.name === 'notfound'){
            next()
          }else{
            next({ name: 'dashboard' })
          }
        }else{
          next() 
        }
      }

  })
  document.title = to.meta.title
});

export default router
