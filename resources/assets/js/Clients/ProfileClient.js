window.Vue = require('vue');

Vue.component('profile-view', require('../components/ProfileView.vue'));

const app = new Vue({
    el: '#profile-client',
});
