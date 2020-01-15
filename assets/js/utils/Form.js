const FormUtils = {
    objectToFormData: function(obj, form, namespace) {

        let fd = form || new FormData();
        let formKey;

        for(const property in obj) {
            if(obj.hasOwnProperty(property)) {
                if(namespace) {
                    formKey = namespace + "[" + property + "]";
                } else {
                    formKey = property;
                }

                if(typeof obj[property] === "object" && !(obj[property] instanceof File) && obj[property] != '0') {
                    this.objectToFormData(obj[property], fd, property);
                } else {
                    fd.append(formKey, obj[property]);
                }
            }
        }

        return fd;
    },
};

export default FormUtils;
