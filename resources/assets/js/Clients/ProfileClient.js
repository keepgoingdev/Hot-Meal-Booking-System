window.Vue = require('vue');

Vue.component('day-card-list', require('../components/DayCardList.vue'));

const app = new Vue({
    template:'<div><day-card-list v-on:set-current-date="goToDayView"' +
    ':starting-date="startDate"\n' +
    '                :day-of-week="dayOfWeek"' +
    '                  locked="false">' +
    '</day-card-list></div>',
    el: '#profile-client',
    data: function(){
        let date = new Date();
        return {
            dayOfWeek: 0,
            startDate: window.startDate == '' ? date : new Date(window.startDate),
            weekPlanId: window.weekPlanId
        }
    },
    methods:{
        goToDayView(index){
                window.location.href = '/week-plans/'+this.weekPlanId+'/days/'+index;
            }
        }
});
