<template>
  <Header v-if="user.authenticated"></Header>
  <main class="container">
    <router-view/>
  </main>


  <!-- <nav>
    <router-link :to="{name:'home'}">Home</router-link> |
    <router-link :to="{name:'about'}">About</router-link> |
    <router-link :to="{name:'ip'}">Ip Management</router-link>
  </nav> -->
  <!-- <router-view/> -->
</template>

<script setup>
  import Header from '@/components/template/Header.vue'
  import { useAuthUserStore } from '@/stores/auth'

  const user = useAuthUserStore()
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>
