@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => 'thehotmeal.com'])
            thehotmeal.com
        @endcomponent
    @endslot
    {{-- Body --}}
    <div class="container-fluid">
        <div class="container" id="container-account-created">
            <div class="box-account-created">
                <div class="bg-header-account">
                    <h2>Contact Received</h2>
                </div>
                <div class="bg-main-account">
                    <div class="textbox-main-account">
                        <p>We received a contact form submission. Below are the details.</p>
          		<b>From: </b> 
          		<br> {{ $firstname }} {{ $lastname }} <br />
          		{{$email }} / {{ $phone }} <br />
          		<b>About: </b> <br />
          		{{ $issue }}<br />
          		<b>Message: </b> <br />
          		{{ $message }}<br />
                    </div>
                </div>
            </div>
        </div>
    </div>

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} thehotmeal.com
        @endcomponent
    @endslot
@endcomponent
