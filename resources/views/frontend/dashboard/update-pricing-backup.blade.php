@extends('frontend.layouts.master')

@section('title', 'Upgrade Package')
@section('styling')
<style>
	.rounded{
		border-radius: 3.25rem !important;
	}
	.shadow-lg{
		box-shadow:0px -1px 14px 10px #e8e8e8;
	}
	.border-top-3{
		border-top: 3px solid;
	}
	a:hover{
		text-decoration: none;
	}
	.text-primary {
	    color: #00abff!important;
	}
	.border-primary {
	  border-color: #00abff!important;
	}
</style>
@endsection
@section('content')
@include('frontend.dashboard.menu.menu')
<div class="container">
	<div class="row justify-content-center mb-5 mt-5">
		<div class="col-md-10 text-center">
			<h1 class="mb-5">Nautilus <span class="text-danger">Pricing Plans</span></h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
		</div>
	</div>
	<!-- Subscription Box -->
	<div class="row justify-content-center mb-5 mt-5">
	@foreach($plans as $plan)
		<div class="col col-md-3 text-center text-dark mb-3 px-1 mx-2 rounded">
			<a href="{{ route('plans.show', $plan->slug) }}">
				<div class="subscribe-box bg-white p-3 pt-5 pb-5 rounded shadow-lg" style="height: 605px;">
					<h2 class="text-capitalize text-primary">{{$plan->name}}</h2>

					<div class="border-top-3 border-primary"></div>
					<h6 class="text-danger mt-2">{{$plan->heading}}</h6>
					<ul class="list-group align-items-start mt-4">
						<li class="list-group-item bg-white border-0"><i class="fas fa-check pr-2"></i> {{$plan->land_number}}</li>
						<li class="list-group-item bg-white border-0"><i class="fas fa-check pr-2"></i> {{$plan->extension}}</li>
						<li class="list-group-item bg-white border-0 text-start"><i class="fas fa-check pr-2"></i> {{$plan->virtualassistant}}</li>
						<li class="list-group-item bg-white border-0"><i class="fas fa-check pr-2"></i> {{$plan->incomming}}</li>
						<li class="list-group-item bg-white border-0"><i class="fas fa-check pr-2"></i> {{$plan->freemints}}</li>
					</ul>
					<!-- <p class="pt-1 pb-1">Up to 3 users</p> -->
					<!-- @if(!auth()->user()->subscribedToPlan($plan->stripe_plan, 'main'))
	                          <a href="{{ route('plans.show', $plan->slug) }}" class="btn btn-danger btn-block mt-5 py-2">Get Plan</a>

					 @else
					 <button class="btn btn-success btn-block mt-5 py-2" disabled>Your Current Plan</button>
					  @endif -->
					  <h1 class="mt-4 mb-1 text-danger" style="font-weight: 700;">@if($plan->cost ==0.00) Free @else <span style="font-size: 27px;">S$</span>{{$plan->cost}}<span style="font-size: 27px;">.00</span> @endif</h1>
					  <sub class="h6">{{$plan->pricetag}}</sub><br>
					  <sub class="h6" style="color: gray;">*annual payment</sub><br>
					  @if(auth()->user()->subscribedToPlan($plan->stripe_plan, 'main'))
					  <sub class="h6" style="color: green;">Your Current Plan</sub>
					  @endif
					<!--<a href="{{url('/user-portal')}}" class="btn btn-danger btn-block mt-5 py-2">Get Plan</a>-->
				</div>
			</a>
		</div>
		@endforeach
	<!-- End Box -->
	</div>
</div>
@endsection
@section('script')
@endsection
