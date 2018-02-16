@extends('layouts.app')
@section('content')
    <div class="container-fluid" id="container-bg">
        <div class="container">
            <nav class="[ navbar-bootsnipp-index animate ]" role="navigation">
                <div class="[ container ]">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="[ navbar-header ]">
                        <button type="button" class="[ navbar-toggle ]" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1">
                            <span class="[ sr-only ]">Toggle navigation</span>
                            <span class="[ icon-bar ]"></span>
                            <span class="[ icon-bar ]"></span>
                            <span class="[ icon-bar ]"></span>
                        </button>
                        <div class="[ animbrand ]">
                            <a class="[ navbar-brand ][ animate ]" href="/"><img src="img/logo.png" alt=""
                                                                                 class="img-responsive"></a>
                        </div>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="[ collapse navbar-collapse ]" id="bs-example-navbar-collapse-1">
                        <ul class="[ nav navbar-nav navbar-right ]">
                            @guest
                                <li><a href="{{route('step-one')}}" class="btn btn-default" id="btn-trial-nav">GET
                                        STARTED</a></li>
                                <li><a href="{{route('login')}}" class="btn btn-default" id="btn-login-nav">LOGIN</a>
                                </li>
                                @else
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                           aria-expanded="false">
                                            {{Auth::user()->first_name}}
                                            <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{ route('my-profile') }}">
                                                    Profile
                                                </a>
                                                <a href="{{ route('account-settings') }}">
                                                    Account settings
                                                </a>
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    Logout
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                      style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                    @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="bg-index-caption">
                <h1>Too many confusing diets?</h1>
                <h4>Stick with our meal plan, inspired by TRADER JOE'S</h4>
            </div>
            <div class="box-middle-bg">
                <div class="middle-bg">
                    <label for="">I want to eat</label>
                    <input id="calorie-goal" type="number" class="form-control" placeholder="1500">
                    <p>Calories</p>
                    <a href="step-one">
                        <button id="generate" class="btn btn-default">GENERATE</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="container-whyitworks">
        <div class="col-lg-12 col-sm-12">
            <h1 class="text-whyitworks">How it works</h1>
        </div>
        <div class="col-lg-offset-1 col-xs-offset-2 col-sm-offset-1 col-md-offset-1 col-lg-10 col-xs-9 col-sm-9 col-md-11"
             id="box-whyitworks-bot">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="col-lg-6 col-xs-12 col-sm-12 col-md-6" id="box-services">
                        <div class="col-lg-2 col-xs-12 col-sm-2">
                            <i class="fa fa-bell-o fa-2x"></i>
                        </div>
                        <div class="col-lg-10 col-xs-12 col-sm-10">
                            <h4 class="font-bold color-light-black">Set a daily calorie goal</h4>
                            <p class="font-size-17 color-gray">Set daily goals for your successful diet. Little to zero
                                exercise needed.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12 col-sm-12 col-md-6" id="box-services">
                        <div class="col-lg-2 col-xs-12 col-sm-2">
                            <i class="fa fa-calendar fa-2x"></i>
                        </div>
                        <div class="col-lg-10 col-xs-12 col-sm-10">
                            <h4 class="font-bold color-light-black">Generate a plan, just for you</h4>
                            <p class="font-size-17 color-gray">We'll generate a grocery list & meal plan <br
                                        class="hidden-md"> for you.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12 col-sm-12 col-md-6" id="box-services">
                        <div class="col-lg-2 col-xs-12 col-sm-2">
                            <i class="fa fa-shopping-cart fa-2x"></i>
                        </div>
                        <div class="col-lg-10 col-xs-12 col-sm-10">
                            <h4 class="font-bold color-light-black">Get your foods</h4>
                            <p class="font-size-17 color-gray">Take your list to your local <b>(Trader Joe's store)</b>
                                & get your foods.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12 col-sm-12 col-md-6" id="box-services">
                        <div class="col-lg-2 col-xs-12 col-sm-2">
                            <i class="fa fa-fire fa-2x"></i>
                        </div>
                        <div class="col-lg-10 col-xs-12 col-sm-10">
                            <h4 class="font-bold color-light-black">Rock the world</h4>
                            <p class="font-size-17 color-gray">Stick to the meal plan & your waist line <br
                                        class="hidden-md"> will thank you.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="mockup-absolute" class="img-responsive"></div>
        </div>
        <div class="col-xs-12">
            <div class="text-center">
                <a href="/step-one" class="btn btn-default" id="btn-letsgo">GET STARTED</a>
                <div class="mt-40"></div>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="fluid-grey">
        <div class="container ">
            <div class="col-lg-12">
                <h3>What They’re Saying About TheHotMeal.com</h3>
            </div>
            <div class="testimonials col-md-12">
                <div>
                    <div class="col-lg-12">
                        <img src="img/marjan.png" alt="" class="img-responsive" id="img-testimonials">
                    </div>
                    <div class="col-lg-12" id="testimonial-control">
                        <p>My eating choices are infinitely better now thanks to you guys. I lost 12 pounds!</p>
                        <h5>Marjan, NYC</h5>
                    </div>
                </div>
                <div>
                    <div class="col-lg-12">
                        <img src="img/jamie.jpg" alt="" class="img-responsive" id="img-testimonials">
                    </div>
                    <div class="col-lg-12" id="testimonial-control">
                        <p>Who knew I could lose 2 pounds in one week by going to my favorite grocery store on the
                            planet?</p>
                        <h5>Jamie, LA</h5>
                    </div>
                </div>
                <div>
                    <div class="col-lg-12">
                        <img src="img/julie.jpg" alt="" class="img-responsive" id="img-testimonials">
                    </div>
                    <div class="col-lg-12" id="testimonial-control">
                        <p>This is simple. I like simple. I also like that you put me on to 60-calorie ice cream at
                            Trader
                            Joe’s! Uhmmazing.” </p>
                        <h5>Julie W., Brooklyn</h5>
                    </div>
                </div>
                <div>
                    <div class="col-lg-12">
                        <img src="img/darren.jpg" alt="" class="img-responsive" id="img-testimonials">
                    </div>
                    <div class="col-lg-12" id="testimonial-control">
                        <p>I have an infinitely easier time eating good meals at work and at home, because of this
                            genius
                            thing you guys have got going here…</p>
                        <h5>Darren, Washington, D.C.</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="container-whyitworks">
        <div class="col-lg-offset-1 col-sm-offset-1 col-lg-10 col-sm-10" style="line-height: 2.2;">
            <h1 class="text-whyitworks">Why it works</h1>
            <div class="row color-gray">
                <div class="col-lg-offset-1 col-lg-6 col-md-7 col-xs-12 font-size-17 color-gray" style="text-align: left">
                    <p>If your body needs just 1,200 calories a day, and you're eating 3,000 calories a day, for
                        example, then you're eating 1,800 more calories than you need. Each day that you consume those
                        extra 1,800 calories a day, adds up over time, leaving you with a surplus of pounds. It takes
                        3,500 calories to make a pound, so for every time those 1,800 extra calories add up to 3,500,
                        you'll gain one pound.</p>
                </div>
                <div class="col-lg-4 col-md-5 hidden-sm hidden-xs">
                    <div class="box-green-whyitworks" style="margin-bottom: 30px">
                        <p><b>TheHotMeal.com</b> helps to reverse weight gain by helping you eat just the amount of
                            calories you need.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-offset-1 col-lg-10 font-size-17 color-gray">
                    <p>We don't get all confusing with it. Just use our platform to eat the 1,200 calories of healthy,
                        yummy, food that your body needs daily. SIMPLE. Where possible, exercise. Anything counts, from
                        jumping jacks to long walks to 15 minutes on the treadmill. No need to spend hours at the gym,
                        if you're eating correctly. Oh, and most of the Trader Joe's meals we recommend take minutes.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-offset-1 col-lg-10">
                    <img class="box-shadow" width="100%" style="margin-bottom: 80px;" src="/img/comparison.png"/>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="text-center" style="margin-bottom: 80px;">
                    <a href="/step-one" class="btn btn-default" id="btn-letsgo">GET STARTED</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.testimonials').on('init', function () {
                $('.testimonials').css({visibility: 'visible'});
            });

            $('.testimonials').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    lazyLoad: 'ondemand',
                    arrows: true,
                    dots: true,
                    infinite: false,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    speed: 300,
                    adaptiveHeight: false,
                }
            )
            ;
        });

    </script>
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <script type="text/javascript" src="slick/slick.min.js"></script>
@endsection
