@extends('layouts.app')
@section('content')
@extends('layouts.navbar')
<div class="container">
    <div id="grocery-list-client">
        <grocery-list></grocery-list>
    </div>
</div>
<script src="{{ URL::asset('js/GroceryListClient.js')}}"></script>

@endsection