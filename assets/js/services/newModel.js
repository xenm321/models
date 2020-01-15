import axios from 'axios';
import UrlParam from './../utils/UrlParam.js';
import qs from "qs";
import FormUtils from "../utils/Form.js";

const NewModelService = {
    find(id) {
        return new Promise((resolve, reject) => {
            const url = `/new-model/${id}`;
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
            let url = '/new-model?';

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

    create (model, image) {
        const formData = new FormData();
        formData.append("photos[0][imageFile][file]", image);
        formData.append("type", model.type);
        formData.append("brand", model.brand);
        formData.append("purchasePrices[0][supplier]", model.supplier);
        formData.append("purchasePrices[0][price]", model.purchasePrice);

        return new Promise((resolve, reject) => {
            axios.post('/new-model',
                formData,
                {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                }
            )
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },

    update(model) {
        return new Promise((resolve, reject) => {
            axios.patch(`/new-model/${model.id}`, model)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },
};

export default NewModelService;
