import Errors from './Errors';
import Request from './Request';

class Form {
    constructor(data) {
        this.originalData = data;

        for (let field in data) {
            if (data.hasOwnProperty(field)) {
                this[field] = data[field];
            }
        }

        this.errors = new Errors();
        this.request = Request;
    }

    getFormData() {
        let formData = new FormData();

        for (let field in this.originalData) {
            if (this.originalData.hasOwnProperty(field)) {
                let value = this[field];

                if (typeof value === 'boolean') {
                    value = value ? 1 : 0;
                }

                if (typeof value === 'object') {
                    if (value === null) {
                        value = '';
                    } else if (Array.isArray(value)) {
                        for (let extra of value) {
                            formData.append(`${field}[]`, extra)
                        }
                        continue;
                    }
                }

                formData.append(field, value);
            }
        }

        return formData;
    }

    reset() {
        for (let field in this.originalData) {
            if (this.originalData.hasOwnProperty(field)) {
                this[field] = this.originalData[field];
            }
        }

        this.errors.clear();
    }

    submit(url, clear = true) {
        const data = this.getFormData();

        return new Promise((resolve, reject) => {
            this.request.post(url, data, {'Content-Type': 'multipart/form-data'})
                .then(response => {
                    if (clear)
                        this.reset();
                    resolve(response.data);
                })
                .catch(error => {
                    this.errors.record(error.response.data);
                    reject(error.response.data);
                });
        });
    }
}

export default Form;
