
@extends('frontend.dashboard.layout.master')

@section('title', 'Dashboard')

@section('styling')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/dashboard.css') }}">
@endsection
@section('content')

@include('frontend.dashboard.menu.menu')
<?php $listing_id=Request::segment(3); ?>
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
                    <a class="navbar-brand" href="#">Order Details</a>
                </div>

            </div>
        </nav>

<div class="content">
  <div class="container-fluid">
	<div class="row">
	<div class="cards">

		<div class="row" style="margin: 0;">
			<div class="col-md-6" style="margin-top: 22px;">
				<div class="main-login main-center">
						<h5>Buyer Details</h5>
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<label class="col-md-3">Name:</label>
									<span class=" col-md-offset-3 col-md-6">{{$user->user_firstname}} {{$user->user_lastname}}</span>
								</div>
								<div class="row">
									<label class="col-md-3">Phone:</label>
									<span class="col-md-6 col-md-offset-3">{{$order->mobile}}</span>
								</div>
								<div class="row">
									<label class="col-md-3">Email:</label>
									<span class="col-md-6 col-md-offset-3">{{$order->email}}</span>
								</div>
								<div class="row">
									<label class="col-md-3">Location:</label>
									<span class="col-md-6 col-md-offset-3">{{$order->address}}</span>
								</div>
								<div class="row">
									<label class="col-md-3">Address:</label>
									<span class="col-md-6 col-md-offset-3">{{$order->address2}}</span>
								</div>
								<div class="row">
									<label class="col-md-3">City:</label>
									<span class="col-md-6 col-md-offset-3">{{BookingYo::cityName($order->city)}}</span>
								</div>
								<div class="row">
									<label class="col-md-3">State:</label>
									<span class="col-md-6 col-md-offset-3">{{BookingYo::stateName($order->state)}}</span>
								</div>
								<div class="row">
									<label class="col-md-3">Country:</label>
									<span class="col-md-6 col-md-offset-3">{{BookingYo::countryName($order->country)}}</span>
								</div>

							</div>

						</div>
					</div>

			</div>
			<div class="col-md-6" style="margin-top: 22px;">
				<div class="main-login main-center">
						<h5>Seller Details</h5>
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<label class="col-md-3">Business:</label>
									<span class=" col-md-offset-3 col-md-6">{{$listing->bus_name}}</span>
								</div>
								<div class="row">
									<label class="col-md-3">Phone:</label>
									<span class="col-md-6 col-md-offset-3">{{$listing->landlinenumber}}</span>
								</div>
								<div class="row">
									<label class="col-md-3">Email:</label>
									<span class="col-md-6 col-md-offset-3">{{$listing->email_id}}</span>
								</div>
								<div class="row">
									<label class="col-md-3">Location:</label>
									<span class="col-md-6 col-md-offset-3">{{$listing->bui_name}}</span>
								</div>
								<div class="row">
									<label class="col-md-3">Address:</label>
									<span class="col-md-6 col-md-offset-3">{{$listing->address1}}</span>
								</div>
								<div class="row">
									<label class="col-md-3">City:</label>
									<span class="col-md-6 col-md-offset-3">{{BookingYo::cityName($listing->city)}}</span>
								</div>
								<div class="row">
									<label class="col-md-3">State:</label>
									<span class="col-md-6 col-md-offset-3">{{BookingYo::stateName($listing->state)}}</span>
								</div>
								<div class="row">
									<label class="col-md-3">Country:</label>
									<span class="col-md-6 col-md-offset-3">{{BookingYo::countryName($listing->country)}}</span>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
    	<div class="row" style="margin: 0;">
			<div class="col-md-12">
					<div class="main-login main-center">
					<h5>Product Details</h5>
						<div class="formbody">
				<div class="settingtabs">
				<div class="tabcontent active">
					<p>
						</p>
						<table class="table table-striped table-bordered">
							<tr class="heading-table">
								<th>Order Number</th>
								<th>Product Name</th>
								<th>Color</th>
								<th>Size</th>
								<th>Quantity</th>
								<th>Instructions</th>
								<th>Delivery Type</th>
								<th>Price</th>
								<th>Total</th>
								<th>Payment Status</th>
								<th>Status</th>
							</tr>
							<tbody>
								<tr>
									<td>{{$order->order_id}}</td>
									<td>{{$order->product_name}}</td>
									<td>{{$order->color}}</td>
									<td>{{$order->size}}</td>
									<td>{{$order->quantity}}</td>
									<td>{{$order->delivery_instruction}}</td>
									<td>{{$order->delivery_type}}</td>
									<td>{{$order->price}}</td>
									<td>{{$order->total}}</td>
									<td>{{$order->payment_status}}</td>
									<td>{{$order->status}}</td>
								</tr>
						</tbody>
					</table>


				</div>
				<div class="clear"></div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
</div>

		</div>
	</div>
</div>

<div class="modal fade" id="services_modal" role="dialog">
    <div class="modal-dialog">
		<div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Confirmation</h4>
	        </div>
	        <div class="modal-body">
	          <p>Do you want to buy form of shipping services ?</p>
	        </div>
	        <div class="modal-footer">
		        <button type="button" class="btn btn-default" id="modal-btn-yes">Yes</button>
		        <button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
	      	</div>
      	</div>
    </div>
</div>

<div class="modal fade" id="servicesmore_modal" role="dialog">
    <div class="modal-dialog">
		<div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Confirmation</h4>
	        </div>
	        <div class="modal-body">
	          <p>Do you want to buy form of shipping services ?</p>
	        </div>
	        <div class="modal-footer">
		        <button type="button" class="btn btn-default" id="modal-btn-yes-m">Yes</button>
		        <button type="button" class="btn btn-primary" id="modal-btn-no-m">No</button>
	      	</div>
      	</div>
    </div>
</div>

@section('script')

<script type="text/javascript">

function PostSubmit()

{

	$('#PostSubmit').submit();

}
function PostSubmits()

{

	$('#moreform').submit();

}

function PostSubmitWithServices()
{

	$("#services_modal").modal('show');

}

function PostSubmitsWithServices(){
	$("#servicesmore_modal").modal('show');
}

$("#modal-btn-yes").on("click", function(){
    callback(true);
    $("#services_modal").modal('hide');
  });

$("#modal-btn-no").on("click", function(){
    callback(false);
    $("#services_modal").modal('hide');
});

function callback(confirm){
	if(confirm){
		$('input[name="service_price"]').val(4);
		$('#PostSubmit').submit();
	}
	else{
		$('input[name="service_price"]').val("");
		$('#PostSubmit').submit();
	}
}

$("#modal-btn-yes-m").on("click", function(){
    callback_m(true);
    $("#servicesmore_modal").modal('hide');
  });

$("#modal-btn-no-m").on("click", function(){
    callback_m(false);
    $("#servicesmore_modal").modal('hide');
});


function callback_m(confirm){
	if(confirm){
		$('input[name="service_price"]').val(4);
		$('#moreform').submit();
	}
	else{
		$('input[name="service_price"]').val("");
		$('#moreform').submit();
	}
}

$('#formbtn').click(function(){

$('#moreform').toggle();
})

</script>

@endsection
@endsection
