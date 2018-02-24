@extends('layouts.app')
@section('content')
@include('layouts.navbar')
<div class="container">
    <div id="grocery-list-client">
        <grocery-list></grocery-list>
    </div>
</div>
<script>
    window.weekPlanId = '{{$weekPlanId}}';

</script>

<script src="{{ URL::asset('js/GroceryListClient.js')}}"></script>

@endsection