@extends('frontend.dashboard.layout.master')

@section('title', 'Listing')

@section('styling')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/food_order.css') }}">
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
        <a class="navbar-brand" href="#">My Listing</a>
      </div>
    </div>
  </nav>
	<div class="content">
	  <div class="container-fluid food-order">
			<div class="row">
				<div class="cards">
					<div class="row" style="padding: 20px;">
						<div class="col-md-offset-1 col-md-10 text-center">
							<a class="btn btn-success btn-lg" href="{{url('/dashboard/appointment-list')}}" style="width: 33%;"> <i class="fa fa-home"></i> Appointment List</a>
							<a class="btn btn-success btn-lg"  href="{{url('/dashboard/doctor-appointment')}}" style="width: 33%;"> <i class="fa fa-list"></i> Appointment Schedule</a>
						</div>	
					</div>
					<div class="row" style="margin: 30px auto;">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Doctor Name</th>
											<th>Profile Picture</th>
											<th>Duty Hours</th>
											<th>Speciality</th>
											<th>Appointment Date</th>
											<th>Appointment Time</th>
											<th>Department</th>
											<th>Professional Field</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Sunny Leone</td>
											<td><img src="https://www.okjoa.com/upload/listing/vGOwCNQfaU.jpg" style="width:70px;" class="media-photo"></td>
											<td>10</td>
											<td>Chest Specilist</td>
											<td>10/11/2018</td>
											<td>11:00 A.M</td>
											<td>Home Medicine</td>
											<td>Pta ni</td>
										</tr>
									</tbody>
								</table>
							</div>
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
	$('#category').click(function(){
		$('#categoryTable').show();
		$('#orderOnlineTable').hide()
	});
	$('#orderOnline').click(function(){
		$('#categoryTable').hide();
		$('#orderOnlineTable').show()
	});
</script>
@endsection