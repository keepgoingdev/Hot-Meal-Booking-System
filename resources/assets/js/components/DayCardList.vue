<template>
    <div class="col-lg-12 col-xs-12" style="margin-top: 30px;">
        <div v-for="(weekday, index) in weekdays" class="col-xs-12 col-sm-4 col-lg-2" id="box-card">
            <div class="card" style="cursor:pointer" v-bind:class="{'card-selected': index == dayOfWeek}" @click="updateCurrentDate(index)">

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
        props:[
            'startingDate',
            'dayOfWeek'
        ],
        data: function () {
            return {
                days: ['Sunday', 'Monday',
                    'Tuesday', 'Wednesday', 'Thursday',
                    'Friday','Saturday'],
                months : [
                    "January", "February", "March",
                    "April", "May", "June", "July",
                    "August", "September", "October",
                    "November", "December"],
                weekdays:[]
            }
        },
        mounted(){
          this.setWeekdays();
        },
        watch:{
            startingDate(){
                this.setWeekdays();
            }
        },
        methods: {
            setWeekdays(){
                this.weekdays = [];
                for(let index = 0; index<7; index++){
                    let date = new Date(this.startingDate.getTime());
                    date.setDate(date.getDate() + index);

                    this.weekdays.push({
                        'dayName': this.days[date.getDay()],
                        'day': date.getDate(),
                        'month': this.months[date.getMonth()],
                        'year': date.getFullYear()});
                }
            },
            updateCurrentDate(index){
                this.$emit('set-current-date', index);
            }
        }
    }
</script>
