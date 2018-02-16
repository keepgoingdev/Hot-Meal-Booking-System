@component('mail::message')
    <div class="container-fluid">
    <div class="container" id="container-account-created">
        <div class="box-account-created">
            <div class="bg-header-account">
                <img src="img/user.png" alt="" class="img-responsive">
                <h2>Congratulations {{$first_name}}!</h2>
                <h1>Account Created</h1>
            </div>
            <div class="bg-main-account">
                <div class="textbox-main-account">
                    <p>Congratulations! Your account has been succesfully created. Just follow this link below to confirm your email address and you will be able to continue shopping out publications in no time</p>
                    @component('mail::button', ['url' => route('confirmation', $token)])
                        Button Text
                    @endcomponent
                    <p>Get it touch if you have any questions regarding our new product. Feel free to contact us 24/7. We are here to help.</p>
                    <br><br>
                    <p>All the best, Team</p>
                    <a href="#" class="send-us-message text-center">Send us a message</a>
                </div>
            </div>
        </div>
        </div>
    </div>
@endcomponent
