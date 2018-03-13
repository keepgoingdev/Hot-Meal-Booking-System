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
            <h3 class="text-center">Favorite Meals</h3>
            <h4 class="text-center">This list shows meals you have marked as your favorites. They will appear more frequently in your daily plans.</h4>
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
                                        <th class="text-center hidden-sm hidden-xs">FAVORITE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($favoriteMeals as $meal)
                                        <tr>
                                            <td class="text-center"><img src="{{ $meal->image }}" style="max-height:100px;display:inline-block;margin:0 auto" class="img img-responsive" alt="">
                                                <p class="visible-xs visible-sm">{{$meal->name}} </p>
                                                <p class="visible-xs visible-sm">{{$meal->serving_size}}</p>
                                                <p class="visible-xs visible-sm">{{$meal->calories}}</p>
                                                <p class="visible-xs visible-sm"><a class="togglemeal" href="/intapi/mark-meal-as-favorite/{{$meal->id}}"><i class="fa fa-2x fa-heart"></i></a></p>
                                            </td>


                                            <td class="text-center hidden-xs hidden-sm">{{$meal->name}}</td>
                                            <td class="text-center hidden-xs hidden-sm">{{$meal->serving_size}}</td>
                                            <td class="text-center hidden-xs hidden-sm">{{$meal->calories}}</td>
                                            <td class="text-center hidden-xs hidden-sm"><a class="togglemeal" href="/intapi/mark-meal-as-favorite/{{$meal->id}}"><i class="fa fa-2x fa-heart"></i></a></td>
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
<script>
	$('.togglemeal').click(function(e) {
	    e.preventDefault();
            var a = $(this);
            var link = a.attr('href');
            $.ajax({
                url: link,
                type: 'POST',
                dataType: 'JSON',
                
                success: function (d) {
                    var icon = a.find('i');
                    if(icon.hasClass('fa-heart-o')) {
                        icon.removeClass('fa-heart-o').addClass('fa-heart');
                    } else if (icon.hasClass('fa-heart')) {
                    	icon.removeClass('fa-heart').addClass('fa-heart-o');
                    }
                    
                },
                error: function (d) {
                    console.log('error');
                }
            });
	
	
	
	});
</script>
@endsection