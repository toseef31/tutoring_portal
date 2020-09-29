@extends('frontend.dashboard.layout.master')

@section('title', 'Credits')


@section('styling')
<style>
.bg-gray{
	background-color: gray !important;
	color: white;
}
</style>
@endsection
@section('content')

@include('frontend.dashboard.menu.menu')
<?php
	$credit_cost='';
	$credit_id='';
	if($credit !=''){
		$credit_id=$credit->credit_id;
		$credit_cost=$credit->credit_cost;
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
				<a class="navbar-brand" href="#">Credits</a>
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
							<h3 class="title"><img src="{{asset('/frontend-assets/images/glasses.png')}}" class="glass-img" alt="logo"><span class="page-title">Credits </span><span style="float:right;">Credit Balance: @if($credit !=''){{$credit->credit_balance}} @else 0 @endif</span></h3>
							@if(session()->has('message'))
								<div class="row">
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
										{{session()->get('message')}}
									</div>
								</div>
							@endif
							<hr>
						</div>
            @include('frontend.dashboard.menu.alerts')
						<div class="content">
							<form class="form-horizontals profile-form" action="{{url('user-portal/buy-credit')}}" method="post">
								{{ csrf_field() }}
								<input type="hidden" name="credit_cost" value="{{$credit_cost}}">
								<input type="hidden" name="credit_id" value="{{$credit_id}}">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<p><strong>What are credits?</strong></p>
											<p>Credits simply are prepaid sessions. Each credit counts for one 60-min session and half credits count for one 30-min session. Your account must have credits in order for your tutor to hold a session with you.</p>
											<br>
											<p><strong>How are credits used?</strong></p>
											<p>After your tutoring session, credits will be deducted from your account in accordance with the duration of your session.</p>
											<br>
											<p><strong>How to purchase credits?</strong></p>
											<p>You can purchase credits using the links here. If this is your initial session, select “initial session credit.” Otherwise, please select from the packages available. If you prefer to pay by Venmo or check, please reach out to <a href="mailto:sofi@smartcookietutors.com"> sofi@smartcookietutors.com </a> and we will assist you. We love Venmo purchases!</p>
											<br>
											<p><strong>Do credits expire?</strong></p>
											<p>Yes, credits expire one year from the purchase date.</p>
											<br>
											<p><strong>What if I don’t/can’t use all of my credits?</strong></p>
											<p>No problem! Simply send an email to <a href="mailto:sofi@smartcookietutors.com"> sofi@smartcookietutors.com </a> indicating that you would like your unused credits refunded, and they will be, so long as they are not expired.</p>
											<br>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<select class="form-control" name="credit_balance" id="credit_balance">
												<option value="" selected>Number of Credits</option>
												@if($credit !='')
												@if(SCT::checkCredit(auth()->user()->id)->status =='Purchased Before')
												<option value="4">4</option>
												<option value="6">6</option>
												<option value="8">8</option>
												<option value="10">10</option>
												@else
												<option value="1">1</option>
												@endif
												@endif
											</select>
										</div>
									</div>
								</div>
								<div class="text-center">
									@if($credit !='')
									<button type="submit" class="btn btn-info btn-wd bg-gray" id="buy_btn"  disabled>Buy</button>
									@else
									<button type="submit" class="btn bg-gray" disabled>Buy</button>
									@endif
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
	$('#credit_balance').on('change',function () {
		var credit = $(this).val();
		// alert(credit)
		if (credit !='') {
			$('#buy_btn').prop('disabled',false);
			$('#buy_btn').removeClass('bg-gray');
			$('#buy_btn').addClass('btn-green');

		}else {
			$('#buy_btn').prop('disabled',true);
			$('#buy_btn').removeClass('btn-green');
			$('#buy_btn').addClass('bg-gray');
		}
	});
</script>

@endsection
