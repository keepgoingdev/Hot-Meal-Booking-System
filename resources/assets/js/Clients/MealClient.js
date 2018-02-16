window.Vue = require('vue');

Vue.component('meal-view', require('../components/MealView.vue'));

const app = new Vue({
    el: '#meal-client'
});
