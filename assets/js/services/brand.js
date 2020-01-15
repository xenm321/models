import axios from 'axios';
import qs from "qs";

const BrandService = {
    find(id) {
        return new Promise((resolve, reject) => {
            const url = `/brand/${id}`;
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
        return new Promise((resolve, reject) => {
            const url = `/brand?page=${pagination.page}&sortBy=${pagination.sortBy}&descending=${pagination.descending}&perPage=${pagination.rowsPerPage}&search=${search}`;
            axios.get(url)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },

    list () {
        return new Promise((resolve, reject) => {
            axios.get('/brand/list')
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },

    create (brand) {
        return new Promise((resolve, reject) => {
            axios.post('/brand', qs.stringify(brand))
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },

    update (brand, id) {
        return new Promise((resolve, reject) => {
            axios.put(`/brand/${id}`, qs.stringify(brand))
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
            axios.delete(`/brand/${id}`)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    }
};

export default BrandService;
