<nav class="[ navbar-bootsnipp-index animate ] hidden-print" role="navigation">
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
                <a class="[ navbar-brand ][ animate ]" href="/home"><img src="/img/logo.png" alt=""
                                                                     class="img-responsive"></a>
            </div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="[ collapse navbar-collapse ]" id="bs-example-navbar-collapse-1">
            <ul class="[ nav navbar-nav navbar-right ]">
                @guest
                    <li><a href="{{route('step-one')}}" class="btn btn-default" id="btn-trial-nav">GET STARTED</a></li>
                    <li><a href="{{route('login')}}" class="btn btn-default" id="btn-login-nav">LOGIN</a></li>
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
                                        Dashboard
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