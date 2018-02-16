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
        <td class="semi-top"style="width:150px;">
            <center><p>{{meal.serving_size}}</p></center>
            <center v-if="meal.condiment"><p>{{meal.condiment.serving_size}}</p></center>
        </td>
        <td class="semi-top hidden">
            <center><a href="#"><i class="fa fa-heart-o fa-2x"></i></a></center>
        </td>
    </tr>
    <!--<tr class="tr-detail-meals" v-if="meal.condiment !== null">-->
        <!--<td class="td-meal-image"><img :src="meal.condiment.image" alt="" class="img-responsive"></td>-->
        <!--<td class="semi-top">-->
            <!--<center><h5>{{meal.condiment.name}}</h5></center>-->
        <!--</td>-->
        <!--<td class="semi-top" style="width:100px;">-->
            <!--<center><p>{{meal.condiment.serving_size}}</p></center>-->
        <!--</td>-->
        <!--<td class="semi-top">-->
            <!--<center><a href="#"><i class="fa fa-heart-o fa-2x"></i></a></center>-->
        <!--</td>-->
    <!--</tr>-->

</template>

<script>
    export default {
        props: [
            'meal'
        ],
    }
</script>