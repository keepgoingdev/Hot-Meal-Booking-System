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
            <div class="col-lg-4 col-xs-12 col-sm-3 col-md-4">
                <h5>This Week's Menu</h5>
            </div>
            <div class="col-lg-5 col-xs-12 col-sm-5 col-md-5">
                <a href="/grocery-list" class="btn btn-default" id="btn-list">View this Week's Grocery List <i
                            class="fa fa-server"></i></a>
            </div>
            <div class="col-lg-3 col-xs-12 col-sm-4 col-md-3">
                <a href="#" class="btn btn-default" id="btn-list-week">Add New Week <i class="fa fa-plus"></i></a>
            </div>
        </div>

        <!--CARD -->
        <div id="profile-client">
            <profile-view></profile-view>
        </div>
                <!-- BUTTON BEFORE FOOTER -->
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-btn-footer">
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <a href="#" class="btn btn-success btn-block" id="btn-light-green"><i class="fa fa-plus"></i>Add Additional Foods Consumed</a>
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <a href="#" class="btn btn-success btn-block" id="btn-light-orange"><i class="fa fa-plus"></i>Add Exercise</a>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-btn-footer" style="margin-bottom: 20px">
            <div class="col-lg-4 col-xs-12 col-sm-4">
                <div class="supporting-text">
                    <h1>1,200</h1>
                    <p>Actual Consumed</p>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-sm-4">
                <div class="supporting-text">
                    <h1>1,100</h1>
                    <p>Daily Goal of calories</p>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-sm-4">
                <div class="supporting-text-green">
                    <p class="text-center">Congratulations, You consumed a healthy amount of calories that work with your weight goals.</p>
                </div>
            </div>

        </div>

    </div>
    <script>
        window.startDate = new Date('{{$startDate}}');
        window.weekPlanId = '{{$weekPlanId}}';
    </script>
    <script src="{{ URL::asset('js/ProfileClient.js')}}"></script>

@endsection