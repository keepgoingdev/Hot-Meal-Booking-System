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
                    <h2>Congratulations {{$first_name}}!</h2>
                    <h1>Account Created</h1>
                </div>
                <div class="bg-main-account">
                    <div class="textbox-main-account">
                        <p>Congratulations! Your account has been succesfully created. Just click this button below to confirm your email address.</p>
                        @component('mail::button', ['url' => route('confirmation', $token)])
                            Confirm your email
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Subcopy --}}
        @slot('subcopy')
            @component('mail::subcopy')
                <div>
                    <p>Get it touch if you have any questions regarding our new product. Feel free to contact us. We are here to help.</p>
                    <br>
                    <p>All the best, Team</p>
                    <a href="mailto:hello@thehotmeal.com" class="send-us-message text-center">Send us a message</a>
                </div>
            @endcomponent
        @endslot
    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} thehotmeal.com
        @endcomponent
    @endslot
@endcomponent
