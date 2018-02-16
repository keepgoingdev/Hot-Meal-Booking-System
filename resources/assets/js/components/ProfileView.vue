<template>
    <div class="col-lg-12 col-xs-12" style="margin-top: 30px;">
        <div v-for="(weekday, index) in weekdays" class="col-xs-12 col-sm-4 col-lg-2" id="box-card">
            <div class="card" style="cursor:pointer" v-bind:class="{'card-selected': index == dayOfWeek}" @click="updateCurrentDate(index)">
                <div class="card-read-more">
                </div>
                <div class="card-content">
                    <h4 class="card-title">
                        {{weekday.dayName}}
                    </h4>
                    <p class="text-center">
                        {{weekday.month}}, {{weekday.day}}'{{weekday.year}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


    export default {
        data: function () {
            return {

            }
        },
        mounted() {
        },
        methods: {

        }
    }
</script>
