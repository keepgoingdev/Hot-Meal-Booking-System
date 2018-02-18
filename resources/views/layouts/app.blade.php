<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" type="image/ico" href="/favicon.ico"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>The Hot Meal</title>
    <!-- Scripts -->
    <script src="{{ URL::asset('js/jquery-3.3.1.min.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/steps.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/steps.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,400i,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<div id="app">
    @yield('layouts.header')
    @yield('content')
</div>
@extends('layouts.footer')
<!-- Scripts -->
<script src="/js/bootstrap.js"></script>
@yield('braintree')
</body>
</html>
