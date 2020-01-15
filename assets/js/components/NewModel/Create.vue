<template>
    <v-container grid-list-md text-xs-center>
        <div>
            <v-form ref="form" v-model="valid" lazy-validation>
                <v-select
                        name="type"
                        v-model="model.type"
                        :items="selects.types"
                        item-text="title"
                        item-value="id"
                        label="Тип"
                        :error-messages="errors.type"
                        :rules="rules.type"
                        required
                        @input="clearErrors('type')"
                        @blur="clearErrors('type')"
                ></v-select>
                <v-select
                        name="brand"
                        v-model="model.brand"
                        :items="selects.brands"
                        item-text="title"
                        item-value="id"
                        label="Бренд"
                        :error-messages="errors.brand"
                        :rules="rules.brand"
                        required
                        @input="clearErrors('brand')"
                        @blur="clearErrors('brand')"
                ></v-select>

                <v-select
                        name="supplier"
                        v-model="model.supplier"
                        :items="selects.suppliers"
                        item-text="title"
                        item-value="id"
                        label="Поставщик"
                        :error-messages="errors.supplier"
                        :rules="rules.supplier"
                        required
                        @input="clearErrors('supplier')"
                        @blur="clearErrors('supplier')"
                ></v-select>
                <v-text-field
                        name="purchasePrice"
                        v-model.number="model.purchasePrice"
                        label="Закупочная цена"
                        :error-messages="errors.purchasePrice"
                        :rules="rules.purchasePrice"
                        required
                        type="number"
                        @input="clearErrors('purchasePrice')"
                        @blur="clearErrors('purchasePrice')"
                ></v-text-field>
                <v-flex xs12 class="text-xs-center text-sm-center text-md-center text-lg-center">
                    <file-input
                            accept="image/*"
                            ref="fileInput"
                            @input="getUploadedFile"
                    ></file-input>


                </v-flex>
                <v-textarea
                        name="comment"
                        v-model="model.comment"
                        label="Комментарий"
                ></v-textarea>

                <v-btn :disabled="!valid" @click="submit">Создать</v-btn>
                <v-btn :to="{name: 'brands_list'}">Назад</v-btn>
            </v-form>
        </div>
    </v-container>
</template>


<script>
    import NewModelService from '../../services/newModel.js';
    import TypeService from '../../services/type.js';
    import BrandService from '../../services/brand.js';
    import SupplierService from '../../services/supplier.js';
    import FileInput from '../FileInput.vue'
    import router from '../../router.js';

    export default {
        components: {FileInput},
        data () {
            return {
                valid: true,
                errors: {},
                model: {
                    images: [],
                    purchasePrices: [
                        {
                            supplier: null,
                            price: "",
                        }
                    ],
                },
                image: '',
                rules: {
                    type: [
                        v => !!v || 'Укажите тип модели'
                    ],
                    brand: [
                        v => !!v || 'Укажите бренд',
                    ],
                    purchasePrice: [
                        v => !!v || 'Укажите закупочную цену модели',
                    ],
                },
                selects: {
                    brands: [],
                    types: [],
                    suppliers: [],
                },
            }
        },

        created: function() {
            this.initSelects();
        },

        methods: {
            submit () {
                if (this.$refs.form.validate()) {

                    NewModelService.create(this.model, this.image)
                        .then(response => {
                            flash('Новинка создана');
                            router.push(`/new-model`);
                        })
                        .catch(error => {
                            if(error.errors !== undefined) {
                                this.errors = error.errors;
                            }

                            if(error.message !== undefined) {
                                flash(error.message, 'error');
                            }
                        });
                }
            },

            clearErrors (fieldName) {
                if(this.errors[fieldName] !== undefined) {
                    this.errors[fieldName] = [];
                }
            },

            initSelects() {
                this.getTypes();
                this.getBrands();
                this.getSuppliers();
            },

            getTypes() {
                TypeService.list()
                    .then(data => {
                        this.selects.types = data.map((currentValue) => {
                            return {id: ''+currentValue.id, title: currentValue.title};
                        });
                    });
            },

            getBrands() {
                BrandService.list()
                    .then(data => {
                        this.selects.brands = data.map((currentValue) => {
                            return {id: ''+currentValue.id, title: currentValue.title};
                        });
                    });
            },

            getSuppliers() {
                SupplierService.list()
                    .then(data => {
                        this.selects.suppliers = data.map((currentValue) => {
                            return {id: ''+currentValue.id, title: currentValue.title};
                        });
                    });
            },

            getUploadedFile(e) {
                this.image = e
            },
        }
    }
</script>
