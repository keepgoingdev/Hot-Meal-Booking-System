@extends('layouts.app')
@section('content')
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
                <li class="step step--incomplete step--active">
                    <span class="step__icon"></span>
                    <span class="step__label">Step 2</span>
                </li>
                <li class="step step--incomplete step--inactive">
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
            <h3 class="text-center">Step 2: Calculate Your Daily Calorie Goal</h3>
        </div>
        <div class="col-lg-12" id="box-data-calculate">
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="box-form-step-two">
                        <form role="form" class="form-horizontal" name="calculate" method="POST"
                              action="{{ route('generate') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="{{ $errors->has('lose') ? ' has-error' : '' }}">
                                        <label for="gender">What is your goal?</label>
                                        <select class="form-control" name="lose" id="lose-select">
                                            <option value="null"> Select</option>
                                            <option value="-2" {{ old("lose") === '-2' ? "selected":"" }}>Lose 2 pounds per week</option>
                                            <option value="-1.5" {{ old("lose") === '-1.5' ? "selected":"" }}>Lose 1.5 pounds per week</option>
                                            <option value="-1" {{ old("lose") === '-1' ? "selected":"" }}>Lose 1 pound per week</option>
                                            <option value="-0.5" {{ old("lose") === '-0.5' ? "selected":"" }}>Lose 0.5 pounds per week</option>
                                            <option value="0" {{ old("lose") === '-0.5' ? "selected":"" }}>Maintain weight</option>
                                            <option value="0.5" {{ old("lose") === '0.5' ? "selected":"" }}>Gain 0.5 pounds per week</option>
                                            <option value="1" {{ old("lose") === '1' ? "selected":"" }}>Gain 1 pounds per week</option>
                                            <option value="1.5" {{ old("lose") === '1.5' ? "selected":"" }}>Gain 1.5 pounds per week</option>
                                            <option value="2" {{ old("lose") === '2' ? "selected":"" }}>Gain 2 pounds per week</option>
 
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <label for="exampleInputEmail1">Calories Goal</label>
                            <div class="input-group">
                                <input id="calorie-goal" disabled type="number" class="form-control"
                                       aria-describedby="basic-addon2" @if($calorieGoal) value="{{$calorieGoal}}"
                                       @else  placeholder="1,900" @endif>
                                <span class="input-group-addon" id="basic-addon2">Calories A Day</span>
                            </div>
                            <div>
                                <span style="font-style: italic">For safe weight loss, the National Institutes of Health recommends no less than 1000-1200 calories for women and 1200-1500 calories for men. We recommend all members first consult with their doctor or nutritionist before joining The Hot Meal. We also allow members to customize their goals based on these recommendations. However, The Hot Meal default settings will not recommend a plan for any member that falls under the recommended minimum number of calories.</span>
                                <br>
                                <br>
                            </div>
                            <span class="btn btn-default btn-block btn-lg box-form-btn-green" id="box-form-btn-green">Calculate</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.startingGoal = {{$calorieGoal}};
        window.gender = '{{$gender}}';
        $(document).ready(function () {
            $("#box-form-btn-green").click(storeCalorieGoal);

            $("#lose-select").change(function(){
                var lose = $('#lose-select').val();
                var subtract = 0;
                console.log(lose);
                switch(lose) {

                    case '-2':
                        subtract = 1000;
                        break;
                    case '-1.5':
                        subtract = 750;
                        break;
                    case '-1':
                        subtract = 500;
                        break;
                    case '-0.5':
                        subtract = 250;
                        break;
                    case '0':
                        subtract = 0;
                        break;
                    case '0.5':
                        subtract = -250;
                        break;
                    case '1':
                        subtract = -500;
                        break;
                    case '1.5':
                        subtract = -750;
                        break;
                    case '2':
                        subtract = -1000;
                        break;
                    default:
                        subtract = 0;
                        break;
                }
                var calories = window.startingGoal - subtract;
                if(window.gender === 'F' && calories < 1000){
                    calories = 1000;
                }
                if(window.gender === 'M' && calories < 1200){
                    calories = 1200;
                }
                $('#calorie-goal').val(calories);
            });

            function storeCalorieGoal() {
                var goal = $('#calorie-goal').val();
                if (goal === '') {
                    goal = $('#calorie-goal').attr('placeholder');
                }
                if (goal > 0) {
                    $.ajax({
                        type: "POST",
                        url: "api/calorie-goal",
                        data: {'goal': goal}
                    })
                        .done(function (msg) {
                            window.location.href = '/step-three';
                        });
                }
                else {
                    alert('Goal needs to be larger than 0')
                }
            }
        })
    </script>
@endsection
