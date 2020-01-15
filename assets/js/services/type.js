import axios from 'axios';
import qs from "qs";

const TypeService = {
    find(id) {
        return new Promise((resolve, reject) => {
            const url = `/type/${id}`;
            axios.get(url)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },

    fetchAll (pagination, search) {
        return new Promise((resolve) => {
            const url = `/type?page=${pagination.page}&sortBy=${pagination.sortBy}&descending=${pagination.descending}&perPage=${pagination.rowsPerPage}&search=${search}`;
            axios.get(url)
                .then(response => {
                    resolve(response.data);
                });
        });
    },

    list () {
        return new Promise((resolve, reject) => {
            axios.get('/type/list')
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },

    create (type) {
        return new Promise((resolve, reject) => {
            axios.post('/type', qs.stringify(type))
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },

    update (type, id) {
        return new Promise((resolve, reject) => {
            axios.put(`/type/${id}`, qs.stringify(type))
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },

    delete (id) {
        return new Promise((resolve, reject) => {
            axios.delete(`/type /${id}`)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    }
};

export default TypeService;
