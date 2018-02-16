window.Vue = require('vue');

Vue.component('grocery-list', require('../components/GroceryList.vue'));

const app = new Vue({
    el: '#grocery-list-client'
});
