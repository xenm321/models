import axios from 'axios';
import qs from "qs";

const SupplierService = {
    list () {
        return new Promise((resolve, reject) => {
            axios.get('/supplier/list')
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },
};

export default SupplierService;
