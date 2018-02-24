@extends('layouts.app')
@section('content')
    <script>window.calorieGoal = '{{$calorieGoal}}'</script>
    <div class="header-hotmeal">
        <a href="/"><img src="img/logo.png" alt="" class="img-responsive"></a>
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
        <div class="col-lg-4 col-lg-offset-4" id="box-show-steps-caption">
            <h3 class="text-center">Step 3: We're generating your weekly plan!</h3>
            <a id="proceed" class="btn btn-default btn-block  btn-lg box-form-btn-green" href="/register" disabled="">Generating</a>
        </div>
        <div id="meal-client" style="display: none">
            <meal-view></meal-view>
        </div>

        <script src="{{ URL::asset('js/MealClient.js')}}"></script>
@endsection
