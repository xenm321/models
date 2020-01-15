<template>
    <v-container grid-list-md text-xs-center>
        <v-form ref="form" v-model="valid" lazy-validation>
            <v-text-field
                    v-model="brand.code"
                    label="Код"
                    :error-messages="errors.code"
                    :rules="rules.code"
                    required
                    @input="clearErrors('code')"
                    @blur="clearErrors('code')"
            ></v-text-field>
            <v-text-field
                    v-model="brand.title"
                    label="Название"
                    :error-messages="errors.title"
                    :rules="rules.title"
                    required
                    @input="clearErrors('title')"
                    @blur="clearErrors('title')"
            ></v-text-field>
            <v-text-field
                    v-model="brand.identifier"
                    label="Идентификатор"
                    :error-messages="errors.identifier"
                    :rules="rules.identifier"
                    required
                    @input="clearErrors('identifier')"
                    @blur="clearErrors('identifier')"
            ></v-text-field>
            <v-textarea
                    name="input-7-1"
                    v-model="brand.description"
                    label="Описание"
            ></v-textarea>

            <v-btn :disabled="!valid" @click="submit">Сохранить</v-btn>
            <v-btn :to="{name: 'brands_list'}">Назад</v-btn>
        </v-form>
    </v-container>
</template>

<script>
    import BrandService from '../../services/brand.js';
    import router from '../../router.js';

    export default {
        data () {
            return {
                valid: true,
                brand: {},
                errors: {},
                rules: {
                    code: [
                        v => !!v || 'Код обязателен'
                    ],
                    title: [
                        v => !!v || 'Название обязательно',
                    ],
                    identifier: [
                        v => !!v || 'Идентификатор обязателен',
                    ],
                }
            }
        },

        created: function() {
            const id = this.$route.params.id;
            this.getBrand(id);
        },

        methods: {
            submit () {
                if (this.$refs.form.validate()) {
                    delete this.brand.id;
                    BrandService.update(this.brand, this.$route.params.id)
                        .then(() => {
                            flash('Бренд обновлен');
                        })
                        .catch(error => {
                            if(error.errors !== undefined) {
                                this.errors = error.errors;
                            }
                            flash(error.message, 'error');
                        });
                }
            },

            getBrand (id) {
                BrandService.find(id)
                    .then((response) => {
                        this.brand = response;
                    });
            },

            clearErrors (fieldName) {
                if(this.errors[fieldName] !== undefined) {
                    this.errors[fieldName] = [];
                }
            }
        }
    }
</script>
