@extends('frontend.dashboard.layout.master')

@section('title', 'My Profile')

@section('styling')
<style>
/* .demoInputBox{padding:7px; border:#F0F0F0 1px solid; border-radius:4px;} */
#password-strength-status {padding: 1px 7px;color: #FFFFFF; border-radius:4px;margin-top:5px;}
.medium-password{background-color: #E4DB11;border:#BBB418 1px solid;}
.weak-password{background-color: #FF6600;border:#AA4502 1px solid;}
.strong-password{background-color: #12CC1A;border:#0FA015 1px solid;}
</style>
@endsection
@section('content')

@include('frontend.dashboard.menu.menu')

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
				<!-- <div class="col-lg-4 col-md-5 app-view-mainCol">
					<div class="cards cards-user">
						<div class="image">
							<img src="{{asset('frontend-assets/images/dashboard/background.jpg')}}" alt="...">
						</div>
						<div class="content">
							<div class="author">
								<div class="re-img-box">
									<img class="avatar border-white" src="" alt="...">
									<div class="re-img-toolkit">
										<div class="re-file-btn">
											Change <i class="fa fa-camera"></i>
											<input type="file" class="upload" id="imageFile"  name="image"  onchange="uploadpicture(this)">
										</div>

									</div>
								</div>

								<h4 class="title" id="userName">Zeeshan<br>

								</h4>
							</div>

						</div>
						<hr>
						<div class="text-center">
							<div class="row">

							</div>
						</div>
					</div>

				</div> -->
				<div class="col-lg-9 col-md-9 app-view-mainCol">
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
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Address</label>
											<input type="text" class="form-control border-input" placeholder="Enter Address" id="address" name="address" value="{{ $user->address}}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>City</label>
											<input type="text" class="form-control border-input" placeholder="Enter City" id="city" name="city" value="{{ $user->city}}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>State</label>
											<select class="form-control border-input" name="state" id="state" name="state">
												<option value="Alabama" {{$user->state == 'Alabama' ? 'selected=="selected"':''}}>Alabama</option>
												<option value="Alaska" {{$user->state == 'Alaska' ? 'selected=="selected"':''}}>Alaska</option>
												<option value="Arizona" {{$user->state == 'Arizona' ? 'selected=="selected"':''}}>Arizona</option>
												<option value="Arkansas" {{$user->state == 'Arkansas' ? 'selected=="selected"':''}}>Arkansas</option>
												<option value="California" {{$user->state == 'California' ? 'selected=="selected"':''}}>California</option>
												<option value="Colorado" {{$user->state == 'Colorado' ? 'selected=="selected"':''}}>Colorado</option>
												<option value=" Connecticut" {{$user->state == 'Connecticut' ? 'selected=="selected"':''}}> Connecticut</option>
												<option value="Delaware" {{$user->state == 'Delaware' ? 'selected=="selected"':''}}>Delaware</option>
												<option value="Florida" {{$user->state == 'Florida' ? 'selected=="selected"':''}}>Florida</option>
												<option value="Georgia" {{$user->state == 'Georgia' ? 'selected=="selected"':''}}> Georgia</option>
												<option value="Hawaii" {{$user->state == 'Hawaii' ? 'selected=="selected"':''}}>Hawaii</option>
												<option value="Idaho" {{$user->state == 'Idaho' ? 'selected=="selected"':''}}>Idaho</option>
												<option value="Illinois" {{$user->state == 'Illinois' ? 'selected=="selected"':''}}>Illinois</option>
												<option value="Indiana" {{$user->state == 'Indiana' ? 'selected=="selected"':''}}>Indiana</option>
												<option value="Iowa" {{$user->state == 'Iowa' ? 'selected=="selected"':''}}>Iowa</option>
												<option value="Kansas" {{$user->state == 'Kansas' ? 'selected=="selected"':''}}>Kansas</option>
												<option value="Kentucky" {{$user->state == 'Kentucky' ? 'selected=="selected"':''}}>Kentucky</option>
												<option value="Louisiana" {{$user->state == 'Louisiana' ? 'selected=="selected"':''}}>Louisiana</option>
												<option value="Maine" {{$user->state == 'Maine' ? 'selected=="selected"':''}}>Maine</option>
												<option value="Maryland" {{$user->state == 'Maryland' ? 'selected=="selected"':''}}>Maryland</option>
												<option value="Massachusetts" {{$user->state == 'Massachusetts' ? 'selected=="selected"':''}}>Massachusetts</option>
												<option value="Michigan" {{$user->state == 'Michigan' ? 'selected=="selected"':''}}>Michigan</option>
												<option value="Minnesota" {{$user->state == 'Minnesota' ? 'selected=="selected"':''}}>Minnesota</option>
												<option value="Mississippi" {{$user->state == 'Mississippi' ? 'selected=="selected"':''}}>Mississippi</option>
												<option value="Missouri" {{$user->state == 'Missouri' ? 'selected=="selected"':''}}>Missouri</option>
												<option value="Montana" {{$user->state == 'Montana' ? 'selected=="selected"':''}}>Montana</option>
												<option value="Nebraska" {{$user->state == 'Nebraska' ? 'selected=="selected"':''}}>Nebraska</option>
												<option value="Nevada" {{$user->state == 'Nevada' ? 'selected=="selected"':''}}>Nevada</option>
												<option value="New Hampshire" {{$user->state == 'New Hampshire' ? 'selected=="selected"':''}}>New Hampshire</option>
												<option value="New Jersey" {{$user->state == 'New Jersey' ? 'selected=="selected"':''}}>New Jersey</option>
												<option value="New Mexico" {{$user->state == 'New Mexico' ? 'selected=="selected"':''}}>New Mexico</option>
												<option value="New York" {{$user->state == 'New York' ? 'selected=="selected"':''}}>New York</option>
												<option value="North Carolina" {{$user->state == 'North Carolina' ? 'selected=="selected"':''}}>North Carolina</option>
												<option value="North Dakota" {{$user->state == 'North Dakota' ? 'selected=="selected"':''}}>North Dakota</option>
												<option value="Ohio" {{$user->state == 'Ohio' ? 'selected=="selected"':''}}>Ohio</option>
												<option value="Oklahoma" {{$user->state == 'Oklahoma' ? 'selected=="selected"':''}}>Oklahoma</option>
												<option value="Oregon" {{$user->state == 'Oregon' ? 'selected=="selected"':''}}>Oregon</option>
												<option value="Pennsylvania" {{$user->state == 'Pennsylvania' ? 'selected=="selected"':''}}>Pennsylvania</option>
												<option value="Rhode Island" {{$user->state == 'Rhode Island' ? 'selected=="selected"':''}}>Rhode Island</option>
												<option value="South Carolina" {{$user->state == 'South Carolina' ? 'selected=="selected"':''}}>South Carolina</option>
												<option value="South Dakota" {{$user->state == 'South Dakota' ? 'selected=="selected"':''}}>South Dakota</option>
												<option value="Tennessee" {{$user->state == 'Tennessee' ? 'selected=="selected"':''}}>Tennessee</option>
												<option value="Texas" {{$user->state == 'Texas' ? 'selected=="selected"':''}}>Texas</option>
												<option value="Utah" {{$user->state == 'Utah' ? 'selected=="selected"':''}}>Utah</option>
												<option value="Vermont" {{$user->state == 'Vermont' ? 'selected=="selected"':''}}>Vermont</option>
												<option value="Virginia" {{$user->state == 'Virginia' ? 'selected=="selected"':''}}>Virginia</option>
												<option value="Washington" {{$user->state == 'Washington' ? 'selected=="selected"':''}}>Washington</option>
												<option value="West Virginia" {{$user->state == 'West Virginia' ? 'selected=="selected"':''}}>West Virginia</option>
												<option value="Wisconsin" {{$user->state == 'Wisconsin' ? 'selected=="selected"':''}}>Wisconsin</option>
												<option value="Wyoming" {{$user->state == 'Wyoming' ? 'selected=="selected"':''}}>Wyoming</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Zip Code</label>
											<input type="text" name="zip" class="form-control border-input" placeholder="Enter Zip Code" id="zip" value="{{ $user->zip}}">
										</div>
									</div>
								</div>
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
											<input type="text" name="phone" class="form-control border-input" placeholder="Phone Number"  value="{{ $user->phone}}">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Change Password</label>
											<input type="password" class="demoInputBox form-control border-input" name="password" id="password" placeholder="Enter password"  onKeyUp="checkPasswordStrength();" /><div id="password-strength-status"></div>
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
									<button type="submit" class="btn btn-info btn-green btn-wd">Update Profile</button>
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
function checkPasswordStrength() {
	var number = /([0-9])/;
	var alphabets = /([a-zA-Z])/;
	// var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
	if ($('#password').val().length > 0) {

	if($('#password').val().length<=6) {
		$('#password-strength-status').removeClass();
		$('#password-strength-status').addClass('weak-password');
		$('#password-strength-status').html("Weak (should be more than 6 characters.)");
		$(':input[type="submit"]').prop('disabled', true);
	} else {
		if($('#password').val().match(number) && $('#password').val().match(alphabets)) {
			$('#password-strength-status').removeClass();
			$('#password-strength-status').addClass('strong-password');
			$('#password-strength-status').html("Strong");
			$(':input[type="submit"]').prop('disabled', false);
		} else {
			$('#password-strength-status').removeClass();
			$('#password-strength-status').addClass('medium-password');
			$('#password-strength-status').html("Medium (should include alphabets, numbers)");
			$(':input[type="submit"]').prop('disabled', true);
		}
	}
}else {
	$(':input[type="submit"]').prop('disabled', false);

}

}
</script>

@endsection
