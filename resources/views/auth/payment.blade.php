@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ '$plan->name' }}</div>
                    <div class="panel-body">
                        <form>
                            <div id="dropin-container"></div>
                            <hr>

                            <button id="payment-button" class="btn btn-primary btn-flat" type="submit">Pay now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    $('#payment-button').removeClass('hidden');
                }
            });
        });
    </script>
@endsection