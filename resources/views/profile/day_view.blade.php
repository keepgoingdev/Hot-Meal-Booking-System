@extends('layouts.app')
@extends('layouts.navbar')

@section('content')
    <div class="container" id="container-profile">
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-user-profile">
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <h2>Hi, {{$user->first_name}}!</h2>
                <h5>Daily Calorie Goal: {{$user->calorie_goal}} per day</h5>
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <p class="date-profile">Today's Date : {{$date}}</p>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-menu-profile">
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <h5>Today's Menu</h5>
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <a href="/grocery-list" class="btn btn-default" id="btn-list">View this Week's Grocery List <i class="fa fa-server"></i></a>
            </div>
            <div id="day-view-client">
            </div>
        </div>
    </div>

    <script src="{{ URL::asset('js/DayViewClient.js')}}"></script>
@endsection