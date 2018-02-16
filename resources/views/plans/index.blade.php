
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Choose your plan</div>
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach ($plans as $plan)
                                <li class="list-group-item clearfix">
                                    <div class="pull-left">
                                        <h4>{{ $plan->name }}</h4>
                                        <h4>${{ number_format($plan->cost, 2) }} monthly</h4>
                                        @if ($plan->description)
                                            <p>{{ $plan->description }}</p>
                                        @endif
                                    </div>

                                    <a href="#" class="btn btn-default pull-right">Choose Plan</a>

                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
