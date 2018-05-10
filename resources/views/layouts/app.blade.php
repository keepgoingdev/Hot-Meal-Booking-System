<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-114111647-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-114111647-2');
    </script>
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
    <style>
    #bs-example-navbar-collapse-1 {
    margin-bottom: -50px;
    
    }
    .slick-next { 
    right: -5px !important;
    }
#box-user-profile {
padding-top: 0 !important;
margin-top: 50px
}
    </style>   
    <!-- Styles -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css?v2')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/steps.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/steps.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,400i,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</head>
<body>
<div id="app">
    @yield('layouts.header')
    @yield('content')
</div>
@include('layouts.footer')
<!-- Scripts -->
<script src="/js/bootstrap.js"></script>
    <script>
        $('#myModal').modal('show');

    </script>
    @if(config('app.env') !== 'local')
        <!-- Start of StatCounter Code for Default Guide -->
        <script type="text/javascript">
            var sc_project=11641315;
            var sc_invisible=1;
            var sc_security="8b437437";
        </script>
        <script type="text/javascript" src="https://www.statcounter.com/counter/counter.js" async></script>
        <noscript><div class="statcounter"><a title="Web Analytics Made Easy - StatCounter" href="http://statcounter.com/" target="_blank"><img class="statcounter" src="//c.statcounter.com/11641315/0/8b437437/1/" alt="Web Analytics Made Easy - StatCounter"></a></div></noscript>
        <!-- End of StatCounter Code for Default Guide -->
    @endif
@yield('braintree')
</body>
</html>
