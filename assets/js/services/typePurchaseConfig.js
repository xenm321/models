import axios from 'axios';
import qs from "qs";
import UrlParam from "../utils/UrlParam";

const TypePurchaseConfigService = {
    find(id) {
        return new Promise((resolve, reject) => {
            const url = `/type-purchase-config/${id}`;
            axios.get(url)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },

    fetchAll (pagination, filter) {
        return new Promise((resolve) => {
            let url = '/type-purchase-config?';

            url += UrlParam.objectToUri(pagination);

            const filterUri = UrlParam.filterToUri(filter);

            if(filterUri) {
                url += '&' + filterUri;
            }

            axios.get(url)
                .then(response => {
                    resolve(response.data);
                });
        });
    },

    update (type, id) {
        return new Promise((resolve, reject) => {
            axios.put(`/type-purchase-config/${id}`, qs.stringify(type))
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },
};

export default TypePurchaseConfigService;
