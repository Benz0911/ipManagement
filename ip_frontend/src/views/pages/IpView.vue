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
        <h2>IP List</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td>IP</td>
                    <td>Label</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <template v-for="list in ips">
                    <tr>
                        <td>{{list.ip}}</td>
                        <td>{{list.label}}</td>
                        <td>
                            <button class="btn btn-sm btn-primary">view log</button>
                            <button class="btn btn-sm btn-warning" @click="updateData(list)" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Update</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>


        <button @click="logout">logout</button>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-start">
            <form @submit.prevent="update">
                <div class="mb-3">
                    <label for="label_update" class="form-label">Label:</label>
                    <input type="text" v-model="form_update.label" class="form-control" id="label_update">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Update</button>
        </div>
        </div>
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

const form_update = reactive({
    'label':'',
})

const ips = ref([])

const getIps = () => {
    axios.get('api/ip/get-ips').then(res => {
        console.log(res)
        ips.value = res.data.data
    })
}

const updateData = (data) => {
    form_update.label = data.label
}

const save = () => {
    axios.post('api/ip/create/store', form)
        .then((response) => {
            getIps()
        }).catch((error) => {
            // loading.value = false
        })
}


const logout = () => {
    auth.logout()
    
    setTimeout(function(){
        router.push({name:'login'})
    },500)
}


onMounted(()=>{
    getIps()
})

</script>

<style>

</style>