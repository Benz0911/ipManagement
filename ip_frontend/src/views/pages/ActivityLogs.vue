<template>

  <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">ACTIVITY LOG LIST / AUDIT TRAILS</h3>
            </div>
            <div class="card-body">
                <ul class="list-group text-start">
                    <template v-for="log in logs">
                        <li class="list-group-item">
                            <span v-if="log.type == 'logged_in'">
                                <label class="fw-bold fst-italic">{{log.name}}</label> <span class="badge bg-success">Logged</span> in at {{log.audit_date}}
                            </span>

                            <span v-else-if="log.type == 'Add'">
                                <label class="fw-bold fst-italic">{{log.name}}</label> <span class="badge bg-primary">Added</span> <span class="text-decoration-underline">{{log.new_data.ip}}</span> labeled: <span class="text-decoration-underline">({{log.new_data.label}})</span> at {{log.audit_date}}
                            </span>

                            <span v-else-if="log.type == 'Update'">
                                <label class="fw-bold fst-italic">{{log.name}}</label> <span class="badge bg-warning">Update</span> <span class="text-decoration-underline">{{log.new_data.ip}}</span>'s label to:<span class="text-decoration-underline">{{log.new_data.label}}</span> at {{log.audit_date}}
                            </span>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </div>
  </div>

</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from '@/libs/axios'

const logs = ref([])

const getLogs = () => {
    axios.get('api/ip/get-logs').then(res => {
        logs.value = res.data.data
    })
}

onMounted(()=>{
    getLogs()
})

</script>