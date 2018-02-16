<template>
    <div class="col-lg-12 col-sm-12" id="box-meal-profile" style="margin-top: 30px;">
        <div class="col-lg-6 col-sm-6">
            <span class="btn btn-default" id="btn-meal-name">{{dayMenu.name}}</span>
            <button @click="regenerateMeals" class="btn btn-default" id="btn-meal-shuffle"><i class="fa fa-random"></i></button>
        </div>
        <div class="col-lg-6 col-sm-6">
            <p class="total-calories-profile">{{dayMenu.calories}} calories</p>
        </div>
        <div class="col-lg-12">
            <div class="box-detail-meal">
                <div class="panel panel-default">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody v-for="meal in dayMenu.meals">
                            <meal-item :meal="meal" :is-favorite="meal.favorite" :is-user="isUser"></meal-item>
                            </tbody>
                        </table>
                    </div>
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
            'caloriesLeft',
            'isUser'
        ],
        data: function () {
            return {

            }
        },
        methods: {
            regenerateMeals(){
                let url = 'api/regenerate-meals';
                let formData = new FormData();
                let maxCalories = this.dayMenu.calories + this.caloriesLeft;
                formData.append('day-menu-name', this.dayMenu.name);
                formData.append('max-calories', maxCalories);
                formData.append('day-of-week', this.dayOfWeek);

                ApiUtil.postToApi(url, formData).then((data) => {
                    this.dayMenu.meals = data['meals'];
                    this.dayMenu.calories = data['calories'];
                    console.log(data);
                });
                console.log()
            }
        }
    }
</script>
