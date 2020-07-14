@extends('frontend.dashboard.layout.master')

@section('title', 'My Profile')

@section('styling')
<style>
/* .demoInputBox{padding:7px; border:#F0F0F0 1px solid; border-radius:4px;} */
#password-strength-status {padding: 1px 7px;color: #FFFFFF; border-radius:4px;margin-top:5px;}
.medium-password{background-color: #E4DB11;border:#BBB418 1px solid;}
.weak-password{background-color: #FF6600;border:#AA4502 1px solid;}
.strong-password{background-color: #12CC1A;border:#0FA015 1px solid;}
#message {padding: 1px 7px;color: #FFFFFF; border-radius:4px;margin-top:5px;}

</style>
@endsection
@section('content')

@include('frontend.dashboard.menu.menu')
<?php
$userImage = url('frontend-assets/images/user.jpg');
if($user->image != ''){

	$userImage = url('frontend-assets/images/dashboard/profile-photos/'.$user->image);

}

?>
<div class="main-panel">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar bar1"></span>
					<span class="icon-bar bar2"></span>
					<span class="icon-bar bar3"></span>
				</button>
				<a class="navbar-brand" href="#">Profile Management</a>
			</div>

		</div>
	</nav>


	<div class="content">
		<div class="container-fluid app-view-mainCol">
			<div class="row">
				<div class="col-lg-4 col-md-5 app-view-mainCol">
					<div class="cards cards-user">
						<div class="image">
							<!-- <img src="{{asset('frontend-assets/images/background.jpg')}}" alt="..."> -->
						</div>
						<div class="content">
							<div class="author">
								<div class="re-img-box">
									<img class="avatar border-white" src="{{$userImage}}" alt="...">
									<div class="re-img-toolkit">
										<div class="re-file-btn">
											Change <i class="fa fa-camera"></i>
											<input type="file" class="upload" id="imageFile"  name="image"  onchange="uploadpicture(this)">
										</div>

									</div>
								</div>

								<h4 class="title" id="userName">{{ucfirst($user->first_name)}}<br>

								</h4>
							</div>

						</div>
						<hr>
						<div class="text-center">
							<div class="row">

							</div>
						</div>
					</div>

				</div>
				<div class="col-lg-8 col-md-7 app-view-mainCol">
					<div class="cards">
						<div class="header">
							<h3 class="title">Edit Profile</h3>
							<hr>
						</div>
						<div class="content">
							<form class="form-horizontals profile-form" action="" method="post">
								{{ csrf_field() }}
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>First Name</label>
											<input type="text" class="form-controls border-input"  name="first_name" value="{{ $user->first_name}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Last Name</label>
											<input type="text" class="form-controls border-input" name="last_name" value="{{ $user->last_name}}">
										</div>
									</div>
								</div>
								<!-- <div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Address</label>
											<input type="text" class="form-control border-input" placeholder="Enter Address" id="address" name="address" value="{{ $user->address}}">
										</div>
									</div>
								</div> -->
                <div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Email</label>
											<input type="email" class="form-controls border-input" disabled="" placeholder="Enter email" value="{{ $user->email}}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Phone Number</label>
											<input type="text" name="phone" class="form-controls border-input"  placeholder="Phone Number"  value="{{ $user->phone}}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Blurb</label>
											<textarea name="description" class="form-control" rows="3" cols="30">{{$user->description}}</textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Time Zone</label>
											<select class="form-control border-input" name="time_zone" id="time_zone">
												<option value="Pacific Time" {{$user->time_zone == 'Pacific Time' ? 'selected=="selected"':''}}>Pacific Time</option>
												<option value="Mountain Time" {{$user->time_zone == 'Mountain Time' ? 'selected=="selected"':''}}>Mountain Time</option>
												<option value="Central Time" {{$user->time_zone == 'Central Time' ? 'selected=="selected"':''}}>Central Time</option>
												<option value="Eastern Time" {{$user->time_zone == 'Eastern Time' ? 'selected=="selected"':''}}>Eastern Time</option>
											</select>
										</div>
									</div>
								</div>
								<!-- <div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Change Password</label>
											<input type="password" class="form-control border-input" placeholder="Enter password" id="password" name="password" autocomplete="off">
										</div>
									</div>
								</div> -->
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>Change Password</label>
											<input type="password" class="demoInputBox form-control border-input" name="password" id="password" placeholder="Enter password"  onKeyUp="checkPasswordStrength();" /><div id="password-strength-status"></div>
										</div>
										<div class="col-md-6">
							  			<label>Confirm Password</label>
							  			<input type="password" class="form-control" placeholder="Enter confirm password" id="confirm_password" onkeyup='check();' autocomplete="off">
							  			<div id='message'></div>
										</div>
									</div>
								</div>

								<!-- <div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Confirm Password</label>
											<input type="password" class="form-control border-input" placeholder="Enter confirm password" id="confirm_password" onkeyup='check();' autocomplete="off">
										</div>
									</div>
								</div> -->

								<div class="text-center">
									<button type="submit" class="btn btn-info btn-green btn-wd" id="submit-btn">Update Profile</button>
								</div>

								<div class="clearfix"></div>
							</form>
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>


</div>
@endsection

@section('script')
<script>
function uploadpicture(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	var formData = new FormData();
	formData.append('user_image', $('.upload')[0].files[0]);

	console.log(formData);
	$.ajax({
		url : "{{ url('user-portal/profile/picture') }}",
		type : 'POST',
		data :  formData,
		processData: false,
		contentType: false,
		timeout: 30000000,
		success : function(response) {
			if($.trim(response) != '1'){
				$('img.border-white').attr('src',response);
				$('img#headerImage').attr('src',response);
			}else{
				alert('Following format allowed (PNG/JPG/JPEG)');
			}
		}
	});
}
</script>
<script>
function checkPasswordStrength() {
	var number = /([0-9])/;
	var alphabets = /([a-zA-Z])/;
	// var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
	if ($('#password').val().length > 0) {

	if($('#password').val().length<=6) {
		$('#password-strength-status').removeClass();
		$('#password-strength-status').addClass('weak-password');
		$('#password-strength-status').html("Weak (6 characters or more, with at least 1 letter and one number.)");
		$(':input[type="submit"]').prop('disabled', true);
		$('#submit-btn').addClass("bg-gray");
		$('#submit-btn').removeClass("btn-green");
		check();
	} else {
		if($('#password').val().match(number) && $('#password').val().match(alphabets)) {
			$('#password-strength-status').removeClass();
			$('#password-strength-status').addClass('strong-password');
			$('#password-strength-status').html("Strong");
			$(':input[type="submit"]').prop('disabled', false);
			$('#submit-btn').removeClass("bg-gray");
			$('#submit-btn').addClass("btn-green");
			check();
		} else {
			$('#password-strength-status').removeClass();
			$('#password-strength-status').addClass('medium-password');
			$('#password-strength-status').html("Medium (should include alphabets, numbers)");
			$(':input[type="submit"]').prop('disabled', true);
			$('#submit-btn').addClass("bg-gray");
			$('#submit-btn').removeClass("btn-green");
			check();
		}
	}
}else {
	$(':input[type="submit"]').prop('disabled', false);
	$('#submit-btn').removeClass("bg-gray");
	$('#submit-btn').addClass("btn-green");
	$('#password-strength-status').removeClass('weak-password');
	$('#password-strength-status').removeClass('medium-password');
	$('#password-strength-status').removeClass('strong-password');
	$('#message').removeClass('weak-password');

}
}
var check = function()
{
	if ($('#password').val().length > 0 ) {

	if (document.getElementById('password').value ==
	document.getElementById('confirm_password').value) {
		$('#message').removeClass();
		$('#message').addClass('strong-password');
		document.getElementById('message').innerHTML = 'Password Match';
		var number = /([0-9])/;
		var alphabets = /([a-zA-Z])/;
		if($('#password').val().match(number) && $('#password').val().match(alphabets)) {
			$(':input[type="submit"]').prop('disabled', false);
			$('#submit-btn').removeClass("bg-gray");
			$('#submit-btn').addClass("btn-green");
		}else {
			$(':input[type="submit"]').prop('disabled', true);
			$('#submit-btn').addClass("bg-gray");
			$('#submit-btn').removeClass("btn-green");
		}
	} else {
		$('#message').removeClass();
		$('#message').addClass('weak-password');
		document.getElementById('message').innerHTML = 'Passwords do not match';
		$(':input[type="submit"]').prop('disabled', true);
		$('#submit-btn').addClass("bg-gray");
		$('#submit-btn').removeClass("btn-green");
	}
}else {
	$(':input[type="submit"]').prop('disabled', false);
}

}
</script>

@endsection
