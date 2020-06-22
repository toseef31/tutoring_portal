@extends('frontend.layouts.master')
@section('styling')

<link rel="stylesheet" type="text/css" href="{{asset('frontend-assets/telphone_input/build/css/intlTelInput.css')}}">
<style>
	.iti{
		display: block;
	}
	.intl-tel-input .flag-dropdown .selected-flag {
    margin: 10px 6px;
    padding: 6px 16px 6px 6px;
	}
	.intl-tel-input input{
		padding-left: 47px !important;
	}
</style>
@endsection
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 col-xs-12">
		  @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
             @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
             @endforeach
          </ul>
        </div>
      @endif
			<div class="signup-form mb-5 mt-5">
				<form action="{{ url('/register') }}" method="post">
				{{ csrf_field() }}
					<h5 class="text-uppercase mb-3 mt-4">Create Account</h5>
				  <div class="form-group">
				  	<div class="row">
				  		<div class="col-md-6">
				  			<label>First Name</label>
				  			<input type="text" class="form-control" placeholder="Enter firstname" id="first_name" name="first_name">
				  		</div>
				  		<div class="col-md-6">
				  			<label>Last Name</label>
				  			<input type="text" class="form-control" placeholder="Enter lastname" id="last_name" name="last_name">
				  		</div>
				  	</div>
				  </div>

				  <div class="form-group">
				  	<label>Email</label>
				    <input type="email" class="form-control" placeholder="Enter email" id="email" name="email">
				  </div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" class="form-control" placeholder="Enter Address" id="address" name="address">
					</div>
				  <div class="form-group">
				  	<div class="row">

				  		<div class="col-md-6">
				  			<label>Password</label>
				  			<input type="password" class="form-control" placeholder="Enter password" id="password" name="password" autocomplete="off">
				  		</div>

				  		<div class="col-md-6">
				  			<label>Confirm Password</label>
				  			<input type="password" class="form-control" placeholder="Enter confirm password" id="confirm_password" onkeyup='check();' autocomplete="off">
				  			<span id='message'></span>
							</div>
				  	</div>
				  </div>
				  <div class="form-group">
				  	<label>Phone Number</label>
				    <input type="tel"  class="form-control" placeholder="Enter phone number" id="phone_number" name="phone">
				  </div>
					<div class="form-group">
						<div class="captcha">
							<span>{!! captcha_img('math') !!}</span>
							<button type="button" class="btn btn-success btn-refresh">Refresh</button>
						</div>
				  	<label>Captcha</label>
				    <input type="text"  class="form-control" placeholder="Enter Captcha" id="captcha" name="captcha">
				  </div>
				  <div class="form-group form-check">
				    <label class="form-check-label">
				      <input class="form-check-input" type="checkbox" id="terms" required> I agree to <a href="">terms & conditions</a>
				    </label>
				  </div>
				  <button type="submit" class="btn btn-danger" id="Signup" disabled>Signup</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="{{asset('frontend-assets/telphone_input/build/js/intlTelInput.js') }}"></script>
<script>
$(document).on("click","#terms",function(){
        if($(this).prop("checked") == true){
        	$(':input[type="submit"]').prop('disabled', false);
        }
        else if($(this).prop("checked") == false){
        	$(':input[type="submit"]').prop('disabled', true);
        }
    });
   $("#phone_number").intlTelInput({
		 // initialCountry:"{ 'sg': 'Singapore' }",
		 initialCountry:"{ 'pk': 'Pakistan' }",
// localized country names e.g. { 'de': 'Deutschland' }

	 });
</script>
<script>

var check = function()
{
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Password Match';
		$(':input[type="submit"]').prop('disabled', false);
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Password not matching';
		$(':input[type="submit"]').prop('disabled', true);
  }
}
</script>
@endsection
