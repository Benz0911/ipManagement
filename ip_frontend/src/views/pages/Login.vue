<template>

    <div id="sign_body">
        <div class="container">

            <div class="row col-md-6 m-auto">
                <div id="sign_cont" class="card p-3">
                    <div class="card-header mb-3 border-bottom border-success">
                        <h2>IPM-EXAM</h2>
                    </div>
                    <div>
                        <h4 class="text-2xl text-center text-gray-900 font-semilight">Sign in to your account</h4>
                    </div>
                    <form @submit.prevent="onSubmit">
                        <div class="col-6 m-auto">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" v-model="form.username" class="form-control" id="username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" v-model="form.password" class="form-control" id="password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Sign In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
    import { ref, reactive } from 'vue'
    import { useRoute } from 'vue-router'
    import axios from '@/libs/axios'
    import { useDebounceFn  } from '@vueuse/core'
    import { useAuthUserStore } from '@/stores/auth'
    import { useToast } from "vue-toastification"

    const auth = useAuthUserStore()
    const route = useRoute()
    const loading = ref(false)
    const toast = useToast();

    const form = reactive({
        username: '',
        password: ''
    })

    const onLoading = useDebounceFn(() => {
        window.location.reload()
    }, 1000, { maxWait: 3000 })

    function onSubmit() {
        loading.value = true
        axios.post('/login', form)
            .then((response) => {
                auth.token = response.data.token
                auth.user = response.data.user
                localStorage.setItem('token', response.data.token)
                toast.success("Login Successful", {
                    timeout: 2000
                });
                onLoading()
                
            }).catch((error) => {
                loading.value = false
                if(error.response.data.errors.username){
                    toast.error(error.response.data.errors.username[0], {
                        timeout: 2000
                    });
                }
            })
    }

</script>