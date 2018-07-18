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
                        @if($error = Session::get('error'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{$error}}</li>
                                </ul>
                            </div>
                        @endif
                        <form class="form-horizontal dropin-container" id="dropin-container" method="POST"
                              action="{{ route('register') }}" autocomplete="off">
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
                                <div class="col-lg-6 col-sm-6 col-md-6{{ $errors->has('email_confirmation') ? ' has-error' : '' }}">
                                    <label for="email-confirm">Confirm Email address</label>
                                    <input id="email-confirm" type="email" class="form-control" name="email_confirmation"
                                           value="{{ old('email_confirmation') }}" required autofocus>

                                    @if ($errors->has('email_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12 col-sm-12 col-md-12{{ $errors->has('password') ? ' has-error' : '' }}">
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
                            <div id="card-errors"></div>
                            <div class="form-group">
                                <div class="col-lg-7 col-sm-7 col-md-7">
                                    <label for="example2-card-number">Credit card info</label>
                                    {{--<input type="email" class="form-control" id="exampleInputEmail1">--}}
                                    <div id="example2-card-number"></div>
                                </div>
                                <div class="col-lg-5 col-sm-5 col-md-5">
                                    <div class="box-credit-card">
                                        <img src="/img/visa.png" alt="" class="img-responsive">
                                        <img src="/img/master.png" alt="" class="img-responsive">
                                        <img src="/img/master2.png" alt="" class="img-responsive">
                                        {{--<img src="/img/paypal.png" alt="" class="img-responsive">--}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-4 col-sm-12">
                                    <label for="example2-card-expiry">Exp</label>
                                    <div id="example2-card-expiry"></div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <label for="example2-card-cvc">CVC</label>
                                    <div id="example2-card-cvc"></div>
                                </div>
                                <div class="col-lg-4 col-sm-12 {{ $errors->has('coupon') ? ' has-error' : '' }}">
                                    <label for="coupon">Coupon</label>
                                    <div class="input-group">
                                        <input id="coupon" type="text" class="form-control" name="coupon" value="">
                                        <span id="validate-coupon"
                                              class="input-group-addon btn btn-primary"><i
                                                    class="fa fa-check"></i> </span>
                                        <input style="display:none; visibility: hidden" id="coupon-validation"
                                               type="text" class="form-control" name="coupon-validation" value="">
                                    </div>
                                    @if ($errors->has('coupon'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('coupon') }}</strong>
                                    </span>
                                    @endif
                                    {{--<br class="hidden-xs">--}}
                                    <span id="discount-message" style="font-weight: bold"></span>
                                </div>
                            </div>
                            @if($thehotmealPlans)
                                <div class="form-group plans">
                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1">Choose subscription</label>
                                    <input type="hidden" name="plan" id="plan-input" value="{{$selectedPlan}}">
                                </div>
                                @foreach($thehotmealPlans as $k=>$plan)
                                    <?php
                                    if ($k == 0) {
                                        $id = '';
                                    } elseif ($k == 1) {
                                        $id = '-two';
                                    } elseif ($k == 2) {
                                        $id = '-two';
                                    }
                                    ?>
                                    <div class="col-lg-3 col-sm-6 col-md-3 plan-btn-wrapper">
                                        <a href="javascript:;"
                                           onclick="selectPlan({{$plan->id}})"
                                           class="btn btn-default plan_selector plan_selector_{{$plan->id}}"
                                           id="btn-subscribe{{$id}}">
                                            <div class="plan-cost">${{$plan->cost/ $plan->month}}/mo.</div>
                                            @if($k != 0)
                                                <p>${{($plan->cost)}} total for {{$plan->month}} months <br>
                                                    (save {{floor($plan->getSavingPercent($thehotmealPlans->first()->cost))}}
                                                    %)</p>
                                            @endif
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                            {{--<div class="form-group">
                                <div class="col-lg-12">
                                    --}}{{--<p>First month is free! 100% Money-Back Guarantee.</p>--}}{{--
                                    --}}{{--<p>Refunds Processed By Request for Any Months not used.</p>--}}{{--
                                </div>
                            </div>--}}
                            <button type="submit" class="btn btn-default btn-block btn-lg box-form-btn-green"
                                    id="payment-button"
                                    disabled
                            >Payment
                            </button>

                            {{--<h3 class="hidden" id="total-cost" style="font-weight: bold">Total cost:
                                ${{$thehotmealPlans->where('is_discount', false)->first()->cost}}</h3>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .plan-selected {
            border-color: orange;
        }
    </style>
    <script>
      function selectPlan(planId) {
        $("#plan-input").val(planId);
        $(".plan_selector").removeClass('plan-selected');
        $(".plan_selector_" + planId).addClass('plan-selected');
      }
      selectPlan({{$selectedPlan}});

      $(document).ready(function () {
        $("#validate-coupon").click(validateCoupon);
        //$("#plan").change(updateTotalCost);

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
                selectPlan(plan);
                $(".plans").hide();
                //$('#total-cost').text('Total cost: $' + price);
              })
          }
        }

        /*function updateTotalCost() {
          var price = $('option:selected', this).attr('price');
          $('#total-cost').text('Total cost: $' + price);
        }*/
      })
    </script>
@endsection

@section('stripe')
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">
      var stripe = Stripe('{{config('services.stripe.key')}}');
      var elements = stripe.elements();
      var style = {
        base: {
          // Add your base input styles here. For example:
          fontSize: '16px',
          color: "#32325d",
        }
      };

      var cardNumber = elements.create('cardNumber', {
        classes: {
          'base': 'form-control'
        },
      });
      cardNumber.mount('#example2-card-number');


      var cardExpiry = elements.create('cardExpiry', {
        classes: {
          'base': 'form-control'
        },
      });
      cardExpiry.mount('#example2-card-expiry');

      var cardCvc = elements.create('cardCvc', {
        classes: {
          'base': 'form-control'
        },
      });
      cardCvc.mount('#example2-card-cvc');

      var elements = [
        'cardNumber',
        'cardCvc',
        'cardExpiry',
      ]
      // Create an instance of the card Element.
      //var card = elements.create(['cardNumber', 'cardExpiry', 'cardCvc'], {style: style});
      //console.log('card', card)
      // Add an instance of the card Element into the `card-element` <div>.
      //card.mount('#dropin-container');
      //console.log('card-mount', card)
      $('#total-cost').removeClass('hidden');

      cardNumber.addEventListener('change', function (event) {
          var $errorElement = $('#card-errors');
          if (event.error) $errorElement.html('<div class="alert alert-info">' + event.error.message + '</div>');
          if (event.empty == true || event.complete == false) {
              $('#payment-button').attr('disabled', 'disabled');
          } else {
              displayError.textContent = '';
              $('#payment-button').removeAttr('disabled');
          }
      });

      //Step 3: Create a token to securely transmit card information
      // Create a token or display an error when the form is submitted.
      var form = document.getElementById('dropin-container');
      form.addEventListener('submit', function (event) {
          event.preventDefault();

          stripe.createToken(cardNumber).then(function (result) {
              if (result.error) {
                  // Inform the customer that there was an error.
                  var $errorElement = $('#card-errors');
                  $errorElement.html('<div class="alert alert-info">' + result.error.message + '</div>');
              } else {
                  // Send the token to your server.
                  stripeTokenHandler(result.token);
              }
          });
      });

      //Step 4: Submit the token and the rest of your form to your server
      function stripeTokenHandler(token) {
        console.log('token', token)
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('dropin-container');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        console.log(form)
        // Submit the form
        form.submit();
      }
    </script>
@endsection
