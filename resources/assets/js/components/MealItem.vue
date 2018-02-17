<template>
    <tr class="tr-detail-meals" colspan="2">
        <td class="td-meal-image">
            <img :src="meal.image" alt="" class="img-responsive">
        </td>
        <td class="td-meal-image" style="width:120px">
            <img v-if="meal.condiment" :src="meal.condiment.image" alt="" class="img-responsive">
        </td>
        <td class="semi-top">
            <center><h5>{{meal.name}}</h5></center>
            <center v-if="meal.condiment"><h5>{{meal.condiment.name}}</h5></center>
        </td>
        <td class="semi-top">
        </td>
        <td class="semi-top" style="width:150px;">
            <center><p>{{meal.serving_size}}</p></center>
            <center v-if="meal.condiment"><p>{{meal.condiment.serving_size}}</p></center>
        </td>
        <td class="semi-top" v-bind:class="{'hidden': isUser != 1}">
            <center><a href="#"  @click.prevent="toggleFavorite(meal.id)"><i class="fa fa-2x" v-bind:class="[  meal.favorite ? 'fa-heart' : 'fa-heart-o' ]"></i></a></center>
        </td>                                    
        <td class="semi-top" v-bind:class="{'hidden': isUser != 1}" id="right-border-table">
            <center>
                <div class="checkbox checkbox-info">

                    <input :id="'check'+parseInt(meal.id)" class="mycheck" type="checkbox" v-bind:checked="meal.meal_completed" @click="mealCompleted(meal.id)">
                    <label :for="'check'+parseInt(meal.id)">
                    </label>
                </div>
            </center>
        </td>
    </tr>

</template>

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
                let url = 'api/mark-meal-as-favorite/'+index;
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