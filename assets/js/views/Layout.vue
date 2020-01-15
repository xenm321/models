<template>
    <div>
        <v-app id="inspire">

            <v-toolbar v-show="signedIn">
                <v-toolbar-items>
                    <v-btn flat to="/">Главная</v-btn>
                    <v-btn flat :to="{ name: 'types_list' }">Типы</v-btn>
                    <v-btn flat :to="{ name: 'typesPurchaseConfig_list' }">Конфиг типов</v-btn>
                    <v-btn flat :to="{ name: 'brands_list' }">Бренды</v-btn>
                    <v-btn flat :to="{ name: 'models_list' }">Модели</v-btn>
                    <v-btn flat :to="{ name: 'new_models_list' }">Новинки</v-btn>
                </v-toolbar-items>

                <v-spacer></v-spacer>

                <v-toolbar-title>{{ user.username }}</v-toolbar-title>
                <v-toolbar-items>
                    <v-btn flat @click="logout()">Выход</v-btn>
                </v-toolbar-items>
            </v-toolbar>

            <notifications></notifications>

            <router-view></router-view>
        </v-app>
    </div>
</template>


<script>
    import Notifications from './../components/Notifications.vue';
    import AppService from './../services/app.js';
    import router from './../router.js';
    import eventBus from './../event_bus.js';

    export default {
        data() {
            return {
                signedIn: false,
                user: {}
            };
        },

        created() {
            AppService.checkToken();

            if(window.signedIn === true) {
                this.login();
            } else {
                router.push('/login');
            }

            eventBus.$on('login', () => {
                this.login();
            });

            eventBus.$on('logout', () => {
                this.logout();
            });
        },

        methods: {
            logout () {
                AppService.logout();
                this.signedIn = false;
                router.push('/login');
            },

            login () {
                this.signedIn = true;

                AppService.getCurrentUser()
                    .then((user) => {
                        this.user = user;
                    });
            }
        },

        components: {
            'notifications' : Notifications
        },
    };
</script>
