<template>
    <div>
            <day-card-list v-on:set-current-date="goToDayView"

                :starting-date="startDate"
                :day-of-week="dayOfWeek"
                locked="false"></day-card-list>
        <div v-for="dayMenu in dayMenus[dayOfWeek]">
            <time-of-day v-if="dayMenu instanceof Object"
                         v-on:meal-completed-two="updateCalories($event)"
                    :day-menu="dayMenu"
                    :day-of-week="dayOfWeek"
                    :calories-left="caloriesLeft"
                    :is-user="1"
                    :weekPlanId="weekPlanId"
                     :caloryGoal="caloryGoal"
            ></time-of-day>
        </div>
        <!-- BUTTON BEFORE FOOTER -->
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-btn-footer">
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <a href="#" class="btn btn-success btn-block" id="btn-light-green"><i class="fa fa-plus"></i>Add Additional Foods Consumed</a>
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <a href="#" class="btn btn-success btn-block" id="btn-light-orange"><i class="fa fa-plus"></i>Add Exercise</a>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-btn-footer" style="margin-bottom: 20px">
            <div class="col-lg-4 col-xs-12 col-sm-4">
                <div class="supporting-text">
                    <h1>{{totalCalories}}</h1>
                    <p>Actual Consumed</p>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-sm-4">
                <div class="supporting-text">
                    <h1>{{caloryGoal}}</h1>
                    <p>Daily Goal of calories</p>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-sm-4">
                <div class="supporting-text-green" v-if="parseInt(totalCalories) <= parseInt(caloryGoal)">
                    <p class="text-center">Congratulations, You consumed a healthy amount of calories that work with your weight goals.</p>
                </div>
                <div class="supporting-text-orange" v-if="parseInt(totalCalories) > parseInt(caloryGoal)">
                    <p class="text-center">You consumed more calories than what your daily goal was.</p>
                </div>
            </div>

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
                caloryGoal: window.caloryGoal,
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
                    this.totalCalories = this.dayMenus[this.dayOfWeek].totalcalories;

            });
            },
            goToDayView(value){
                    this.dayOfWeek = value;
                    //console.log(this.dayMenus[this.dayOfWeek].totalcalories);
                    this.totalCalories = this.dayMenus[this.dayOfWeek].totalcalories;
                },
            updateCalories($event) {
                if($event.meal_completed == true) {
                    this.totalCalories += $event.meal.calories;
                } else {
                    this.totalCalories -= $event.meal.calories;
                }
            }
            }
    }
</script>
