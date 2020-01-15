<template>
    <div>
        <v-card>
            <v-card-title>
                <v-btn fab dark small color="primary" :to="{ name: 'type_create' }">
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
                :items="types"
                :pagination.sync="pagination"
                :total-items="totalTypes"
                :loading="loading"
                :rows-per-page-items="[200]"
                class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td class="text-xs-left">{{ props.item.id }}</td>
                <td class="text-xs-left">{{ props.item.code }}</td>
                <td class="text-xs-left">{{ props.item.title }}</td>
                <td class="text-xs-left">{{ props.item.description }}</td>
                <td class="text-xs-left">{{ props.item.identifier }}</td>
                <td class="text-xs-left">{{ props.item.created | formatDate }}</td>
                <td class="text-xs-left">{{ props.item.updated | formatDate }}</td>
                <td class="text-xs-right">
                    <v-btn flat icon color="green" :to="{ name: 'type_update', params: { id: props.item.id } }">
                        <v-icon>edit</v-icon>
                    </v-btn>

                    <v-btn flat icon color="red" @click.prevent="deleteType(props.item.id)">
                        <v-icon>remove</v-icon>
                    </v-btn>
                </td>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    import TypeService from '../../services/type.js';

    export default {
        data () {
            return {
                totalTypes: 0,
                types: [],
                loading: true,
                pagination: {},
                headers: [
                    { text: 'Id', value: 'id', width: 10 },
                    { text: 'Код', value: 'code', width: 10 },
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
                    this.getTypes();
                },
                deep: true
            },
            search: function(newVal, oldValue) {
                if(newVal.length > 1 || newVal.length < oldValue.length) {
                    this.getTypes();
                }
            }
        },

        methods: {
            getTypes() {
                this.loading = true;
                TypeService.fetchAll(this.pagination, this.search)
                    .then(data => {
                        this.loading = false;
                        this.types = data.items;
                        this.totalTypes = data.total;
                    });
            },

            deleteType(id) {
                BrandService.delete(id)
                    .then(() => {
                        flash('Тип удален');
                        this.getTypes();
                    })
                    .catch(error => {
                        flash(error.message, 'error');
                    });
            }
        }
    };
</script>
