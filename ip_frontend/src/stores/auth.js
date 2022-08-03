import { defineStore } from 'pinia'
import axios from '@/libs/axios.js'

export const useAuthUserStore = defineStore({
    id: 'auth',
    state: () => ({
        token: null,
        user: null,
        role: null,
    }),
    getters: {
        authenticated: (state) =>  state.token && state.user ? true : false
    },
    actions: {

        async attempt(data){
            try {
                axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
                let response = await axios.get('api/user/auth')
                this.user = response.data
                this.role = response.data.role
            } catch (error) {
                this.token = null
                this.user = null
                axios.defaults.headers.common['Authorization'] = null
                localStorage.removeItem('token')
            }
        },

        async logout() {
            axios.post('/logout')
                .then((e) => 
                    axios.defaults.headers.common['Authorization'] = null,
                    localStorage.removeItem('token'),
                    this.token = null,
                    this.user = null,
                )
                .catch(error => { 
                    
                });
        }
    }
})
