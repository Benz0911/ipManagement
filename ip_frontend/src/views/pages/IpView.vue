<template>

  <div class="row">
    <div class="col-md-3">
        <div class="card" style="width: 18rem;">
            <div class="card-body text-start">
                <form @submit.prevent="save">
                    <div class="mb-3">
                        <label for="ipAddress" class="form-label">IP address:</label>
                        <input type="text" v-model="form.ip" class="form-control" id="ipAddress">
                    </div>
                    <div class="mb-3">
                        <label for="label" class="form-label">Label:</label>
                        <input type="text" v-model="form.label" class="form-control" id="label">
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
        
    </div>
    <div class="col-md-9">
        <button @click="logout">logout</button>
    </div>
  </div>

</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import axios from '@/libs/axios'
import { useAuthUserStore } from '@/stores/auth'
import { useRouter } from 'vue-router'

const auth = useAuthUserStore()
const router = useRouter()

const form = reactive({
    'ip':'',
    'label':'',
})


function save(){

    axios.post('api/ip/create/store', form)
        .then((response) => {
            // auth.token = response.data.token
            // auth.user = response.data.user
            // localStorage.setItem('token', response.data.token)
            // onLoading()
            
        }).catch((error) => {
            // loading.value = false
        })
    
}


function logout() {
    auth.logout()
    
    setTimeout(function(){
        router.push({name:'login'})
    },500)

}

</script>

<style>

</style>