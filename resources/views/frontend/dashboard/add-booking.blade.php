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
						<div class="col-md-offset-2 col-md-8 text-center">
							<a class="btn btn-success btn-lg" href="{{url('/dashboard/booking-form')}}" style="width: 33%;"> <i class="fa fa-home"></i> Reservation List</a>
							<a class="btn btn-success btn-lg"  href="{{url('/dashboard/booking-form')}}" style="width: 33%;"> <i class="fa fa-list"></i>Booking Schedule</a>
						</div>	
					</div>
					<div class="row" style="margin: 30px auto;">
						<div class="col-md-offset-2 col-md-8 category-form">
							<div class="panel panel-default">
							    <div class="panel-heading">Booking Form</div>
							    <div class="panel-body">
							    	<form action="" method="POST" class="form-horizontal" role="form">
							    		<div class="form-group">
							    			<label>Hotel Name</label>
							    			<input type="text" min="0" name="groundName" class="form-control">
							    		</div>
							    		<div class="form-group">
							    			<label>Country</label>
							    			<select name="country" class="form-control">
							    				<option>Korea</option>
							    				<option>Pakistan</option>
							    				<option>China</option>
							    			</select>
							    		</div>
							    		<div class="form-group">
							    			<label>State</label>
							    			<select name="state" class="form-control">
							    				<option>--Select--</option>
							    			</select>
							    		</div>
							    		<div class="form-group">
							    			<label>City</label>
							    			<select name="city" class="form-control">
							    				<option>--Select--</option>
							    			</select>
							    		</div>
							    		<div class="form-group">
							    			<label>Booking Date</label>
							    			<input type="date" name="date" class="form-control">
							    		</div>
							    		<div class="form-group">
							    			<label>Leaving Date</label>
							    			<input type="date" name="date" class="form-control">
							    		</div>
							    		<div class="form-group">
							    			<label>Total Days</label>
							    			<input type="number" min="0" name="hole" class="form-control">
							    		</div>
							    		<div class="form-group">
							    			<label>Rooms</label>
							    			<input type="number" min="0" name="price" class="form-control">
							    		</div>
							    		<div class="form-group text-right">
						    				<button type="submit" class="btn btn-primary">Submit</button>
							    		</div>
							    	</form>
							    </div>
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