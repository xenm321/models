<template>
    <div>
        <v-layout row wrap>
            <v-flex xs12 sm6 md10>

                <v-form>
                    <v-container>
                        <v-layout row wrap>
                            <v-flex xs6 sm6 md4>
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

                            <v-flex xs6 sm6 md4>
                                <v-select
                                        v-model="filter.direction"
                                        :items="filterData.directions"
                                        item-text="title"
                                        item-value="id"
                                        label="Направление"
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
                        <v-btn fab dark large color="success" @click.prevent="getConfigs()">
                            <v-icon dark>search</v-icon>
                        </v-btn>
                    </v-layout>
                </v-container>
            </v-flex>

        </v-layout>

        <v-data-table
                :headers="headers"
                :items="configs"
                :pagination.sync="pagination"
                :total-items="totalConfigs"
                :loading="loading"
                :rows-per-page-items="[200]"
                class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td class="text-xs-left">{{ props.item.type.title }}</td>
                <td class="text-xs-left">{{ props.item.direction.title }}</td>
                <td class="text-xs-left">{{ props.item.config }}</td>
                <td class="text-xs-left">{{ props.item.created | formatDate }}</td>
                <td class="text-xs-left">{{ props.item.updated | formatDate }}</td>
                <td class="text-xs-right">
                    <v-btn flat icon color="green" :to="{ name: 'type_update', params: { id: props.item.id } }">
                        <v-icon>edit</v-icon>
                    </v-btn>
                </td>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    import TypePurchaseConfigService from '../../services/typePurchaseConfig.js';
    import TypeService from '../../services/type.js';
    import DirectionService from '../../services/direction.js';

    export default {
        data () {
            return {
                totalConfigs: 0,
                configs: [],
                loading: true,
                pagination: {},
                headers: [
                    { text: 'Тип', value: 'type' },
                    { text: 'Направление', value: 'direction' },
                    { text: 'Конфиг', value: 'config' },
                    { text: 'Создан', value: 'created', width: 150 },
                    { text: 'Обновлён', value: 'updates', width: 150 },
                    { text: 'Действия', sortable: false },
                ],
                search: '',
                filter: {},
                filterData: {
                    types: [],
                    directions: [],
                }
            }
        },

        watch: {
            pagination: {
                handler () {
                    this.getConfigs();
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
            getConfigs() {
                this.loading = true;
                TypePurchaseConfigService.fetchAll(this.pagination, this.filter)
                    .then(data => {
                        this.loading = false;
                        this.configs = data.items;
                        this.totalConfigs = data.total;
                        this.$router.replace({ name: 'typesPurchaseConfig_list', query: this.filter });
                    });
            },

            initFilterData() {
                this.getTypes();
                this.getDirections();
            },

            getTypes() {
                TypeService.list()
                    .then(data => {
                        this.filterData.types = data.map((currentValue) => {
                            return {id: ''+currentValue.id, title: currentValue.title};
                        });
                    });
            },

            getDirections() {
                DirectionService.list()
                    .then(data => {
                        this.filterData.directions = data.map((currentValue) => {
                            return {id: ''+currentValue.id, title: currentValue.title};
                        });
                    });
            },
        }
    };
</script>
