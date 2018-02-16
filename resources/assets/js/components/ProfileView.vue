<template>
    <div>
            <day-card-list v-on:set-current-date="goToDayView"
                :starting-date="startDate"
                :day-of-week="dayOfWeek"
                locked="false"></day-card-list>
        <div v-for="dayMenu in dayMenus[dayOfWeek]">
            <time-of-day
                    :day-menu="dayMenu"
                    :day-of-week="dayOfWeek"
                    :calories-left="caloriesLeft"
                    :is-user="1"
            ></time-of-day>
        </div>
    </div>
</template>

<script>
    const ApiUtil = require('../Utils/ApiUtil.js');

    const dayCardList = require('../components/DayCardList.vue');
    const timeOfDay = require('../components/TimeOfDay.vue');
    import Datepicker from 'vuejs-datepicker';

    export default {
        components: {
            'day-card-list': dayCardList,
            'time-of-day': timeOfDay,
            Datepicker
        },
        data: function(){
            let date = new Date();
            return {
                dayOfWeek: 0,
                startDate: window.startDate,
                weekPlanId: window.weekPlanId,
                dayMenus: [],
                totalCalories: 0,
                caloriesLeft: 0
            }
        },

        mounted() {
            this.getMeals();
        },
        methods:{
            getMeals() {
                console.log(this.weekPlanId);
                let url = 'api/week-plans/'+this.weekPlanId;
                ApiUtil.fetchFromApi(url, {}).then((dayMenus) => {
                    this.dayMenus = dayMenus;
                });
            },
            goToDayView(value){
                    this.dayOfWeek = value;
                  
                }
            }
    }
</script>
