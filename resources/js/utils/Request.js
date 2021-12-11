import axios from 'axios';

class Request {
    constructor() {
        this.service = axios;

        this.service.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        this.service.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;

        this.service.interceptors.response.use(
            response => {
                return response
            },
            error => {
                // redirect to login page if the request is not authorized,
                // otherwise push a new error notification to the notifications
                error.response.status === 401 ?
                    window.location.href = '/login-admin' : null;
                //store.dispatch('notifications/push', new Notification(error.response.data.message));

                return Promise.reject(error);
            });
    }

    get(uri, params = {}) {
        return this.service.get(uri, params);
    }

    post(uri, data, headers = {}) {
        return this.service.post(uri, data, {headers});
    }

    patch(uri, data, headers = {}) {
        return this.service.patch(uri, data);
    }

    put(uri, data, headers = {}) {
        return this.service.put(uri, data);
    }

    delete(uri) {
        return this.service.delete(uri);
    }
}

export default new Request();
