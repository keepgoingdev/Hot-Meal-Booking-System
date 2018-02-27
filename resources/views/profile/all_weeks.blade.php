@extends('layouts.app')
@section('content')
    @extends('layouts.navbar')
    <div class="container">
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-user-profile">
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <h2>Hi, {{Auth::user()->first_name}}</h2>
                <h5>Here are all your weekly plans.</h5>
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-6 text-right">
                <a class="btn box-form-btn-green" style="margin-top: 15px;margin-bottom: 10px" href="/home">Back To Dashboard</a>
                <p class="">Today's Date : {{date('d F Y')}}</p>
            </div>
        </div>

        <div class="col-md-12" id="box-menu-profile"><div class="alert alert-info">Net Calories is the sum of calories you’ve eaten minus the sum of calories you’ve burned.</div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>View</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Weight</th>
                        <th>Goal</th>
                        <th>Net Calories</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = count($allweeks) @endphp
                    @foreach($allweeks as $week)
                        @php
                        $ate = 0;
                        $days = \App\DailyAdditional::where('week_plan_id', $week->id)->get();
                        foreach($days as $d) {
                            $ate += $d->getCalculatedCals();
                        }
                        @endphp
                        <tr>
                            <td><a href="/home/{{$week->id}}">View Week #{{$i--}}</a></td>
                            <td>{{date('m/d/Y', strtotime($week->start_date))}}</td>
                            <td>{{date('m/d/Y', strtotime($week->end_date))}}</td>
                            <td>{{$week->weight}}</td>
                            <td>{{$week->calory_goal*7}}</td>

                            <td>{{ $ate }}</td>
                            <td style="vertical-align: middle">
                                @php $diff = $week->calory_goal*7 - $ate @endphp
                                @if($diff > 0)
                                    <div class="label label-success">You were {{$diff}} calories under the limit. </div>
                                @elseif ($diff = 0)
                                    <div class="label label-success">You matched your weekly goal perfectly. </div> @else
                                    <div class="label label-danger">You were {{$diff}} calories over the limit. </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



    </div>

    <script src="{{ URL::asset('js/ProfileClient.js')}}"></script>

@endsection