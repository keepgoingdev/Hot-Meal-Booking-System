<template>
    <div>
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-user-profile">
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <h5>Daily Calorie Goal: {{calorieGoal}} Calories per day</h5>
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <div class="box-starting-date" id="starting-date">
                    <label style="display: inline-block; width: 140px; text-align: left;" class="">Starting Date:</label>
                    <datepicker v-on:selected="updateDate"
                                :value="selectedDate"
                                :disabled="state.disabled"
                                :monday-first="true">
                    </datepicker>
                </div>
            </div>
        </div>
        <day-card-list
                v-on:set-current-date="setCurrentDate"
                :starting-date="selectedDate"
                :day-of-week="dayOfWeek"
                locked="true"
        ></day-card-list>
        <div v-for="dayMenu in dayMenus[dayOfWeek]">
        <time-of-day
                :day-menu="dayMenu"
                :day-of-week="dayOfWeek"
                :calories-left="caloriesLeft"
        ></time-of-day>
        </div>
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-btn-footer">
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <h5>Daily amount of Calories: {{totalCalories}} Calories per day</h5>
            </div>
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
            <div class="box-prev-next">
                <a href="#starting-date" v-on:click="decreaseDayOfWeek" class="btn btn-success" id="btn-prev"><i class="fa fa-long-arrow-left"></i> PREV</a>
                <a href="#starting-date" v-on:click="increaseDayOfWeek" class="btn btn-success" id="btn-next">NEXT <i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // Utils
    const ApiUtil = require('../Utils/ApiUtil.js');

    // Components
    const dayCardList = require('../components/DayCardList.vue');
    const timeOfDay = require('../components/TimeOfDay.vue');
    import Datepicker from 'vuejs-datepicker';

    export default {
        components: {
            'day-card-list': dayCardList,
            'time-of-day': timeOfDay,
            Datepicker
        },
        data: function () {
            let state = {
                'disabled': {
                    to: new Date(),
                }
            }
            let nextMonday = new Date();
            let daysToNextMonday = (1 + 7 - nextMonday.getDay()) % 7;

            //if today is Monday pick next week
            if(daysToNextMonday === 0){
                daysToNextMonday = 7;
            }
            nextMonday.setDate(nextMonday.getDate() + daysToNextMonday);

            return {
                state: state,
                selectedDate: nextMonday,
                dayMenus: [],
                calorieGoal: window.calorieGoal,
                dayOfWeek: 0
            }
        },
        computed:{
            totalCalories: function() {
                let calories = 0;
                if (this.dayMenus[this.dayOfWeek]) {
                    this.dayMenus[this.dayOfWeek].forEach(function (dayMenu) {
                        calories += +dayMenu.calories;
                    });
                    return calories;
                }
            },
            caloriesLeft: function(){
                return this.calorieGoal - this.totalCalories;
            }
        },
        mounted() {
            this.getMeals();
        },
        methods: {
            getMeals() {
                let url = 'api/meals';
                ApiUtil.fetchFromApi(url, {}).then((dayMenus) => {
                    this.dayMenus = dayMenus;
                });
            },
            updateDate: function(value) {
                if(value) {
                    this.selectedDate = value;
                }

                let url = 'api/starting-date';
                var formData = new FormData();
                formData.append('starting-date', this.selectedDate.toISOString().split('T')[0]);
                ApiUtil.postToApi(url, formData);
            },
            setCurrentDate: function(value) {
                this.dayOfWeek = value;
            },
            increaseDayOfWeek(){
               if(this.dayOfWeek + 1 > 6){
                   this.updateDate(this.selectDate);
                   window.location.href = '/register';
               }
               else {
                   this.dayOfWeek++;
               }
            },
            decreaseDayOfWeek(){
                if(this.dayOfWeek - 1 < 0){
                   window.location.href = '/step-two';
               }
               else{
                    this.dayOfWeek--;
                }
            }
        }
    }
</script>
