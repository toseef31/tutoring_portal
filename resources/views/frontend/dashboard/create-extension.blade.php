@extends('frontend.dashboard.layout.master')

@section('title', 'My Profile')

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
				<a class="navbar-brand" href="#">Create Extension</a>
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
							<h3 class="title">Telephone Setting</h3>
							<hr>
						</div>
						<div class="content">
							<form class="form-horizontals profile-form" action="" method="get">
								{{ csrf_field() }}
								<!-- <div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Extension Type</label> <br>
											<input type="radio" name="extension_type"> Personal &nbsp; &nbsp;
											<input type="radio" name="extension_type"> Department
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Role</label> <br>
											<input type="radio" name="role"> Admin &nbsp; &nbsp;
											<input type="radio" name="role"> Non Admin
										</div>
									</div>
								</div> -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Call Flow</label>
											<textarea name="" class="form-control border-input" rows="4" cols="80" placeholder="Call Flow"></textarea>
										</div>
									</div>
								</div>
                <div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Call Recording</label>
											<select class="form-controls border-input" style="margin-bottom: 20px;">
													<option>Yes</option>
													<option>No</option>
											</select>
											<!-- <input type="text" class="form-controls border-input" placeholder="Extension" value="" style="margin-bottom: 20px;"> -->
											<!-- <input type="text" name="" class="form-controls border-input" placeholder="Instruction" class="form-controls border-input"> -->
										</div>
									</div>
								</div>


								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Call Log Reports</label>
											<select class="form-controls border-input" style="margin-bottom: 20px;">
													<option>Yes</option>
													<option>No</option>
											</select>
											<input type="email" id="pac-input" class="form-controls border-input" placeholder="Enter email Address" name="email" value="">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Installation Address</label>
											<input type="text" class="form-controls border-input" placeholder="Address detail" name="installation_address" value="" id="installation_address">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Billing Address </label>
											<input type="text" class="form-controls border-input" placeholder="Billing detail" name="billing_address" value="" id="billing_address">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Timeline/Deadline as stipulated by Client</label>
											<input type="text" class="form-controls border-input" placeholder="Timeline/Deadline as stipulated by Client" name="deadline" value="" id="deadline">
										</div>
									</div>
								</div>
								<h4>Contact Person (for project):</h4>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Name</label>
											<input type="text" class="form-controls border-input" placeholder="Name" name="person_name" value="" id="person_name">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Contact</label>
											<input type="number" class="form-controls border-input" placeholder="Contact Info" name="contact_info" value="" id="contact_info">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Email</label>
											<input type="email" class="form-controls border-input" placeholder="Person email" name="person_email" value="" id="person_email">
										</div>
									</div>
								</div>
								<h4>Contact Person (for account):</h4>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Name</label>
											<input type="text" class="form-controls border-input" placeholder="Name" name="account_person_name" value="" id="account_person_name">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Contact</label>
											<input type="number" class="form-controls border-input" placeholder="Contact Info" name="account_contact_info" value="" id="account_contact_info">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Email</label>
											<input type="email" class="form-controls border-input" placeholder="Person email" name="account_person_email" value="" id="account_person_email">
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Additional Comments</label>
											<!-- <textarea class="form-controls border-input" placeholder="Additional Comments"></textarea> -->
											<textarea name="" class="form-control border-input" placeholder="Additional Comments" rows="4" cols="80"></textarea>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Person In Change Name </label>
											<textarea class="form-controls border-input" placeholder="Person In Change Name:  "></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Date </label>
											<input type="date" name="date" class="form-controls border-input">
										</div>
									</div>
								</div>
								<div class="text-center">
									<button type="submit" class="btn btn-info btn-fill btn-wd">Submit</button>
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
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="https://www.jqueryscript.net/demo/jQuery-International-Telephone-Input-With-Flags-Dial-Codes/build/js/intlTelInput.js"></script>
<script>

   $("#phone_number").intlTelInput();
</script>

@endsection
