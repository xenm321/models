<template>
    <div>
        <v-card>
            <v-card-title>
                <v-btn fab dark small color="primary" :to="{ name: 'brand_create' }">
                    <v-icon dark>add</v-icon>
                </v-btn>

                <v-spacer></v-spacer>

                <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Поиск"
                        single-line
                        hide-details
                ></v-text-field>
            </v-card-title>
        </v-card>

        <v-data-table
                :headers="headers"
                :items="brands"
                :pagination.sync="pagination"
                :total-items="totalBrands"
                :loading="loading"
                :rows-per-page-items="[200]"
                class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td class="text-xs-left">{{ props.item.id }}</td>
                <td class="text-xs-left">{{ props.item.title }}</td>
                <td class="text-xs-left">{{ props.item.description }}</td>
                <td class="text-xs-left">{{ props.item.identifier }}</td>
                <td class="text-xs-left">{{ props.item.created | formatDate }}</td>
                <td class="text-xs-left">{{ props.item.updated | formatDate }}</td>
                <td class="text-xs-right">
                    <v-btn flat icon color="green" :to="{ name: 'brand_update', params: { id: props.item.id } }">
                        <v-icon>edit</v-icon>
                    </v-btn>

                    <v-btn flat icon color="red" @click.prevent="deleteBrand(props.item.id)">
                        <v-icon>remove</v-icon>
                    </v-btn>
                </td>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    import BrandService from '../../services/brand.js';

    export default {
        data () {
            return {
                totalBrands: 0,
                brands: [],
                loading: true,
                pagination: {},
                headers: [
                    { text: 'Id', value: 'id', width: 10 },
                    { text: 'Название', value: 'title' },
                    { text: 'Описание', value: 'description' },
                    { text: 'Идентификатор', value: 'identifier' },
                    { text: 'Создан', value: 'created', width: 150 },
                    { text: 'Обновлён', value: 'updates', width: 150 },
                    { text: 'Действия', sortable: false },
                ],
                search: ''
            }
        },

        watch: {
            pagination: {
                handler () {
                    this.getBrands();
                },
                deep: true
            },

            search: function(newVal, oldValue) {
                if(newVal.length > 1 || newVal.length < oldValue.length) {
                    this.getBrands();
                }
            }
        },

        methods: {
            getBrands() {
                this.loading = true;
                BrandService.fetchAll(this.pagination, this.search)
                    .then(data => {
                        this.loading = false;
                        this.brands = data.items;
                        this.totalBrands = data.total;
                    });
            },

            deleteBrand(id) {
                BrandService.delete(id)
                    .then(() => {
                        flash('Бренд удален');
                        this.getBrands();
                    })
                    .catch(error => {
                        flash(error.message, 'error');
                    });
            }
        }
    };
</script>
