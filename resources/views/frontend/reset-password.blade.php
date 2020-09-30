@extends('frontend.layouts.master')
@section('styling')
<style>
.demoInputBox{padding:7px; border:#F0F0F0 1px solid; border-radius:4px;}
#password-strength-status {padding: 1px 7px;color: #FFFFFF; border-radius:4px;margin-top:5px;}
.medium-password{background-color: #E4DB11;border:#BBB418 1px solid;}
.weak-password{background-color: #FF6600;border:#AA4502 1px solid;}
.strong-password{background-color: #12CC1A;border:#0FA015 1px solid;}
#message {padding: 1px 7px;color: #FFFFFF; border-radius:4px;margin-top:5px;}
</style>
@endsection
@section('content')
<div class="container">
	<div class="row justify-content-center mt-5 mb-8">
		<!-- <div class="text-center w-100 mt-4">
			<img src="{{asset('frontend-assets/images/logo.jpg')}}" style="width:13%">
		</div> -->
		<!-- <div class="col-md-4 col-xs-12 mt-5 mb-5">
			<div class="px-3 my-3">
				<a href="" class="btn btn-facebook btn-block facebook text-left mb-4 py-2 text-white"><i class="fab fa-facebook pr-2"></i> Find us on Facebook</a>
				<a href="" class="btn btn-instagram btn-block facebook text-left mb-4 py-2 text-white"><i class="fab fa-instagram pr-2"></i> Find us on Instagram</a>
				<a href="" class="btn btn-twitter btn-block facebook text-left mb-4 py-2 text-white"><i class="fab fa-twitter pr-2"></i> Find us on Twitter</a>
				<a href="" class="btn btn-linkedin btn-block facebook text-left mb-4 py-2 text-white"><i class="fab fa-linkedin pr-2"></i> Find us on Linkdin</a>
				<a href="" class="btn btn-youtube btn-block facebook text-left mb-4 py-2 text-white"><i class="fab fa-youtube pr-2"></i> Find us on Youtube</a>
			</div>
		</div> -->
		<div class="col-md-5 col-xs-12 mt-5 mb-5 shadow rounded">
			<h3 class="text-uppercase mb-3 mt-3 text-center">Reset Password</h3>
			@if(Session::has('verify'))
			<div class="alert alert-success">
				{{ Session::get('verify') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
			@if(Session::has('resetAlert'))
			<div class="alert alert-danger">
				{{ Session::get('resetAlert') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
			@if ($errors->any())
			<div class="alert alert-danger">
				 <ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
				 </ul>
			</div>
			@endif
			@if(Session::has('resetSuccess'))
			<div class="alert alert-success">
				 {{ Session::get('resetSuccess') }}
				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				 <span aria-hidden="true">&times;</span>
				 </button>
			</div>
			@endif
			<div class="login-form pb-5">
				<form class="form-horizontal" method="POST" action="{{ url('/reset-password') }}">
						{{ csrf_field() }}
						<input type="hidden" name="user_id" value="{{$user->id}}">
							<div class="form-group">
									<input type="password" class="form-control" name="password" id="password" placeholder="Enter password"  onKeyUp="checkPasswordStrength();" /><div id="password-strength-status"></div>
							</div>
				  		<div class="form-group">
				  			<input type="password" class="form-control" placeholder="Enter confirm password" name="confirm_password" id="confirm_password" onkeyup='check();' autocomplete="off" required>
				  			<div id='message'></div>
							</div>
						<button type="submit" class="btn btn-green" id="Signup" disabled>Submit</button>
				</form>

			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
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
