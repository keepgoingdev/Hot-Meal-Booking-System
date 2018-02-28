@extends('layouts.app')
@section('content')
    @extends('layouts.navbar')
    <div class="container">
        <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-user-profile">
            <div class="col-xs-6">
                <h2>Hi, {{Auth::user()->first_name}}</h2>
                <h5>Here are all your weekly plans.</h5>
            </div>
            <div class="col-xs-6 text-right">
                <a class="btn box-form-btn-green" style="margin-top: 15px;margin-bottom: 10px" href="/home">Back To Dashboard</a>
                <p class="">Today's Date : {{date('d F Y')}}</p>
            </div>
        </div>
        </div>

        <div class="col-md-12" id="box-menu-profile">
        <div class="clear-both">
        <div class="row">
        <div class="alert alert-info">Net Calories is the sum of calories you’ve eaten minus the sum of calories you’ve burned.</div>
        </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>View</th>
                        <th class="hidden-sm hidden-xs">Start Date</th>
                        <th class="hidden-sm hidden-xs" >End Date</th>
                        <th class="hidden-sm hidden-xs" >Weight</th>
                        <th class="hidden-sm hidden-xs" >Goal</th>
                        <th class="hidden-sm hidden-xs" >Net Calories</th>
                        <th class="hidden-sm hidden-xs" >Result</th>
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
                            <td>
                            <a href="/home/{{$week->id}}">View Week #{{$i--}}</a> 
                            <p  class="visible-sm visible-xs" >
                     
                     		<b> Start Date: </b> {{date('m/d/Y', strtotime($week->start_date))}} <br />
                            
                     		<b> End Date: </b> {{date('m/d/Y', strtotime($week->end_date))}} <br />
                            
                            	<b> Weight: </b> {{ $week->weight }} <br />
                            <b> Calory Goal: </b> {{ $week->calory_goal*7}} <br />
                            <b> Net calories:  </b> {{ $ate }} <br />
                                                            @php $diff = $week->calory_goal*7 - $ate @endphp
                                @if($diff > 0)
                                    <div class="visible-sm visible-xs label label-success">You were {{$diff}} calories under the limit. </div>
                                @elseif ($diff = 0)
                                    <div class="visible-sm visible-xs label label-success">You matched your weekly goal perfectly. </div> @else
                                    <div class="visible-sm visible-xs label label-danger">You were {{$diff}} calories over the limit. </div>
                                @endif
                                </p>
                                
                            
                            </td>
                            <td class="hidden-sm hidden-xs" >{{date('m/d/Y', strtotime($week->start_date))}}</td>
                            <td class="hidden-sm hidden-xs" >{{date('m/d/Y', strtotime($week->end_date))}}</td>
                            <td class="hidden-sm hidden-xs" >{{$week->weight}}</td>
                            <td class="hidden-sm hidden-xs" >{{$week->calory_goal*7}}</td>

                            <td class="hidden-sm hidden-xs" >{{ $ate }}</td>
                            <td  class="hidden-sm hidden-xs" style="vertical-align: middle">
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