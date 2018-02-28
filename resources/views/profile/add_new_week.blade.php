@extends('layouts.app')
@section('content')
    @extends('layouts.navbar')
    <div class="container">
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-user-profile">
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <h2>Hi, {{Auth::user()->first_name}}</h2>
                <h5>Let's add a new weekly plan!</h5>
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <p class="date-profile">Today's Date : {{date('d F Y')}}</p>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-3" id="box-menu-profile">
            <h5>To get started on your new weekly plan, please insert your new weight.</h5>
            <form action="/add-new-week" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" placeholder="Your current weight" name="weight" class="form-control">
                </div>

                <div class="form-group">                                        <select class="form-control" name="lose" id="lose-select">
                                            <option value="-1000" {{ old("lose") === '-2' ? "selected":"" }}>Lose 2 pounds per week</option>
                                            <option value="-750" {{ old("lose") === '-1.5' ? "selected":"" }}>Lose 1.5 pounds per week</option>
                                            <option value="-500" {{ old("lose") === '-1' ? "selected":"" }}>Lose 1 pound per week</option>
                                            <option value="-250" {{ old("lose") === '-0.5' ? "selected":"" }}>Lose 0.5 pounds per week</option>
                                            <option value="0" selected>Maintain weight</option>
                                            <option value="250" {{ old("lose") === '0.5' ? "selected":"" }}>Gain 0.5 pounds per week</option>
                                            <option value="500" {{ old("lose") === '1' ? "selected":"" }}>Gain 1 pounds per week</option>
                                            <option value="750" {{ old("lose") === '1.5' ? "selected":"" }}>Gain 1.5 pounds per week</option>
                                            <option value="1000" {{ old("lose") === '2' ? "selected":"" }}>Gain 2 pounds per week</option>

                                        </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control btn-md btn btn-success"  value="Get new weekly plan!">
                </div>
            </form>

        </div>



    </div>

    <script src="{{ URL::asset('js/ProfileClient.js')}}"></script>

@endsection