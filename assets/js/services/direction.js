import axios from 'axios';
import qs from "qs";

const DirectionService = {
    list () {
        return new Promise((resolve, reject) => {
            axios.get('/direction/list')
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },
};

export default DirectionService;
