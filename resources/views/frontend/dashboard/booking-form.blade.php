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
					<div class="col-md-offset-3 col-md-6 text-center">
						<button class="btn btn-success btn-lg" id="orderOnline"> <i class="fa fa-home"></i> Reservation List</button>
						<button class="btn btn-success btn-lg" id="category"> <i class="fa fa-list"></i> Booking Schedule</button>
					</div>	
				</div>
				<div class="row" style="margin: 30px auto;" id="orderOnlineTable">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<!-- <th>Order Numnber</th>
										<th>Buyer's Name</th>
										<th>Buyer Address</th>
										<th>Mobile Numnber</th>
										<th>Email Address</th> -->
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<!-- <td>OF-123</td>
										<td>Zeeshan</td>
										<td>Islamabad</td>
										<td>0587952241</td>
										<td>zeehsna@gmail.com</td>
										<td>On way</td> -->
										<td class="text-center">Nothing to show</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- Category List -->
				<div class="row" style="margin: 30px auto;display: none;" id="categoryTable">
					<div class="col-md-offset-1 col-md-10">
						<div class="table-responsive">
							<a class="btn btn-danger"  href="{{url('/dashboard/add-booking')}}" style="margin-bottom: 5px;"><i class="fa fa-plus"></i> Add Booking</a>
								<table class="table table-striped">
									<thead>
										<tr style="background: black; color: white;">
											<th>Date</th>
											<th>Time</th>
											<th>Price</th>
											<!-- <th>Rate Type</th> -->
											<th>Hole</th>
											<th>Player</th>
											<th>Courtesy</th>
											<th>Ground Name</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Pizza</td>
											<td>
												<img src="https://www.okjoa.com/upload/listing/vGOwCNQfaU.jpg" style="width:60px;height:60px;" class="media-photo">
											</td>
											<td class="text-center">
												<a href="{{url('/dashboard/categoryMenuList')}}" class="btn btn-xs btn-success">Menu Name</a>
												<a href="" class="btn btn-xs btn-warning">Edit</a>
												<a href="" class="btn btn-xs btn-danger">Delate</a>
											</td>
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