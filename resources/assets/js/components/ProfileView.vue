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
                    :is-user="1"
                    :weekPlanId="weekPlanId"
                     :caloryGoal="caloryGoal"
            ></time-of-day>
        </div>
        <!-- BUTTON BEFORE FOOTER -->
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-btn-footer">
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <a href="#" class="btn btn-success btn-block" id="btn-light-green" v-on:click.prevent="showAdditionalFood = !showAdditionalFood"><i class="fa fa-plus"></i>Add Additional Foods Consumed</a>
                <div v-bind:class="[  showAdditionalFood ? '' : 'hidden' ]" style="padding: 20px;">
                    I ate <input class="form-control" v-model="additional" style="display: inline; width: 150px" type="text" placeholder="123"> more calories.
                    <button class="btn btn-success" @click.prevent="updateAdditional" style="margin-top: -2px"><i class="fa fa-check"></i> Confirm</button>
                </div>
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <a href="#" class="btn btn-success btn-block" id="btn-light-orange" v-on:click.prevent="showExercise = !showExercise"><i class="fa fa-plus"></i>Add Exercise</a>
                <div v-bind:class="[  showExercise ? '' : 'hidden' ]" style="padding: 20px;">
                    I spent <input class="form-control" v-model="exercise" style="display: inline; width: 150px" type="text" placeholder="123"> calories exercising!
                    <button class="btn btn-success" @click.prevent="updateExercise" style="margin-top: -2px"><i class="fa fa-check"></i> Confirm</button>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-btn-footer" style="margin-bottom: 20px">
            <div class="col-lg-4 col-xs-12 col-sm-4">
                <div class="supporting-text">
                    <h1>{{ total }}                    </h1>

                        <p style="margin-bottom: 0">Actual Consumed</p>
                        <small class="text-muted" style="font-size: 12px">
                            {{totalCalories}} + {{additional ? additional : 0}} additional - {{ parseInt(exercise ? exercise : 0) }} exercise
                        </small>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-sm-4">
                <div class="supporting-text">
                    <h1>{{caloryGoal}}</h1>
                    <p>Daily Goal of calories</p>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-sm-4">
                <div class="supporting-text-green" v-if="parseInt(total) <= parseInt(caloryGoal)">
                    <p class="text-center">Congratulations, You consumed a healthy amount of calories that work with your weight goals.</p>
                </div>
                <div class="supporting-text-orange" v-if="parseInt(total) > parseInt(caloryGoal)">
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
                additional: 0,
                exercise: 0,
                showAdditionalFood: false,
                showExercise: false
            }
        },
        computed: {
            total : function() {
                return parseInt(this.totalCalories) + parseInt(this.additional ? this.additional : 0) - parseInt(this.exercise ? this.exercise : 0) ;
            }
        },
        mounted() {
            this.getMeals();
        },
        methods:{
            getMeals() {
                console.log(this.weekPlanId);
                let url = '/intapi/week-plans/'+this.weekPlanId;
                ApiUtil.fetchFromApi(url, {}).then((dayMenus) => {
                    this.dayMenus = dayMenus;
                    this.totalCalories = this.dayMenus[this.dayOfWeek].totalcalories;
                    this.additional = this.dayMenus[this.dayOfWeek].additional;
                    this.exercise = this.dayMenus[this.dayOfWeek].exercise;

            });
            },
            goToDayView(value){
                    this.dayOfWeek = value;
                    //console.log(this.dayMenus[this.dayOfWeek].totalcalories);
                    this.totalCalories = this.dayMenus[this.dayOfWeek].totalcalories;
                    this.additional = this.dayMenus[this.dayOfWeek].additional;
                    this.exercise = this.dayMenus[this.dayOfWeek].exercise;
                    this.showAdditionalFood = false;
                    this.showExercise = false;
                },
            updateCalories($event) {
                if($event.meal_completed == true) {
                    this.totalCalories += $event.meal.calories;
                } else {
                    this.totalCalories -= $event.meal.calories;
                }
            },
            updateAdditional() {
                let formData = new FormData();
                formData.append('additional', this.additional ? this.additional : 0);
                ApiUtil.postToApi('/intapi/add-additional/'+weekPlanId+'/'+this.dayOfWeek, formData).then(() => {
                    //this.totalCalories += this.additional;
                });
            },
            updateExercise() {
                let formData = new FormData();
                formData.append('exercise', this.exercise ? this.exercise : 0);
                ApiUtil.postToApi('/intapi/add-exercise/'+weekPlanId+'/'+this.dayOfWeek, formData).then(() => {
                    //this.totalCalories += this.additional;
                });
            }
            }
    }
</script>
