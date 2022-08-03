<template>

  <div class="row">
    <h1>Hello World! something</h1>
    <button class="btn btn-danger" @click="logout">Logout!</button>
  </div>

</template>

<script setup>
import axios from '@/libs/axios'
import { useAuthUserStore } from '@/stores/auth'

const auth = useAuthUserStore()

function logout() {
    auth.logout()
}

</script>

<style>

</style>