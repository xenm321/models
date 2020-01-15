<template>
    <div>
        <v-alert :value="show" :type="type" dismissible>{{ body }}</v-alert>
    </div>
</template>

<script>
    import eventBus from './../event_bus.js';

    export default{
        data() {
            return {
                body: this.message,
                type: 'success',
                show: false
            }
        },

        created() {
            if(this.message) {
                this.flash();
            }

            eventBus.$on('flash', data => {
                this.flash(data);
            });
        },

        methods: {
            flash(data) {
                if(data) {
                    this.body = data.message;
                    this.type = data.type;
                }

                this.show = true;

                if(this.type === 'success') {
                    this.hide();
                }
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
    }
</script>

<style>
    .v-alert {
        position: fixed;
        right: 1%;
        top: 7%;
        width: 30%;
        z-index: 999;
    }
</style>
