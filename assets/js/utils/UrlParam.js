const UrlParam = {
    filterToUri(filter) {
        let result = [];

        for (const key in filter) {
            if(Array.isArray(filter[key])) {
                for(let i = 0; i < filter[key].length; i++) {
                    result.push(`f[${key}][]=${filter[key][i]}`);
                }
            } else {
                result.push(`f[${key}]=${filter[key]}`);
            }
        }

        return result.join('&');
    },

    objectToUri(object) {
        let result = [];

        for (const key in object) {
            result.push(`${key}=${object[key]}`);
        }

        return result.join('&');
    }
};

export default UrlParam;