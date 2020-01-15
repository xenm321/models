import axios from 'axios';

const ShopService = {
    list () {
        return new Promise((resolve, reject) => {
            axios.get('/shop/list')
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },
};

export default ShopService;
