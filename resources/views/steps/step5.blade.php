@extends('layouts.app')
@section('content')
    <div class="header-hotmeal">
        <a href="/"><img src="img/logo.png" alt="" class="img-responsive"></a>
    </div>
    <div class="container" id="container-profile">
        <div class="col-lg-12 hidden-xs" id="box-steps">
            <ul class="steps">
                <li class="step step--complete">
                    <span class="step__icon"></span>
                    <span class="step__label">Step 1</span>
                </li>
                <li class="step step--complete">
                    <span class="step__icon"></span>
                    <span class="step__label">Step 2</span>
                </li>
                <li class="step step--complete">
                    <span class="step__icon"></span>
                    <span class="step__label">Step 3</span>
                </li>
                <li class="step step--complete">
                    <span class="step__icon"></span>
                    <span class="step__label">Step 4</span>
                </li>
            </ul>
        </div>
        <div class="col-lg-12" id="box-show-steps-caption">
            <h3 class="text-center">Almost Done! Save Your Info : Create Account</h3>
        </div>
        <div class="col-lg-12" id="box-data-calculate">
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="box-form-step-two">
                        @if($status = Session::get('status'))
                            <div class="alert alert-info">
                                <ul>
                                    @foreach(json_decode($status, true) as $message)
                                        <li>{{$message[0]}}</li>
                                    @endforeach
                                </ul>

                            </div>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}" autocomplete="off">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-lg-6 col-sm-6 col-md-6{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="first-name">First Name</label>
                                    <input id="first-name" type="text" class="form-control" name="first-name"
                                           value="{{ old('first-name') }}" required autofocus>

                                    @if ($errors->has('first-name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first-name') }}</strong>
                                    </span>
                                    @endif                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="last-name">Last Name</label>
                                    <input id="last-name" type="text" class="form-control" name="last-name"
                                           value="{{ old('last-name') }}" required autofocus>

                                    @if ($errors->has('last-name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last-name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6 col-sm-6 col-md-6{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email">Email address</label>
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="email">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" value=""
                                           required autofocus>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: -10px">
                                <div class="col-lg-6 col-sm-6 col-md-6{{ $errors->has('coupon') ? ' has-error' : '' }}">
                                    <label for="coupon">Coupon</label>
                                    <div class="input-group">
                                        <input id="coupon" type="text" class="form-control" name="coupon" value="">
                                        <span id="validate-coupon"
                                              class="input-group-addon btn btn-primary">Refresh</span>
                                        <input style="display:none; visibility: hidden" id="coupon-validation"
                                               type="text" class="form-control" name="coupon-validation" value="">
                                    </div>
                                    @if ($errors->has('coupon'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('coupon') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6">
                                    <br class="hidden-xs">
                                    <span id="discount-message" style="font-weight: bold"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12 col-sm-12 col-md-12{{ $errors->has('plan') ? ' has-error' : '' }}">
                                    <div class="input-group">
                                        <label for="coupon">Select your subscription</label>
                                        <select class="form-control" name="plan" id="plan">
                                            @foreach($plans as $plan)
                                                @if(!$plan->is_discount)
                                                    <option price="{{$plan->cost}}"
                                                            value="{{$plan->id}}">{{$plan->name}} -
                                                        ${{$plan->cost}} USD
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div id="dropin-container"></div>
                                <h3 class="hidden" id="total-cost" style="font-weight: bold">Total cost:
                                    ${{$plans->where('is_discount', false)->first()->cost}}</h3>
                                <button id="payment-button"
                                        class="btn btn-default btn-block btn-lg hidden box-form-btn-green"
                                        type="submit">Payment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#validate-coupon").click(validateCoupon);
            $("#plan").change(updateTotalCost);

            function validateCoupon() {
                var discountMessage = $('#discount-message');
                var coupon = $('#coupon').val();
                if (coupon == '') {
                    discountMessage.text('');
                }
                else {
                    $.ajax({
                        type: "get",
                        url: "/intapi/validate-coupon",
                        data: {'coupon-code': coupon}
                    })
                        .done(function (data) {
                            if (!data) {
                                discountMessage.text('Invalid coupon code');
                                return;
                            }
                            $('#plan option').each(function () {
                                $(this).remove();
                            });
                            var discount = data['discount'];
                            var plan = data['planId'];
                            var planName = data['planName'];
                            var price = data['price'];

                            $('#plan').append($('<option/>', {
                                value: plan,
                                text: planName + ' -  $' + price + ' USD',
                                price: price
                            }));

                            $('#coupon-validation').val(plan);
                            discountMessage.text('$' + price + ' USD' + ' - ' + planName);
                            $('#total-cost').text('Total cost: $' + price);
                        })
                }
            }

            function updateTotalCost() {
                var price = $('option:selected', this).attr('price');
                $('#total-cost').text('Total cost: $' + price);
            }
        })
    </script>
@endsection

@section('braintree')
    <script src="https://js.braintreegateway.com/js/braintree-2.30.0.min.js"></script>

    <script>
        $.ajax({
            url: '{{ url('braintree/token') }}'
        }).done(function (response) {
            braintree.setup(response.data.token, 'dropin', {
                container: 'dropin-container',
                onReady: function () {
                    $('#total-cost').removeClass('hidden');
                    $('#payment-button').removeClass('hidden');
                }
            });
        });
    </script>
@endsection