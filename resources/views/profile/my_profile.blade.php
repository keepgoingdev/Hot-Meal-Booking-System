@extends('layouts.app')
@section('content')
    @include('layouts.navbar')
    <div class="container">
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-user-profile">
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <h2>Hi, {{$user->first_name}}</h2>
                <h5>Daily Calorie Goal: {{$weekPlan->calory_goal}} Calories per day</h5>
                <h5 style="color:#7FD220">Customer Service Representative - <b>Tara</b>. <br>Email -  <a style="color:#FB7E4F" href="mailto:tara@thehotmeal.com">tara@thehotmeal.com</a></h5>
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <p class="date-profile">Today's Date : {{$date}}</p>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12 col-sm-12" style="padding-top: 20px; z-index: 100;">
            <div class="col-lg-3 col-xs-12 col-sm-3 col-md-3">
                <a href="/fresh-picks" class="btn btn-block btn-default" id="btn-list-picks">Fresh Picks <i class="fa fa-leaf" style="color: #82c91e"></i></a>
            </div>
            <div class="col-lg-3 col-xs-12 col-sm-3 col-md-3">
                <a href="/favorite-meals" class="btn btn-block btn-default" id="btn-list-picks">Favorite Meals <i class="fa fa-heart" style="color: #82c91e"></i></a>
            </div>
            <div class="col-lg-3 col-xs-12 col-sm-3 col-md-3">
                <a href="/banned-meals" class="btn btn-block btn-default" id="btn-list-picks">Banned Meals <i class="fa fa-ban" style="color: #82c91e"></i></a>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-menu-profile" style="z-index: 100;">
            <div class="col-lg-2 col-xs-12 col-sm-4 col-md-3">
                <h5>This Week's Menu</h5>
            </div>
            <div class="col-lg-3 col-xs-12 col-sm-4 col-md-3">
                <a href="/home/all-weeks" class="btn btn-block btn-default" id="btn-list-week">View All Weeks <i class="fa fa-info"></i></a>
            </div>
            <div class="col-lg-4 col-xs-12 col-sm-4 col-md-3">
                <a href="{{ route('grocerylist', $weekPlanId) }}" class="btn btn-block btn-default" id="btn-list">View this Week's Grocery List <i
                            class="fa fa-server"></i></a>
            </div>
            <div class="col-lg-3 col-xs-12 col-sm-4 col-md-3">
                <a href="/add-new-week" class="btn  btn-block btn-default" id="btn-list-week">Add New Week <i class="fa fa-plus"></i></a>
            </div>
        </div>

        <!--CARD -->     @php
            $goal = Auth::user()->gender == 'M' ? 8400 : 7000;
        @endphp
        <div id="profile-client">
            <profile-view></profile-view>
        </div>
        <!-- Modal -->
        @if(Auth::user()->popup_shown == false)
            <?php
                Auth::user()->popup_shown = true;
            Auth::user()->save();

            ?>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Site Information</h4>
                    </div>
                    <div class="modal-body">
                        <p>Hey there {{ Auth::user()->first_name}}, <i class="fa fa-lightbulb"></i> <br>
                            Please don’t forget to mark each meal you’ve eaten! <br>
                            You must CHECK THE <b>COMPLETED</b> BOX next to every meal, to keep your goals accurate. <br><br>


                        The Hot Meal</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        @endif

    </div>

    <script>
        window.gender = '{{ Auth::user()->gender }}';
        window.startDate = '{{$startDate}}';
        window.weekPlanId = '{{$weekPlanId}}';
        window.caloryGoal = '{{ $weekPlan->calory_goal }}';
    </script>
    <script src="{{ URL::asset('js/ProfileClient.js?v6.0.1')}}"></script>

@endsection