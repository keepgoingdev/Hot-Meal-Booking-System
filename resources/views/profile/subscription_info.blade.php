@extends('layouts.app')
@section('content')
@extends('layouts.navbar')
    <div class="container" id="container-profile">
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-user-profile">
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <h2>Subscription info</h2>
            </div>
            <div class="col-lg-12">
                @if($isGrace)
                    <label>Valid to: </label><span>{{$subscription->paidThroughDate->format('d F Y')}}</span>
                @else
                    <label>Next billing: </label><span>{{$subscription->nextBillingDate->format('d F Y')}}</span>
                @endif
                @if(!$isGrace)
                    <br>
                    <a href="api/cancel-subscription">Cancel subscription</a>
                @endif
            </div>
        </div>
    </div>
@endsection