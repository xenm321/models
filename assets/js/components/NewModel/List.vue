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
                        </v-layout>

                    </v-container>
                </v-form>

            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-container>
                    <v-layout row wrap>
                        <v-btn fab dark large color="success" @click.prevent="getModels()">
                            <v-icon dark>search</v-icon>
                        </v-btn>
                    </v-layout>
                </v-container>
            </v-flex>

        </v-layout>


        <v-card>
            <v-card-title>
                <v-btn fab dark small color="primary" :to="{ name: 'new_model_create' }">
                    <v-icon dark>add</v-icon>
                </v-btn>
            </v-card-title>
        </v-card>

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
                <td class="text-xs-left">{{ props.item.type.title }}</td>
                <td class="text-xs-left">{{ props.item.brand.title }}</td>
                <td class="text-xs-left">{{ props.item.title }}</td>
                <td class="text-xs-left">{{ props.item.seoTitle }}</td>
                <td class="text-xs-left">{{ props.item.created | formatDate }}</td>
                <td class="text-xs-left">{{ props.item.updated | formatDate }}</td>
                <td class="text-xs-right">
                    <v-btn flat icon color="green" :to="{ name: 'new_model_marketer_update', params: { id: props.item.id } }">
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
    import NewModelService from '../../services/newModel.js';
    import BrandService from '../../services/brand.js';
    import TypeService from '../../services/type.js';

    export default {
        data () {
            return {
                totalModels: 0,
                models: [],
                loading: true,
                pagination: {},
                headers: [
                    { text: 'Тип', value: 'type' },
                    { text: 'Бренд', value: 'brand' },
                    { text: 'Название', value: 'title', width: 10 },
                    { text: 'Название для SEO', value: 'seoTitle', width: 10 },
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
                    this.getModels();
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
            getModels() {
                this.loading = true;
                NewModelService.fetchAll(this.pagination, this.filter)
                    .then(data => {
                        this.loading = false;
                        this.models = data.items;
                        this.totalModels = data.total;
                        this.$router.replace({ name: 'new_models_list', query: this.filter });
                    });
            },

            initFilterData() {
                this.getBrands();
                this.getTypes();
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
        }
    };
</script>
