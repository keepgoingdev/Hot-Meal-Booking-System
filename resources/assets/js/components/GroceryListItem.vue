<template>
        <tr class="tr-detail-meals">
            <td class="td-meal-image hidden-print"><img
                    :src="item.meal.image"
                    alt="" class="img-responsive"></td>
            <td class="semi-top">
                <center><h5>{{item.meal.name}}</h5></center>
            </td>
            <td class="semi-top">
                <center><h5>{{item.quantity}}</h5></center>
            </td>
            <td class="semi-top">
                <center><h5>{{item.meal.serving_size}}</h5></center>
            </td>
            <td class="semi-top hidden-print">
                <center><a href="#"><img src="img/tj.png" alt="" class="img-responsive"
                                         id="img-store"></a></center>
            </td>
        </tr>
</template>

<script>
    export default {
        props:[
            'item'
        ],
    }
</script>
