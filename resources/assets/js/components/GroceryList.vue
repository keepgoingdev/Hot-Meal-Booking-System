<template>
    <div>
        <div class="col-lg-12 hidden-print" id="box-show-steps-caption">
            <h3 class="text-center">View Your Grocery List For The Week</h3>
        </div>
        <div class="col-lg-12 col-xs-12 col-sm-12 hidden-print" id="box-menu-profile" style="padding-bottom: 5px">
            <div class="col-lg-3">
                <div class="text-left">
                    <!--<a href="#" class="btn btn-default" id="btn-edit">Edit <i class="fa fa-pencil-square-o"></i></a>-->
                    <span @click="goBack" class="btn btn-default" id="btn-print">Back To Dashboard</span>
                </div>
            </div>
            <div class="col-lg-3  col-lg-offset-6">
                <div class="box-btn-edit-print">
                    <!--<a href="#" class="btn btn-default" id="btn-edit">Edit <i class="fa fa-pencil-square-o"></i></a>-->
                    <span @click="printTable" class="btn btn-default" id="btn-print">Print <i class="fa fa-print"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12" id="box-meal-profile" style="margin-top: 0px;">
            <div class="col-lg-12 col-xs-12">
                <div class="box-detail-meal">
                    <div class="panel panel-default">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead id="thead-food-item">
                                <tr>
                                    <th class="hidden-print" colspan="2">FOOD ITEM</th>
                                    <th class="hidden">FOOD ITEM</th>
                                    <th class="text-center">TOTAL SERVINGS</th>
                                    <th class="text-center">SERVING SIZE</th>
                                    <th class="text-center hidden-print">STORE</th>
                                </tr>
                                </thead>
                                <tbody v-for="item in listItems">
                                    <grocery-list-item :item="item"></grocery-list-item>
                                </tbody>
                            </table>
                        </div>
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
    const GroceryListItem = require('../components/GroceryListItem.vue');
    export default {
        components: {
            'grocery-list-item': GroceryListItem
        },
        data() {
            return {
                listItems: []
            }
        },
        mounted() {
            this.getGroceryList();
        },
        methods: {
            getGroceryList() {
                let url = '/intapi/grocery-list/'+window.weekPlanId;
                ApiUtil.fetchFromApi(url, {}).then((listItems) => {
                    this.listItems = listItems;
                });
            },
            goBack() {
                window.location = '/home';
            },
            printTable() {
//                var pageTitle = 'Page Title',
//                    stylesheet = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css',
//                    win = window.open('', 'Print', 'width=1024,height=1024');
//                win.document.write('<html><head><title>Grocery List</title>' +
//                    '<link rel="stylesheet" href="' + stylesheet + '">' +
//                    '</head><body>' + $('.table')[0].innerHTML + '</body></html>');
//                win.document.close();
                window.print();
//                win.close();
//                return false;
            }
        }
    }
</script>
