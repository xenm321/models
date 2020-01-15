import axios from 'axios';
import eventBus from './../event_bus.js';

axios.defaults.baseURL = '/api';

axios.interceptors.request.use(function (config) {
    if (typeof window === 'undefined') {
        return config;
    }

    const token = window.localStorage.getItem('token');

    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }

    return config;
});

const AppService = {
    getCurrentUser () {
        return new Promise((resolve) => {
            axios.get('/user/current')
                .then(response => {
                    resolve(response.data);
                });
        });
    },

    checkToken () {
        const token = window.localStorage.getItem('token');

        if(token && token !== '') {
            window.signedIn = true;
            eventBus.$emit('login');
        }
    },

    login (credentials) {
        return new Promise((resolve, reject) => {
            axios.post('/login_check', credentials)
                .then(response => {
                    window.signedIn = true;
                    window.localStorage.setItem('token', response.data.token);
                    eventBus.$emit('login');

                    resolve(response);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },

    logout () {
        window.localStorage.setItem('token', '');
        window.signedIn = false;
        eventBus.$emit('logout');
    }
};

export default AppService;
