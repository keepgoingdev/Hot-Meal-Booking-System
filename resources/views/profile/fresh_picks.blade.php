@extends('layouts.app')
@section('content')
@include('layouts.navbar')

<div class="container">
 <div>
        <div class="col-lg-12 hidden-print" id="box-show-steps-caption" style="margin-top: 50px;padding-top: 0">
            <h3 class="text-center">Fresh Picks</h3>
            <h4 class="text-center">You may replace any frozen foods with these items. If you do, simple +ADD their calories to your daily sheet</h4>
        </div>
        <div class="col-lg-12 col-xs-12 col-sm-12 hidden-print" id="box-menu-profile" style="padding-bottom: 5px">
            <div class="col-lg-3">
                <div class="text-left">
                    <!--<a href="#" class="btn btn-default" id="btn-edit">Edit <i class="fa fa-pencil-square-o"></i></a>-->
                    <a href="/home" class="btn btn-default" id="btn-print">Back To Dashboard</a>
                </div>
            </div>
            <div class="col-lg-3  col-lg-offset-6">
                <div class="box-btn-edit-print">
                    <!--<a href="#" class="btn btn-default" id="btn-edit">Edit <i class="fa fa-pencil-square-o"></i></a>-->
                    <!--<span onclick="window.print()" class="btn btn-default" id="btn-print">Print <i class="fa fa-print"></i></span>-->
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12" id="box-meal-profile" style="margin-top: 0px;">
            <div class="col-lg-12 col-xs-12">
                <div class="box-detail-meal">
                    <div class="panel panel-default">
                        
                            <table class="table table-hover">
                                <thead id="thead-food-item">
                                    <tr>
                                        <th class="text-center">FRUIT</th>
                                        <th class="text-center">SERVING</th>
                                        <th class="text-center">CALORIES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Apple</h5></center></td>
                                        <td class="semi-top"><center><h5>1 large</h5></center></td>
                                        <td class="semi-top"><center><h5>130</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Avocado</h5></center></td>
                                        <td class="semi-top"><center><h5>30g</h5></center></td>
                                        <td class="semi-top"><center><h5>50</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Banana</h5></center></td>
                                        <td class="semi-top"><center><h5>1 medium</h5></center></td>
                                        <td class="semi-top"><center><h5>110</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Cantaloupe</h5></center></td>
                                        <td class="semi-top"><center><h5>1/4 medium</h5></center></td>
                                        <td class="semi-top"><center><h5>50</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Grapefruit</h5></center></td>
                                        <td class="semi-top"><center><h5>1/2 medium (154g)</h5></center></td>
                                        <td class="semi-top"><center><h5>60</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Grapes</h5></center></td>
                                        <td class="semi-top"><center><h5>3/4 cup</h5></center></td>
                                        <td class="semi-top"><center><h5>90</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Honeydew Melon</h5></center></td>
                                        <td class="semi-top"><center><h5>1/10 medium melon</h5></center></td>
                                        <td class="semi-top"><center><h5>50</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Kiwifruit</h5></center></td>
                                        <td class="semi-top"><center><h5>2 medium (148g)</h5></center></td>
                                        <td class="semi-top"><center><h5>90</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Lemon</h5></center></td>
                                        <td class="semi-top"><center><h5>1 medium</h5></center></td>
                                        <td class="semi-top"><center><h5>15</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Lime</h5></center></td>
                                        <td class="semi-top"><center><h5>1 medium (67g)</h5></center></td>
                                        <td class="semi-top"><center><h5>20</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Nectarine</h5></center></td>
                                        <td class="semi-top"><center><h5>1 medium (140g)</h5></center></td>
                                        <td class="semi-top"><center><h5>60</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Orange</h5></center></td>
                                        <td class="semi-top"><center><h5>1 medium (154g)</h5></center></td>
                                        <td class="semi-top"><center><h5>80</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Peach</h5></center></td>
                                        <td class="semi-top"><center><h5>1 medium (147g)</h5></center></td>
                                        <td class="semi-top"><center><h5>60</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Pear</h5></center></td>
                                        <td class="semi-top"><center><h5>1 medium (147g)</h5></center></td>
                                        <td class="semi-top"><center><h5>100</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Pineapple</h5></center></td>
                                        <td class="semi-top"><center><h5>2 slices (112g)</h5></center></td>
                                        <td class="semi-top"><center><h5>50</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Plums</h5></center></td>
                                        <td class="semi-top"><center><h5>2 medium (151g)</h5></center></td>
                                        <td class="semi-top"><center><h5>70</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Strawberries</h5></center></td>
                                        <td class="semi-top"><center><h5>8 medium (147g)</h5></center></td>
                                        <td class="semi-top"><center><h5>50</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Sweet Cherries</h5></center></td>
                                        <td class="semi-top"><center><h5>21 cherries; 1 cup</h5></center></td>
                                        <td class="semi-top"><center><h5>100</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Tangerine</h5></center></td>
                                        <td class="semi-top"><center><h5>1 medium (109g)</h5></center></td>
                                        <td class="semi-top"><center><h5>50</h5></center></td>
                                    </tr>
                                    <tr class="tr-detail-meals">
                                        <td class="semi-top"><center><h5>Watermelon</h5></center></td>
                                        <td class="semi-top"><center><h5>2 cups diced</h5></center></td>
                                        <td class="semi-top"><center><h5>80</h5></center></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    <div class="panel panel-default">

                        <table class="table table-hover">
                            <thead id="thead-food-item">
                            <tr>
                                <th class="text-center">VEGETABLE</th>
                                <th class="text-center">SERVING</th>
                                <th class="text-center">CALORIES</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="tr-detail-meals">
                                <td class="semi-top"><center><h5>Asparagus</h5></center></td>
                                <td class="semi-top"><center><h5>5 spears</h5></center></td>
                                <td class="semi-top"><center><h5>20</h5></center></td>
                            </tr>
                            <tr class="tr-detail-meals">
                                <td class="semi-top"><center><h5>Broccoli</h5></center></td>
                                <td class="semi-top"><center><h5>1 stalk</h5></center></td>
                                <td class="semi-top"><center><h5>45</h5></center></td>
                            </tr>
                            <tr class="tr-detail-meals">
                                <td class="semi-top"><center><h5>Carrot</h5></center></td>
                                <td class="semi-top"><center><h5>7" long</h5></center></td>
                                <td class="semi-top"><center><h5>30</h5></center></td>
                            </tr>
                            <tr class="tr-detail-meals">
                                <td class="semi-top"><center><h5>Cauliflower</h5></center></td>
                                <td class="semi-top"><center><h5>1/6 head</h5></center></td>
                                <td class="semi-top"><center><h5>25</h5></center></td>
                            </tr>
                            <tr class="tr-detail-meals">
                                <td class="semi-top"><center><h5>Celery</h5></center></td>
                                <td class="semi-top"><center><h5>2 stalks</h5></center></td>
                                <td class="semi-top"><center><h5>15</h5></center></td>
                            </tr>
                            <tr class="tr-detail-meals">
                                <td class="semi-top"><center><h5>Cucumber</h5></center></td>
                                <td class="semi-top"><center><h5>1/3 med</h5></center></td>
                                <td class="semi-top"><center><h5>10</h5></center></td>
                            </tr>
                            <tr class="tr-detail-meals">
                                <td class="semi-top"><center><h5>Green Beans</h5></center></td>
                                <td class="semi-top"><center><h5>3/4 cup</h5></center></td>
                                <td class="semi-top"><center><h5>20</h5></center></td>
                            </tr>
                            <tr class="tr-detail-meals">
                                <td class="semi-top"><center><h5>Green Cabbage</h5></center></td>
                                <td class="semi-top"><center><h5>1 1/2 head</h5></center></td>
                                <td class="semi-top"><center><h5>25</h5></center></td>
                            </tr>
                            <tr class="tr-detail-meals">
                                <td class="semi-top"><center><h5>Iceberg Lettuce</h5></center></td>
                                <td class="semi-top"><center><h5>1/6 head</h5></center></td>
                                <td class="semi-top"><center><h5>10</h5></center></td>
                            </tr>
                            <tr class="tr-detail-meals">
                                <td class="semi-top"><center><h5>Leaf Lettuce</h5></center></td>
                                <td class="semi-top"><center><h5>1.5 cups</h5></center></td>
                                <td class="semi-top"><center><h5>15</h5></center></td>
                            </tr>
                            <tr class="tr-detail-meals">
                                <td class="semi-top"><center><h5>Potato</h5></center></td>
                                <td class="semi-top"><center><h5>1 medium</h5></center></td>
                                <td class="semi-top"><center><h5>110</h5></center></td>
                            </tr>
                            <tr class="tr-detail-meals">
                                <td class="semi-top"><center><h5>Radishes</h5></center></td>
                                <td class="semi-top"><center><h5>7 radish</h5></center></td>
                                <td class="semi-top"><center><h5>10</h5></center></td>
                            </tr>
                            <tr class="tr-detail-meals">
                                <td class="semi-top"><center><h5>Summer Squash</h5></center></td>
                                <td class="semi-top"><center><h5>1/2 med</h5></center></td>
                                <td class="semi-top"><center><h5>20</h5></center></td>
                            </tr>
                            <tr class="tr-detail-meals">
                                <td class="semi-top"><center><h5>Sweet Corn</h5></center></td>
                                <td class="semi-top"><center><h5>1 med ear</h5></center></td>
                                <td class="semi-top"><center><h5>90</h5></center></td>
                            </tr>
                            <tr class="tr-detail-meals">
                                <td class="semi-top"><center><h5>1 med</h5></center></td>
                                <td class="semi-top"><center><h5>5 spears</h5></center></td>
                                <td class="semi-top"><center><h5>100</h5></center></td>
                            </tr>
                            <tr class="tr-detail-meals">
                                <td class="semi-top"><center><h5>Tomato</h5></center></td>
                                <td class="semi-top"><center><h5>1 med</h5></center></td>
                                <td class="semi-top"><center><h5>25</h5></center></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection