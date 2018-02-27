<template>
    <div class="col-lg-12 col-sm-12" id="box-meal-profile" style="margin-top: 30px;">
        <div class="col-lg-6 col-sm-6">
            <span class="btn btn-default" id="btn-meal-name">{{dayMenu.name}}</span>
            <button @click="regenerateMeals" class="btn btn-default" id="btn-meal-shuffle"><i class="fa fa-random"></i></button>
            <span style="margin-top: 5px"><i class="fa fa-question circle"  data-toggle="tooltip" title="You can regenerate the meals by clicking the button!"></i></span>
        </div>
        <div class="col-lg-6 col-sm-6">
            <p class="total-calories-profile">{{dayMenu.calories}} calories</p>
        </div>
        <div class="col-lg-12">
            <div class="box-detail-meal">
                <div class="panel panel-default">

                        <table class="table table-hover">
                            <tbody v-for="meal in dayMenu.meals">
                            <meal-item :meal="meal" :is-user="isUser" v-on:meal-completed="markCompleted($event, meal.id)"></meal-item>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>

    </div>
</template>
<script>

    // Utils
    const ApiUtil = require('../Utils/ApiUtil.js');

    // Components
    const mealItem = require('../components/MealItem.vue');

    export default {
        components: {
            'meal-item': mealItem,
        },
        props:[
            'dayMenu',
            'dayOfWeek',
            'isUser',
            'weekPlanId',
            'caloryGoal'
        ],
        data: function () {
            return {

            }
        },
        methods: {
            regenerateMeals(){
                let formData = new FormData();
                var url = null;
                if(this.isUser) {
                    url = '/intapi/get-new-meals';
                    formData.append('mealType', this.dayMenu.name);
                    formData.append('weekPlanId', this.weekPlanId);
                    formData.append('day', this.dayOfWeek);
                } else {
                    url = '/intapi/regenerate-meals';
                    formData.append('day-menu-name', this.dayMenu.name);
                    formData.append('max-calories', maxCalories);
                    formData.append('day-of-week', this.dayOfWeek);
                }

                ApiUtil.postToApi(url, formData).then((data) => {
                    this.dayMenu.meals = data['meals'];
                    this.dayMenu.calories = data['calories'];
                    //console.log(data);
                });
                //console.log()
            },
            markCompleted: function ($event, mealId) {

                ApiUtil.postToApi('/intapi/meal-completed/'+mealId+'/'+weekPlanId+'/'+this.dayOfWeek).then((data) => {
                    this.$emit('meal-completed-two', data);

                });
            }
        }
    }
</script>
