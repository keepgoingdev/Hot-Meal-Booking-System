<template>
    <tr class="tr-detail-meals" colspan="2">
        <td class="td-meal-image text-center">
            <img style="margin: 0px auto;display:block" :src="meal.image" alt="" class="img-responsive">
            <p class="visible-sm visible-xs">{{meal.name}}</p>
            <p class="visible-sm visible-xs" >{{meal.serving_size}}</p>
            <div class="row visible-sm visible-xs">
                <div class="col-xs-2">
                    <a href="javascript:;"
                       v-show="meal.notes"
                       data-toggle="tooltip"
                       data-trigger="click"
                       :title="meal.notes"
                    >
                        <i class="fa fa-2x fa-sticky-note fa-blue"
                           onclick="if($(this).hasClass('fa-blue')) { $(this).removeClass('fa-blue');$(this).addClass('fa-orange'); } else { $(this).removeClass('fa-orange');$(this).addClass('fa-blue'); }"
                        ></i>
                    </a>
                </div>
                <div class="col-xs-4">
                    <a href="#" @click.prevent="toggleFavorite(meal.id)">
                        <i class="fa fa-2x" v-bind:class="[  meal.favorite ? 'fa-heart' : 'fa-heart-o' ]"></i>
                    </a>
                </div>
                <div class="col-xs-2">
                    <a href="#" @click.prevent="toggleBanned(meal.id)">
                        <i class="fa fa-2x fa-ban"></i>
                    </a>
                </div>
                <div class="col-xs-4">
                    <div class="checkbox checkbox-info" style="margin-top: -4px">
                        <input :id="'check'+parseInt(meal.id)" class="mycheck" type="checkbox" v-bind:checked="meal.meal_completed == '1' || meal.meal_completed == true" @click="mealCompleted(meal.id)">
                        <label :for="'check'+parseInt(meal.id)">
                        </label>
                    </div>
                </div>
            </div>
        </td>
        <td class="semi-top hidden-xs hidden-sm text-center">
            <h5>{{meal.name}}</h5>
        </td>
        <td class="semi-top hidden-sm hidden-xs">
        </td>
        <td class="semi-top hidden-sm hidden-xs text-center" style="width:150px;">
            <p>{{meal.serving_size}}</p>
            <p v-if="meal.condiment">{{meal.condiment.serving_size}}</p>
        </td>
        <td class="semi-top hidden-sm hidden-xs text-center" v-bind:class="{'hidden': isUser != 1}">
            <a href="javascript:;"
               v-show="meal.notes"
               data-toggle="tooltip"
               data-trigger="click"
               :title="meal.notes"
            >
                <i class="fa fa-2x fa-sticky-note fa-blue"
                   onclick="if($(this).hasClass('fa-blue')) { $(this).removeClass('fa-blue');$(this).addClass('fa-orange'); } else { $(this).removeClass('fa-orange');$(this).addClass('fa-blue'); }"
                ></i>
            </a>
        </td>
        <td class="semi-top hidden-sm hidden-xs text-center" v-bind:class="{'hidden': isUser != 1}">
            <a href="#"  @click.prevent="toggleFavorite(meal.id)"><i class="fa fa-2x" v-bind:class="[  meal.favorite ? 'fa-heart fa-mob' : 'fa-heart-o fa-mob' ]"></i></a>
        </td>
        <td class="semi-top hidden-sm hidden-xs text-center" v-bind:class="{'hidden': isUser != 1}">
            <a href="#"  @click.prevent="toggleBanned(meal.id)"><i class="fa fa-2x fa-ban"></i></a>
        </td>
        <td class="semi-top text-center hidden-sm hidden-xs" v-bind:class="{'hidden': isUser != 1}" style="min-width: 40px" id="right-border-table">
                <div class="checkbox checkbox-info">
                    <input :id="'check'+parseInt(meal.id)" class="mycheck" type="checkbox" v-bind:checked="meal.meal_completed == '1' || meal.meal_completed == true" @click="mealCompleted(meal.id)">
                    <label :for="'check'+parseInt(meal.id)">
                    </label>
                </div>
                <br><small v-if="meal.meal_completed == '0' || meal.meal_completed == false" class="text-muted">Check to mark meal as completed.</small>
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
            toggleBanned: function toggleBanned(index) {
                //this.meal.banned = !this.meal.banned;
                var url = '/intapi/ban-meal/' + index;
                var _this = this;
                if(confirm('Are you sure you want to ban this meal?')) {
                  ApiUtil.postToApi(url).then(function (data) {
                    _this.$el.remove();
                  });
                }
            },
            mealCompleted(mealId) {
                this.meal.meal_completed = ! this.meal.meal_completed;
                this.$emit('meal-completed', mealId);
            }
        },
    }
</script>