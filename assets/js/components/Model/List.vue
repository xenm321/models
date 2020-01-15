<template>
    <div>
        <v-layout row wrap>
            <v-flex xs12 sm6 md10>

                <v-form>
                    <v-container>
                        <v-layout row wrap>

                            <v-flex xs12 sm6 md8>
                                <v-text-field
                                        v-model="filter.search"
                                        label="Поиск"
                                        solo
                                        clearable
                                ></v-text-field>
                            </v-flex>

                            <v-flex xs12 sm6 md4>
                                <v-text-field
                                        v-model="filter.articul"
                                        label="Артикул"
                                        solo
                                        clearable
                                ></v-text-field>
                            </v-flex>

                        </v-layout>

                        <v-layout row wrap>
                            <v-flex xs12 sm6 md4>
                                <v-select
                                        v-model="filter.brand"
                                        :items="filterData.brands"
                                        item-text="title"
                                        item-value="id"
                                        label="Бренд"
                                        multiple
                                        clearable
                                ></v-select>
                            </v-flex>

                            <v-flex xs12 sm6 md4>
                                <v-select
                                        v-model="filter.type"
                                        :items="filterData.types"
                                        item-text="title"
                                        item-value="id"
                                        label="Тип"
                                        multiple
                                        clearable
                                ></v-select>
                            </v-flex>

                            <v-flex xs12 sm6 md4>
                                <v-select
                                        v-model="filter.shop"
                                        :items="filterData.shops"
                                        item-text="title"
                                        item-value="id"
                                        label="Магазин"
                                        multiple
                                        clearable
                                ></v-select>
                            </v-flex>
                        </v-layout>

                    </v-container>
                </v-form>

            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-container>
                    <v-layout row wrap>
                        <v-btn fab dark large color="success" @click.prevent="getModelsExt()">
                            <v-icon dark>search</v-icon>
                        </v-btn>
                    </v-layout>
                </v-container>
            </v-flex>

        </v-layout>

        <v-data-table
                :headers="headers"
                :items="models"
                :pagination.sync="pagination"
                :total-items="totalModels"
                :loading="loading"
                :rows-per-page-items="[50]"
                class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td class="text-xs-left">{{ props.item.articul }}</td>
                <td class="text-xs-left">{{ props.item.shop.code }}</td>
                <td class="text-xs-left">{{ props.item.price }}</td>
                <td class="text-xs-left">{{ props.item.fullPrice }}</td>
                <td class="text-xs-left">{{ props.item.model.type.title }}</td>
                <td class="text-xs-left">{{ props.item.model.brand.title }}</td>
                <td class="text-xs-left">{{ props.item.title }}</td>
                <td class="text-xs-left">{{ props.item.seoTitle }}</td>
                <td class="text-xs-left">{{ props.item.model.purchasePriceRur | formatMoney }}</td>
                <td class="text-xs-left">{{ props.item.model.originalPriceRur | formatMoney }}</td>
                <td class="text-xs-left">{{ props.item.created | formatDate }}</td>
                <td class="text-xs-left">{{ props.item.updated | formatDate }}</td>
                <td class="text-xs-right">
                    <v-btn flat icon color="green" :to="{ name: 'models_list' }">
                        <v-icon>edit</v-icon>
                    </v-btn>

                    <v-btn flat icon color="red">
                        <v-icon>remove</v-icon>
                    </v-btn>
                </td>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    import ModelService from '../../services/model.js';
    import BrandService from '../../services/brand.js';
    import TypeService from '../../services/type.js';
    import ShopService from '../../services/shop.js';

    export default {
        data () {
            return {
                totalModels: 0,
                models: [],
                loading: true,
                pagination: {},
                headers: [
                    { text: 'Артикул', value: 'articul' },
                    { text: 'Магазин', value: 'shop' },
                    { text: 'Цена', value: 'price' },
                    { text: 'Полная цена', value: 'fullPrice' },
                    { text: 'Тип', value: 'type' },
                    { text: 'Бренд', value: 'brand' },
                    { text: 'Название', value: 'title', width: 10 },
                    { text: 'Название для SEO', value: 'seoTitle', width: 10 },
                    { text: 'Закупочная', value: 'purchasePriceRur' },
                    { text: 'Оригинала', value: 'originalPriceRur' },
                    { text: 'Создан', value: 'created', width: 150 },
                    { text: 'Обновлён', value: 'updates', width: 150 },
                    { text: 'Действия', sortable: false },
                ],
                filter: {},
                filterData: {
                    brands: [],
                    types: [],
                    shops: [],
                }
            }
        },

        watch: {
            pagination: {
                handler () {
                    this.getModelsExt();
                },
                deep: true
            }
        },

        created: function() {
            this.initFilterData();

            if(this.$route.query !== undefined) {
                this.filter = Object.assign({}, this.$route.query);
            }
        },

        methods: {
            getModelsExt() {
                this.loading = true;
                ModelService.fetchAll(this.pagination, this.filter)
                    .then(data => {
                        this.loading = false;
                        this.models = data.items;
                        this.totalModels = data.total;
                        this.$router.replace({ name: 'models_list', query: this.filter });
                    });
            },

            initFilterData() {
                this.getBrands();
                this.getTypes();
                this.getShops();
            },

            getBrands() {
                BrandService.list()
                    .then(data => {
                        this.filterData.brands = data.map((currentValue) => {
                            return {id: ''+currentValue.id, title: currentValue.title};
                        });
                    });
            },

            getTypes() {
                TypeService.list()
                    .then(data => {
                        this.filterData.types = data.map((currentValue) => {
                            return {id: ''+currentValue.id, title: currentValue.title};
                        });
                    });
            },

            getShops() {
                ShopService.list()
                    .then(data => {
                        this.filterData.shops = data.map((currentValue) => {
                            return {id: ''+currentValue.id, title: currentValue.title};
                        });
                    });
            },
        }
    };
</script>
