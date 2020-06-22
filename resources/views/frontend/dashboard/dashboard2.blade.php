@extends('frontend.layouts.app')
@section('title', 'Booking Yo')

@section('styling')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/dashboard.css') }}">

@endsection

@section('content')

<div class="container margin-50" style="background: white;">
	<div class="row">
		<div class="col-md-12 dashboard-menu">
			<ul>
				<li>
					<a href="{{ url('dashboard/profile')}}">
						<div class="profile-icon">
							<i class="fa fa-user"></i>
						</div>
						<div class="profile-text">My profile</div>
					</a>
				</li>
				<li>
					<a href="{{ url('/password')}}">
						<div class="profile-icon">
							<i class="fa fa-lock" aria-hidden="true" style="color: #333333"></i>
						</div>
						<div class="profile-text">Change Password</div>
					</a>
				</li>
				<li>
					<a href="">
						<div class="profile-icon">
							<i class="fa fa-smile-o"></i>
						</div>
						<div class="profile-text">My Favorites</div>
					</a>
				</li>
				<li>
					<a href="{{ url('/coupon')}}">
						<div class="profile-icon">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
						</div>
						<div class="profile-text">subscribe</div>
					</a>
				</li>
				<li>
					<a href="{{ url('/listing')}}">
						<div class="profile-icon">
							<i class="fa fa-list" aria-hidden="true"></i>
						</div>
						<div class="profile-text">List</div>
					</a>
				</li>
				<li>
					<a href="">
						<div class="profile-icon">
							<i class="fa fa-comments" aria-hidden="true"></i>
						</div>
						<div class="profile-text">Chat box</div>
					</a>
				</li>
			</ul>
		</div>
	</div>	
</div>
@endsection