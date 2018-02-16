@extends('layouts.app')
@section('content')
    <div class="header-hotmeal">
        <img src="img/logo.png" alt="" class="img-responsive">
    </div>
    <div class="container" id="container-profile">
        <div id="grocery-list-client">
            <grocery-list></grocery-list>
        </div>
    </div>
    <script src="{{ URL::asset('js/GroceryListClient.js')}}"></script>
@endsection
