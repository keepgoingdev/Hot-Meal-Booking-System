<template>
    <tr class="tr-detail-meals" colspan="2">
        <td class="td-meal-image text-center">
            <img style="margin: 0px auto;display:block" :src="meal.image" alt="" class="img-responsive">
            <p class="visible-sm visible-xs">{{meal.name}}</p>
            <p class="visible-sm visible-xs" >{{meal.serving_size}}</p>
            <div class="row visible-sm visible-xs">
                <div class="col-xs-6 text-right">
                    <a href="#" class="" @click.prevent="toggleFavorite(meal.id)"><i class="fa fa-2x" v-bind:class="[  meal.favorite ? 'fa-heart' : 'fa-heart-o' ]"></i></a>
                </div>
                <div class="col-xs-6 text-left">
                    <div class="checkbox checkbox-info" style="margin-top: -4px">
                        <input :id="'check'+parseInt(meal.id)" class="mycheck" type="checkbox" v-bind:checked="meal.meal_completed == '1' || meal.meal_completed == true" @click="mealCompleted(meal.id)">
                        <label :for="'check'+parseInt(meal.id)">
                        </label>
                    </div>
                </div>
            </div>


        </td>
        <td class="semi-top hidden-xs hidden-sm">
            <center><h5>{{meal.name}}</h5></center>
        </td>
        <td class="semi-top hidden-sm hidden-xs">
        </td>
        <td class="semi-top hidden-sm hidden-xs" style="width:150px;">
            <center><p>{{meal.serving_size}}</p></center>
            <center v-if="meal.condiment"><p>{{meal.condiment.serving_size}}</p></center>
        </td>
        <td class="semi-top  hidden-sm hidden-xs" v-bind:class="{'hidden': isUser != 1}">
            <center><a href="#"  @click.prevent="toggleFavorite(meal.id)"><i class="fa fa-2x" v-bind:class="[  meal.favorite ? 'fa-heart' : 'fa-heart-o' ]"></i></a></center>
        </td>                                    
        <td class="semi-top  hidden-sm hidden-xs" v-bind:class="{'hidden': isUser != 1}" style="min-width: 40px" id="right-border-table">
            <center>
                <div class="checkbox checkbox-info">
                    <input :id="'check'+parseInt(meal.id)" class="mycheck" type="checkbox" v-bind:checked="meal.meal_completed == '1' || meal.meal_completed == true" @click="mealCompleted(meal.id)">
                    <label :for="'check'+parseInt(meal.id)">
                    </label>
                </div>
            </center>
        </td>
    </tr>

</template>
<script>

</script>
<script>
    const ApiUtil = require('../Utils/ApiUtil.js');

    export default {
        props: [
            'meal',
            'isUser',
        ],

        methods: {
            toggleFavorite(index) {
                this.meal.favorite = !this.meal.favorite;
                let url = '/intapi/mark-meal-as-favorite/'+index;
                ApiUtil.postToApi(url).then((data) => {
                    console.log(data.meal_completed);
                });
            },
            mealCompleted(mealId) {
                this.meal.meal_completed = ! this.meal.meal_completed;
                this.$emit('meal-completed', mealId);
            }
        },


    }
</script>