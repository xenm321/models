import axios from 'axios';
import UrlParam from './../utils/UrlParam.js';

const ModelService = {
    fetchAll (pagination, filter) {
        return new Promise((resolve) => {
            let url = '/model?';

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
};

export default ModelService;
