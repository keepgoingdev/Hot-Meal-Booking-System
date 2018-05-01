@extends('layouts.app')
@section('content')
@include('layouts.navbar')

<div class="container">
 <div>
        <div class="col-lg-12 hidden-print" id="box-show-steps-caption" style="margin-top: 50px;padding-top: 0">
            <h3 class="text-center">View Your Grocery List For The Week</h3>
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
                                    
                                    
                                    <th class="hidden-print">FOOD ITEM</th>
                                    <th class="hidden-xs hidden-sm">FOOD ITEM</th>
                                    <th class="text-center hidden-xs hidden-sm">TOTAL SERVINGS</th>
                                    <th class="text-center hidden-xs hidden-sm">SERVING SIZE</th>
                                    <th class="text-center hidden-print hidden-xs hidden-sm">STORE</th>
                                </tr>
                                </thead>
                              
                                @foreach($groceryList as $item)
                                 
				                                 <tr class="tr-detail-meals">

				            <td class="td-meal-image hidden-print"><img
				                    src="{{$item->image}}" style="margin: 0px auto;display:block" 
				                    alt="" class="img-responsive">
				                    <center><h5 class="visible-xs visible-sm">{{$item->name}}</h5></center>
				                    <center><h5 class="visible-xs visible-sm"><b>Total Servings: </b>{{$count[$item->id]}}</h5></center>
				                    <center><h5 class="visible-xs visible-sm"><b>Serving Size: </b>{{$item->serving_size}}</h5></center>
				                    <center><h5 class="visible-xs visible-sm"><b>Store: </b>Trader Joe's</h5></center>
				                    </td>
				            <td class="semi-top hidden-xs hidden-sm">
				                <center><h5>{{$item->name}}</h5></center>
				            </td>
				            <td class="semi-top hidden-xs hidden-sm">
				                <center><h5>{{$count[$item->id]}}</h5></center>
				            </td>
				            <td class="semi-top hidden-xs hidden-sm">
				                <center><h5>{{$item->serving_size}}</h5></center>
				            </td>
				            <td class="semi-top hidden-print hidden-xs hidden-sm">
				                <center><h5>Trader Joe's</h5></center>
				            </td>
				        </tr>
				       @endforeach
                            </table>
                        </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>


@endsection