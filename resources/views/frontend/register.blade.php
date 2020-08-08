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
.demoInputBox{padding:7px; border:#F0F0F0 1px solid; border-radius:4px;}
#password-strength-status {padding: 1px 7px;color: #FFFFFF; border-radius:4px;margin-top:5px;}
.medium-password{background-color: #E4DB11;border:#BBB418 1px solid;}
.weak-password{background-color: #FF6600;border:#AA4502 1px solid;}
.strong-password{background-color: #12CC1A;border:#0FA015 1px solid;}
#message {padding: 1px 7px;color: #FFFFFF; border-radius:4px;margin-top:5px;}

</style>
<link href="{{ asset('frontend-assets/css/themify-icons.css') }}" rel="stylesheet"/>
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
					<h5 class="text-uppercase mb-3 mt-4">Self Registration</h5>
				  <div class="form-group">
				  	<div class="row">
				  		<div class="col-md-6">
				  			<label>First Name (Parent/Adult)</label>
				  			<input type="text" class="form-control" placeholder="Enter First Name" id="first_name" name="first_name" required>
				  		</div>
				  		<div class="col-md-6">
				  			<label>Last Name (Parent/Adult)</label>
				  			<input type="text" class="form-control" placeholder="Enter Last Name" id="last_name" name="last_name" required>
				  		</div>
				  	</div>
				  </div>

				  <div class="form-group">
				  	<label>Parent/Adult Email</label>
				    <input type="email" class="form-control" placeholder="Enter Email" id="email" name="email" required>
				  </div>
					<div class="form-group">
						<label>Home Address</label>
						<input type="text" class="form-control" placeholder="Enter Home Address" id="address" name="address" required>
					</div>
					<div class="form-group">
				  	<label>City</label>
						<input type="text" name="city" class="form-control" placeholder="Enter City" id="city" required>
					</div>
					<div class="form-group">
						<label>State</label>
						<select class="form-control" name="state">
							<option value="Alabama">Alabama</option>
							<option value="Alaska">Alaska</option>
							<option value="Arizona">Arizona</option>
							<option value="Arkansas">Arkansas</option>
							<option value="California">California</option>
							<option value="Colorado">Colorado</option>
							<option value=" Connecticut"> Connecticut</option>
							<option value="Delaware">Delaware</option>
							<option value="Florida">Florida</option>
							<option value=" Georgia"> Georgia</option>
							<option value="Hawaii">Hawaii</option>
							<option value="Idaho">Idaho</option>
							<option value="Illinois">Illinois</option>
							<option value="Indiana">Indiana</option>
							<option value="Iowa">Iowa</option>
							<option value="Kansas">Kansas</option>
							<option value="Kentucky">Kentucky</option>
							<option value="Louisiana">Louisiana</option>
							<option value="Maine">Maine</option>
							<option value="Maryland">Maryland</option>
							<option value="Massachusetts">Massachusetts</option>
							<option value="Michigan">Michigan</option>
							<option value="Minnesota">Minnesota</option>
							<option value="Mississippi">Mississippi</option>
							<option value="Missouri">Missouri</option>
							<option value="Montana">Montana</option>
							<option value="Nebraska">Nebraska</option>
							<option value="Nevada">Nevada</option>
							<option value="New Hampshire">New Hampshire</option>
							<option value="New Jersey">New Jersey</option>
							<option value="New Mexico">New Mexico</option>
							<option value="New York">New York</option>
							<option value="North Carolina">North Carolina</option>
							<option value="North Dakota">North Dakota</option>
							<option value="Ohio">Ohio</option>
							<option value="Oklahoma">Oklahoma</option>
							<option value="Oregon">Oregon</option>
							<option value="Pennsylvania">Pennsylvania</option>
							<option value="Rhode Island">Rhode Island</option>
							<option value="South Carolina">South Carolina</option>
							<option value="South Dakota">South Dakota</option>
							<option value="Tennessee">Tennessee</option>
							<option value="Texas">Texas</option>
							<option value="Utah">Utah</option>
							<option value="Vermont">Vermont</option>
							<option value="Virginia">Virginia</option>
							<option value="Washington">Washington</option>
							<option value="West Virginia">West Virginia</option>
							<option value="Wisconsin">Wisconsin</option>
							<option value="Wyoming">Wyoming</option>
						</select>
					</div>
					<div class="form-group">
						<label>Zip Code</label>
						<input type="text" name="zip" class="form-control" placeholder="Enter Zip Code" id="zip" required>
					</div>
					<div class="form-group">
						<label>Time Zone</label>
						<select class="form-control" name="time_zone">
							<option value="Pacific Time">Pacific Time</option>
							<option value="Mountain Time">Mountain Time</option>
							<option value="Central Time">Central Time</option>
							<option value="Eastern Time">Eastern Time</option>
						</select>
					</div>
				  <div class="form-group">
				  	<div class="row">
							<div class="col-md-6">
									<label>Password:</label>
									<input type="password" class="demoInputBox form-control" name="password" id="password" placeholder="Enter password"  onKeyUp="checkPasswordStrength();" /><div id="password-strength-status"></div>
							</div>

				  		<div class="col-md-6">
				  			<label>Confirm Password</label>
				  			<input type="password" class="form-control" placeholder="Enter confirm password" id="confirm_password" onkeyup='check();' autocomplete="off" required>
				  			<div id='message'></div>
							</div>
				  	</div>
				  </div>
				  <div class="form-group">
				  	<label>Phone Number</label>
				    <!-- <input type="tel"  class="form-control" placeholder="Enter phone number" id="phone_number" name="phone" required> -->
				    <input type="tel"  class="form-control" placeholder="Enter phone number" id="" name="phone" required>
				  </div>
				  <div class="form-group">
						<label>Student Name</label>
						<input type="text" class="form-control" placeholder="Enter Student Name" id="student_name" name="student_name" required>
					</div>
					<div class="form-group">
						<label>Student Grade/Level</label>
						<input type="text" class="form-control" placeholder="Enter Grade/Level" id="grade" name="grade" required>
					</div>
					<div class="form-group">
						<label>Student School/College</label>
						<input type="text" class="form-control" placeholder="Enter School/College" id="college" name="college" required>
					</div>
					<div class="form-group">
						<label>Student Email</label>
						<input type="text" class="form-control" placeholder="Enter Student Email" id="student_email" name="student_email">
					</div>
					<div class="form-group">
						<label>Student Tutoring Subject</label>
						<input type="text" class="form-control" placeholder="Enter Tutoring Subject" id="subject" name="subject" required>
					</div>
						<div class="form-group">
						<label>Student Tutoring Goals</label>
						<textarea name="goal" class="form-control" placeholder="Tell us a little about what you want to get out of tutoring!"></textarea>
					</div>
					<div class="form-group">
						<div class="captcha">
							<span>{!! captcha_img('math') !!}</span>
							<button type="button" class="btn btn-success btn-refresh btn-sm" style="padding: 0.5rem 0.75rem;"><i class="ti-loop"></i></button>
						</div>
				  	<label>Captcha</label>
				    <input type="text"  class="form-control" placeholder="Enter Captcha" id="captcha" name="captcha">
				  </div>
				  <!-- <div class="form-group form-check">
				    <label class="form-check-label">
				      <input class="form-check-input" type="checkbox" id="terms" required> I agree to <a href="">terms & conditions</a>
				    </label>
				  </div> -->
				  <button type="submit" class="btn btn-green" id="Signup" disabled>Signup</button>
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
function checkPasswordStrength() {
	var number = /([0-9])/;
	var alphabets = /([a-zA-Z])/;
	// var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
	if($('#password').val().length<=6) {
		$('#password-strength-status').removeClass();
		$('#password-strength-status').addClass('weak-password');
		$('#password-strength-status').html("Weak (6 characters or more, with at least 1 letter and one number.)");
		$(':input[type="submit"]').prop('disabled', true);
		check();
	} else {
		if($('#password').val().match(number) && $('#password').val().match(alphabets)) {
			$('#password-strength-status').removeClass();
			$('#password-strength-status').addClass('strong-password');
			$('#password-strength-status').html("Strong");
			check();
		} else {
			$('#password-strength-status').removeClass();
			$('#password-strength-status').addClass('medium-password');
			$('#password-strength-status').html("Medium (should include alphabets, numbers)");
			$(':input[type="submit"]').prop('disabled', true);
			check();
		}
	}
}

var check = function()
{
	if (document.getElementById('password').value ==
	document.getElementById('confirm_password').value) {
		$('#message').removeClass();
		$('#message').addClass('strong-password');
		document.getElementById('message').innerHTML = 'Password Match';
		var number = /([0-9])/;
		var alphabets = /([a-zA-Z])/;
		if($('#password').val().match(number) && $('#password').val().match(alphabets)) {
			$(':input[type="submit"]').prop('disabled', false);
		}else {
			$(':input[type="submit"]').prop('disabled', true);
		}
	} else {
		$('#message').removeClass();
		$('#message').addClass('weak-password');
		document.getElementById('message').innerHTML = 'Passwords do not match';
		$(':input[type="submit"]').prop('disabled', true);
	}
}
</script>
@endsection
