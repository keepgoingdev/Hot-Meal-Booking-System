@extends('layouts.app')
@section('content')
    @extends('layouts.navbar')
    <div class="container">
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-user-profile">
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <h2>Hi, {{$user->first_name}}</h2>
                <h5>Daily Calorie Goal: {{$user->calorie_goal}} Calories per day</h5>
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <p class="date-profile">Today's Date : {{$date}}</p>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-menu-profile">
            <div class="col-lg-2 col-xs-12 col-sm-4 col-md-3">
                <h5>This Week's Menu</h5>
            </div>
            <div class="col-lg-3 col-xs-12 col-sm-4 col-md-3">
                <a href="/home/all-weeks" class="btn btn-block btn-default" id="btn-list-week">View All Weeks <i class="fa fa-info"></i></a>
            </div>
            <div class="col-lg-4 col-xs-12 col-sm-4 col-md-3">
                <a href="/grocery-list" class="btn btn-block btn-default" id="btn-list">View this Week's Grocery List <i
                            class="fa fa-server"></i></a>
            </div>
            <div class="col-lg-3 col-xs-12 col-sm-4 col-md-3">
                <a href="/add-new-week" class="btn  btn-block btn-default" id="btn-list-week">Add New Week <i class="fa fa-plus"></i></a>
            </div>
        </div>

        <!--CARD -->
        <div id="profile-client">
            <profile-view></profile-view>
        </div>


    </div>
    <script>
        window.startDate = new Date('{{$startDate}}');
        window.weekPlanId = '{{$weekPlanId}}';
        window.caloryGoal = '{{ Auth::user()->calorie_goal }}';
    </script>
    <script src="{{ URL::asset('js/ProfileClient.js?v3')}}"></script>

@endsection