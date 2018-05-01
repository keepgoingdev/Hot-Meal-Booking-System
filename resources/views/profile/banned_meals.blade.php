@extends('layouts.app')
@section('content')
@include('layouts.navbar')
<style>
        .table > tbody > tr > td {
        vertical-align: middle;
    }</style>
<div class="container">
 <div>
        <div class="col-lg-12 hidden-print" id="box-show-steps-caption" style="margin-top: 50px;padding-top: 0">
            <h3 class="text-center">Banned Meals</h3>
            <h4 class="text-center">This list shows meals you have banned. They will not appear in your daily plans.</h4>
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
                                        <th class="text-center">MEAL</th>
                                        <th class="text-center hidden-sm hidden-xs">NAME</th> <th class="text-center hidden-sm hidden-xs"> SERVING SIZE</th>
                                        <th class="text-center hidden-sm hidden-xs">CALORIES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bannedMeals as $meal)
                                        <tr>
                                            <td class="text-center"><img src="{{ $meal->image }}" style="max-height:100px;display:inline-block;margin:0 auto" class="img img-responsive" alt="">
                                                <p class="visible-xs visible-sm">{{$meal->name}} </p>
                                                <p class="visible-xs visible-sm">{{$meal->serving_size}}</p>
                                                <p class="visible-xs visible-sm">{{$meal->calories}}</p>
                                            </td>


                                            <td class="text-center hidden-xs hidden-sm">{{$meal->name}}</td>
                                            <td class="text-center hidden-xs hidden-sm">{{$meal->serving_size}}</td>
                                            <td class="text-center hidden-xs hidden-sm">{{$meal->calories}}</td>
                                        </tr>
                                    @endforeach
                                 </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection