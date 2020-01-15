<template>
    <v-layout align-center justify-center row fill-height>
        <v-form ref="form" v-model="valid" lazy-validation>
            <v-text-field
                    v-model="username"
                    :rules="rules.username"
                    label="Логин"
                    required
            ></v-text-field>
            <v-text-field
                    v-model="password"
                    :rules="rules.password"
                    label="Пароль"
                    required
            ></v-text-field>

            <v-btn :disabled="!valid" @click="login">Вход</v-btn>
        </v-form>
    </v-layout>
</template>

<script>
    import AppService from './../../services/app.js';
    import router from '../../router.js';

    export default {
        data () {
            return {
                valid: false,
                username: '',
                password: '',
                rules: {
                    username: [
                        v => !!v || 'Логин обязателен'
                    ],
                    password: [
                        v => !!v || 'Пароль обязателен',
                    ],
                }
            };
        },

        created() {
            if(window.signedIn) {
                router.push('/');
            }
        },

        methods: {
            login () {
                if (this.$refs.form.validate()) {
                    AppService.login({'username': this.username, 'password': this.password})
                        .then(() => {
                            router.push('/');
                        })
                        .catch(error => {
                            flash(error.message, 'error');
                        });
                }
            }
        }
    };
</script>
