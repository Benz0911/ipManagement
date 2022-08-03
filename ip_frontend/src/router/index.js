import { createRouter, createWebHistory } from 'vue-router'
import Login from '@/views/pages/Login.vue'
import IpView from '@/views/pages/IpView.vue'
import ActivityLogs from '@/views/pages/ActivityLogs.vue'
import NotFound from '@/views/pages/NotFound.vue'
import {useAuthUserStore} from '@/stores/auth'

const routes = [
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
    path: '/',
    name: 'ip',
    component: IpView,
    meta: {
      title: 'IpView',
      requiresAuth: true,
    }
  },
  {
    path: '/activity-logs',
    name: 'activity',
    component: ActivityLogs,
    meta: {
      title: 'ActivityLogs',
      requiresAuth: true,
    }
  },
  {
    path: '/:pathMatch(.*)*',
    name: 'notfound',
    component: NotFound,
    meta: {
        title: 'Not Found',
        requiresAuth: false,
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
            next({ name: 'ip' })
          }
        }else{
          next() 
        }
      }

  })
  document.title = to.meta.title
});

export default router
