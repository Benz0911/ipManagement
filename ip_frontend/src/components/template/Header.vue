<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5 p-2">
    <div class="container">

      <a class="navbar-brand" href="#">IPM-Exam</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto">
          <li class="nav-item active">
            <router-link :to="{name:'ip'}">IP management</router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{name:'activity'}">Activity Logs</router-link>
          </li>
        </ul>
        <div class="flex-shrink-0 dropdown">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            <img :src="Img" alt="mdo" width="42" height="42" class="rounded-circle">
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end text-small shadow" aria-labelledby="dropdownUser2" style="">
            <li><a class="dropdown-item" href="#">{{auth.user.name}}</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" @click="logout" href="#">Sign out</a></li>
            </ul>
        </div>
      </div>
    </div>
</nav>
</template>

<script setup>
import { useAuthUserStore } from '@/stores/auth'
import { useRouter } from 'vue-router'
import Img from "@/assets/default.jpg"

const auth = useAuthUserStore()
const router = useRouter()

const logout = () => {
    auth.logout()
    
    setTimeout(function(){
        router.push({name:'login'})
    },500)
}


</script>

<style>

</style>