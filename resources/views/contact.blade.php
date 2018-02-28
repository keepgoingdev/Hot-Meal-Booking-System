@extends('layouts.app')
@section('content')
    <div class="header-hotmeal">
        <a href="/"><img src="img/logo.png" alt="" class="img-responsive"></a>
    </div>
    <div class="container" id="container-profile">

        <div class="col-lg-12" id="box-show-steps-caption">
            <h3 class="text-center">Contact</h3>
        </div>
        <div class="row">
                           
	   <div class="col-lg-5">
	    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
	        <form method="POST" action="#" class="form-horizontal">
	        {{ csrf_field() }}
	        <div class="form-group">
		        <label>First Name</label>
		        <input type="text" class="form-control" name="firstname" placeholder="First Name" />
	        </div>
	        <div class="form-group">
		        <label>Last Name</label>
		        <input type="text" class="form-control" name="lastname" placeholder="Last Name" />
	        </div>        
	        <div class="form-group">
		        <label>Email</label>
		        <input type="text" class="form-control" name="email" placeholder="Email Address" />
	        </div>    
	        <div class="form-group">
		        <label>Phone</label>
		        <input type="text" class="form-control" name="phone" placeholder="Phone" />
	        </div>
	        <div class="form-group">
		        <label>Issue</label>
		        <select class="form-control" name="issue">
		        	<option value="Account Management">Account Management</option>
		        	<option value="Meal Plan Question">Meal Plan Question</option>
		        	<option value="Something is not working">Something isn't working</option>
		        	<option value="Other">Other</option>
		        </select>       	
	        </div>
	        <div class="form-group">
	           <label>Message</label>
	           <textarea class="form-control" rows=5 name="message"></textarea>
	        </div>
	        <div class="form-group">
	        	<input type="submit" class="form-control btn btn-success" value="Send" />
	        </div>
        </div>
        <div class="col-lg-7" style="padding:40px">
        		<div>
			<span class="">For corporate inquiries, please send an initial message to <a href="mailto:hello@thehotmeal.com">hello@thehotmeal.com</a>, and your email will be routed from there.</span></div>
		<div>
			&nbsp;</div>
		<div>
			<span class="">For customer support, please contact <a href="mailto:hello@thehotmeal.com">hello@thehotmeal.com</a>, and include your account information and query.</span></div>
		<div>
			&nbsp;</div>
		<div>
			<span class="">For personalized support, please log in and check for your Site Advisor&rsquo;s name at the top of your dashboard.</span></div>
		<div>
			&nbsp;</div>
		<div>
			<span class="">Email support is available Monday through Friday, 9am to 6pm Pacific. We do our best to issue an immediate response and facilitate speedy processes for any specific issue to resolve.&nbsp;</span></div>
		<div>
			&nbsp;</div>
		<div>
			<span class=""><i>5405 Wilshire Blvd, Los Angeles, CA 90036</i></span></div>
        </div>
        </div>
    </div>
    </div>
@endsection
