window._ = require('lodash');
window.Popper = require('popper.js').default;

window.axios = require('axios');
window.axios.defaults.withCredentials = true
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';