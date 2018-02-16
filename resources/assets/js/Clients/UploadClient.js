window.Vue = require('vue');

Vue.component('upload-csv', require('../components/UploadCsv.vue'));

const app = new Vue({
    el: '#upload-client'
});
