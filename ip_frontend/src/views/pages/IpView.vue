<template>

  <div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add IP</h3>
            </div>
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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">IP LIST</h3>
            </div>
            <div class="car-body">
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th>IP</th>
                            <th>Label</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="list in ips">
                            <tr>
                                <td>{{list.ip}}</td>
                                <td>{{list.label}}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-toggle="tooltip" title="View Logs" @click="viewLogs(list)" data-bs-toggle="modal" data-bs-target="#viewLogs">view log</button>
                                    <button class="btn btn-warning btn-sm" data-toggle="tooltip" title="Update Label" @click="updateData(list)" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <i class="fa fa-pencil"></i>Update</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
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
            <div class="mb-3">
                <label for="label_update" class="form-label">Label:</label>
                <input type="text" v-model="form_update.label" class="form-control" id="label_update">
            </div>
        </div>
        <div class="modal-footer">
            <button ref="close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" @click="update" class="btn btn-primary">Update</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="viewLogs" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewLogsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="viewLogsLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-start">
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>Log Type</th>
                        <th>Previous Label</th>
                        <th>New Label</th>
                        <th>Logged by</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="l in logs">
                        <tr>
                            <td>{{l.type}}</td>
                            <td>{{l.prev_data?l.prev_data.label:l.prev_data}}</td>
                            <td>{{l.new_data?l.new_data.label:l.new_data}}</td>
                            <td></td>
                        </tr>
                    </template>
                </tbody>
            </table>
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

const update_id = ref(null)

const ips = ref([])

const logs = ref([])

const close = ref(null);

const getIps = () => {
    axios.get('api/ip/get-ips').then(res => {
        console.log(res)
        ips.value = res.data.data
    })
}

const viewLogs = (data) => {
    logs.value = data.logs
}

const updateData = (data) => {
    update_id.value = data.id
    form_update.label = data.label
    // console.log(close.value.click);
}

const save = () => {
    axios.post('api/ip/create/store', form)
        .then((response) => {
            clearForm()
            getIps()
        }).catch((error) => {
            // loading.value = false
        })
}

const update = () => {
    axios.patch(`api/ip/update-ip/${update_id.value}`, form_update)
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

const clearForm = () => {
    form.ip = ''
    form.label = ''
}

onMounted(()=>{
    getIps()
})

</script>

<style>

</style>