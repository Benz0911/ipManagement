import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import { useAuthUserStore } from '@/stores/auth'
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"
import '../index.css'
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

const pinia = createPinia()
const app = createApp(App)

app.use(Toast, {});
app.use(pinia)
app.use(router)
app.mount('#app')

