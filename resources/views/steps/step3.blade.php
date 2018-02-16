@extends('layouts.app')
@section('content')
    <script>window.calorieGoal = '{{$calorieGoal}}'</script>
    <div class="header-hotmeal">
        <img src="img/logo.png" alt="" class="img-responsive">
    </div>
    <div class="container" id="container-profile">
        <div class="col-lg-12 hidden-xs" id="box-steps">
            <ul class="steps">
                <li class="step step--complete">
                    <span class="step__icon"></span>
                    <span class="step__label">Step 1</span>
                </li>
                <li class="step step--complete">
                    <span class="step__icon"></span>
                    <span class="step__label">Step 2</span>
                </li>
                <li class="step step--incomplete  step--active">
                    <span class="step__icon"></span>
                    <span class="step__label">Step 3</span>
                </li>
                <li class="step step--incomplete step--inactive">
                    <span class="step__icon"></span>
                    <span class="step__label">Step 4</span>
                </li>
            </ul>
        </div>
        <div class="col-lg-12" id="box-show-steps-caption">
            <h3 class="text-center">Step 3: Set Your First Week's Menu</h3>
        </div>
        <div id="meal-client">
            <meal-view></meal-view>
        </div>
        <script src="{{ URL::asset('js/MealClient.js')}}"></script>
@endsection
