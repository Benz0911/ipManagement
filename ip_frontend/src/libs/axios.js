import Axios from 'axios'

const axios = Axios.create({
    baseURL: process.env.VUE_APP_BACKEND_URL,
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',

    },
})

axios.interceptors.request.use(config => { // Called on request
    return config
}, error => {
    return Promise.reject(error);
});

axios.interceptors.response.use(response => { // Called on response
    return response
}, error => {
    return Promise.reject(error);
});


export default axios
