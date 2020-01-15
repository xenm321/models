import Vue from 'vue';
import Vuetify from 'vuetify';
import AppService from './services/app.js';
import moment from 'moment';
import router from './router.js';
import AppLayout from './views/Layout.vue';
import eventBus from './event_bus.js';

if(window !== undefined) {
    window.signedIn = false;

    window.flash = function(message, type = 'success') {
        eventBus.$emit('flash', { message, type });
    };
}

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('YYYY-MM-DD hh:mm')
    }
});

Vue.filter('formatMoney', function(value) {
    if (value) {
        let val = (value/1).toFixed(0).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "\xa0") + '\xa0руб.';
    }
});

Vue.use(Vuetify);

const app = new Vue({
    router,
    ...AppLayout
});

router.onReady(() => {
    app.$mount('#app');
});
