<template>
    <v-container grid-list-md text-xs-center>
        <v-form ref="form" v-model="valid" lazy-validation>

            <v-layout row wrap>
                <v-flex xs12 sm6 md10>
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

                    <div v-for="purchasePrice in model.purchasePrices" :key="purchasePrice.id">
                        <v-layout row wrap>
                            <v-flex xs12 sm6 md6>
                                <v-select
                                        name="supplier"
                                        v-model="purchasePrice.supplier"
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
                            </v-flex>

                            <v-flex xs12 sm6 md6>
                                <v-text-field
                                        name="purchasePrice"
                                        v-model.number="purchasePrice.price"
                                        label="Закупочная цена"
                                        :error-messages="errors.purchasePrice"
                                        :rules="rules.purchasePrice"
                                        required
                                        type="number"
                                        @input="clearErrors('purchasePrice')"
                                        @blur="clearErrors('purchasePrice')"
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                    </div>
                </v-flex>

                <v-flex xs12 sm6 md2>
                    <div v-for="photo in model.photos" :key="photo.id">
                        <img :src="photo.path" width="150">
                    </div>
                </v-flex>
            </v-layout>

            <v-text-field
                    name="title"
                    v-model="model.title"
                    label="Название"
                    :error-messages="errors.title"
            ></v-text-field>

            <v-text-field
                    name="seoTitle"
                    v-model="model.seoTitle"
                    label="SEO Название"
                    :error-messages="errors.seoTitle"
            ></v-text-field>

            <v-textarea
                    name="description"
                    v-model="model.description"
                    label="Описание"
                    :error-messages="errors.description"
            ></v-textarea>

            <fieldset>
                <legend>Модели магазинов</legend>

                <v-layout align-center justify-center row fill-height>

                    <v-flex xs12 md3>Поля/Магазины</v-flex>

                    <v-flex xs12 md3 v-for="shop in this.shops" :key="shop.id">
                        <span v-text="shop.code"></span>
                    </v-flex>

                </v-layout>

                <hr>

                <v-layout align-center justify-right row fill-height>
                    <v-flex xs12 md3>Артикул</v-flex>

                    <v-flex xs12 md3 v-for="shop in this.shops" :key="shop.id">
                        <span v-if="getModelExt(shop.id)">
                            <v-text-field
                                    name="articul"
                                    v-model="getModelExt(shop.id).articul"
                                    label="Артикул"
                            ></v-text-field>
                        </span>
                        <span v-else >
                            <v-btn @click="createModelExt(shop.id)">Создать</v-btn>
                        </span>
                    </v-flex>
                </v-layout>

                <v-layout align-center justify-right row fill-height>
                    <v-flex xs12 md3>Название</v-flex>

                    <v-flex xs12 md3 v-for="shop in this.shops" :key="shop.id">
                        <span v-if="getModelExt(shop.id)">
                            <v-text-field
                                    name="title"
                                    v-model="getModelExt(shop.id).title"
                                    label="Название"
                            ></v-text-field>
                        </span>
                    </v-flex>
                </v-layout>

                <v-layout align-center justify-right row fill-height>
                    <v-flex xs12 md3>SEO название</v-flex>

                    <v-flex xs12 md3 v-for="shop in this.shops" :key="shop.id">
                        <span v-if="getModelExt(shop.id)">
                            <v-text-field
                                    name="seoTitle"
                                    v-model="getModelExt(shop.id).seoTitle"
                                    label="Seo название"
                            ></v-text-field>
                        </span>
                    </v-flex>
                </v-layout>

                <v-layout align-center justify-right row fill-height>
                    <v-flex xs12 md3>Описание</v-flex>

                    <v-flex xs12 md3 v-for="shop in this.shops" :key="shop.id">
                        <span v-if="getModelExt(shop.id)">
                            <v-textarea
                                    name="description"
                                    v-model="getModelExt(shop.id).description"
                                    label="Описание"
                            ></v-textarea>
                        </span>
                    </v-flex>
                </v-layout>

                <v-layout align-center justify-right row fill-height>
                    <v-flex xs12 md3>Цена</v-flex>

                    <v-flex xs12 md3 v-for="shop in this.shops" :key="shop.id">
                        <span v-if="getModelExt(shop.id)">
                            <v-text-field
                                    name="price"
                                    v-model="getModelExt(shop.id).price"
                                    label="Цена"
                            ></v-text-field>
                        </span>
                    </v-flex>
                </v-layout>

            </fieldset>

            <v-btn :disabled="!valid" @click="submit">Сохранить</v-btn>
            <v-btn :to="{name: 'new_models_list'}">Назад</v-btn>
        </v-form>
    </v-container>
</template>

<script>
    import TypeService from '../../services/type.js';
    import BrandService from '../../services/brand.js';
    import ShopService from '../../services/shop.js';
    import SupplierService from '../../services/supplier.js';
    import NewModelService from '../../services/newModel.js';

    export default {
        data () {
            return {
                valid: true,
                errors: {},
                model: {},
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
                shops: []
            }
        },

        created: function() {
            const id = this.$route.params.id;
            this.initSelects();
            this.getModel(id);
            this.getShops();
        },

        methods: {
            submit () {
                if (this.$refs.form.validate()) {
                    NewModelService.update(this.model)
                        .then(response => {
                            flash('Модель обновлена');
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

            getModelExt(shopId) {
                let result = null;
                if(Array.isArray(this.model.modelsExt) && this.model.modelsExt.length > 0) {
                    for (const item in this.model.modelsExt) {
                        if(this.model.modelsExt[item].shop.id === shopId) {
                            return this.model.modelsExt[item];
                        }
                    }
                }

                return result;
            },

            getModel (id) {
                NewModelService.find(id)
                    .then((response) => {
                        this.model = response;
                    });
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

            getShops() {
                ShopService.list()
                    .then(data => {
                        this.shops = data;
                    });
            },

            getTypes() {
                TypeService.list()
                    .then(data => {
                        this.selects.types = data.map((currentValue) => {
                            return {id: currentValue.id, title: currentValue.title};
                        });
                    });
            },

            getBrands() {
                BrandService.list()
                    .then(data => {
                        this.selects.brands = data.map((currentValue) => {
                            return {id: currentValue.id, title: currentValue.title};
                        });
                    });
            },

            getSuppliers() {
                SupplierService.list()
                    .then(data => {
                        this.selects.suppliers = data.map((currentValue) => {
                            return {id: currentValue.id, title: currentValue.title};
                        });
                    });
            },

            createModelExt(shopId) {
                this.model.modelsExt.push({
                    articul: '',
                    description: '',
                    fullPrice: 0,
                    photos: [],
                    price: 0,
                    seoTitle: '',
                    shop: {
                        id: shopId
                    },
                    title: '',
                });
            },
        },
    };
</script>
