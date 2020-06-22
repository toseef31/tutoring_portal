@extends('frontend.dashboard.layout.master')

@section('title', 'Listing')

@section('styling')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/food_order.css') }}">
<link href="{{ asset('frontend-assets/css/dropzone.css') }}" rel="stylesheet">
<script src="{{ asset('/frontend-assets/js/dropzone.js') }}"></script>
@endsection
@section('content')

@include('frontend.dashboard.menu.menu')
<?php
	$service_type="";
	if ($product_info->service !="") {
		$service_type=$product_info->service;
	}else {
		$service_type="";
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
        <a class="navbar-brand" href="#">My Listing</a>
      </div>
    </div>
  </nav>
	<div class="content">
	  <div class="container-fluid food-order app-view-mainCol">
			<div class="row">
				<div class="cards">
					<div class="row" style="padding: 20px;">
						<div class="col-md-offset-2 col-md-8 text-center">
							<a class="btn btn-success btn-lg" href="{{url('/dashboard/addstore/'.$product_info->listing_id)}}"> <i class="fa fa-home"></i> My Stores</a>
							<a class="btn btn-success btn-lg"  href="{{url('/dashboard/addstore/'.$product_info->listing_id)}}"> <i class="fa fa-list"></i> Add Stores</a>
							<a class="btn btn-success btn-lg"> <i class="fa fa-cog"></i> Setting</a>
						</div>
					</div>
					<div class="row" style="margin: 30px auto;">
						<div class="col-md-offset-2 col-md-8 category-form app-view-mainCol">
							<div class="panel panel-default">
							    <div class="panel-heading">Edit Store</div>
							    <div class="panel-body">

										<form action="" method="POST" id="add_category" class="form-horizontal" role="form">
																		{{ csrf_field() }}
									<div class="form-group">
										<label>Select Service</label>
										<select class="form-control main_foodcategory" name="service">
											<option>Select Service</option>
											<option value="o2o" {{ $service_type == 'o2o' ? 'selected="selected"' : '' }}>O2O</option>
											<option value="d2d" {{ $service_type == 'd2d' ? 'selected="selected"' : '' }}>Door to Door</option>

										</select>
											</div>
									<div class="form-group">
										<label>Enter Store Name</label>
										<input type="text"  name="store_name" class="form-control" value="{{$product_info->store_name}}">
									</div>
									<div class="col-md-4">
								<div class="form-group">
									<label>Country</label>
									<select class="form-controls border-input job-country " name="country">
										<option value="" >Select Country</option>
										@foreach(BookingYo::getJobCountries() as $cntry)
										<option value="{{ $cntry->id }}"  {{ $product_info->country == $cntry->id ? 'selected="selected"' : '' }}>{{$cntry->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>State</label>
									<select class="form-controls border-input job-state" name="state" data-state="{{ $product_info->state }}" required>
										@foreach(BookingYo::getJobStates($product_info->country) as $cntry)
										<option value="{{ $cntry->id }}"  {{ $product_info->state == $cntry->id ? 'selected="selected"' : '' }}>{{$cntry->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>City</label>
									<select class="form-controls border-input job-city" name="city" data-city="{{ $product_info->city }}" required>
										@foreach(BookingYo::getJobCities($product_info->state) as $cntry)
										<option value="{{ $cntry->id }}"  {{ $product_info->city == $cntry->id ? 'selected="selected"' : '' }}>{{$cntry->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
										<label>Enter Store Address</label>
										<input type="text" id="pac-input" name="address" class="form-control" value="{{$product_info->address}}">
									</div>
								<div class="form-group">
										<label>Enter Store Email</label>
										<input type="text" id="pac-input" name="email" class="form-control" value="{{$product_info->email}}">
									</div>
								<div class="form-group">
										<label>Enter Store Phone No</label>
										<input type="number" name="phoneno" class="form-control" placeholder="Enter Store Phone No" value="{{$product_info->phoneno}}">
									</div>
								<div class="form-group">
										<label>Enter Mobile No</label>
										<input type="number"  name="mobileno" class="form-control" placeholder="Enter Store Phone No" value="{{$product_info->mobileno}}">
									</div>
									<input type="hidden" name="listing_id" id="listing_id" value="{{$product_info->listing_id}}">
									<input type="hidden" name="store_id" value="{{$product_info->store_id}}">
									<input type="hidden" name="latitude" id="lat" value="{{$product_info->latitude}}">
									<input type="hidden" name="longitude" id="lng"value="{{$product_info->longitude}}">

									<div class="form-group text-right">
										<button type="submit" id="category_submit_btn" class="btn btn-primary">Submit</button>
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
<script>
  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  function initMap() {


    var input = document.getElementById('pac-input');


    var autocomplete = new google.maps.places.Autocomplete(input);

    // Bind the map's bounds (viewport) property to the autocomplete object,
    // so that the autocomplete requests use the current map bounds for the
    // bounds option in the request.


    // Set the data fields to return when the user selects a place.

    autocomplete.addListener('place_changed', function() {


      var place = autocomplete.getPlace();
      if (!place.geometry) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }
      var lat = place.geometry.location.lat(),
      lng = place.geometry.location.lng();

      // Then do whatever you want with them
      $('#lat').val(lat);
      $('#lng').val(lng);
      console.log(lat);
      console.log(lng);
    });


  }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1RaWWrKsEf2xeBjiZ5hk1gannqeFxMmw&libraries=places&callback=initMap" async defer></script>
<script>

$('.job-country').on('change',function(){
	var countryId = $(this).val();
	getStates(countryId,'job-state')
})
function getStates(countryId,cType){
	$.ajax({
		url: "{{ url('get-state') }}/"+countryId,
		success: function(response){
			var currentState = $('.'+cType).attr('data-state');
			// alert(currentState);
			var obj = $.parseJSON(response);
			$('.'+cType).html('');
			var newOption = new Option('Select State', '0', true, false);
			$('.'+cType).append(newOption).trigger('change');
			$.each(obj,function(i,k){
				var vOption = k.id == currentState ? true : false;
				var newOption = new Option(k.name, k.id, true, vOption);
				$('.'+cType).append(newOption);
			})
			$('.'+cType).trigger('change');
		}
	})
}
$('.job-state').on('change',function(){
	var stateId = $(this).val();
	getCities(stateId,'job-city');
})


function getCities(stateId,cType){
	if(stateId == '0'){
		$('.'+cType).html('').trigger('change');
		var newOption = new Option('Select City', '0', true, false);
		$('.'+cType).append(newOption).trigger('change');
		return false;
	}
	$.ajax({
		url: "{{ url('get-city') }}/"+stateId,
		success: function(response){
			var currentCity = $('.'+cType).attr('data-city');
			var obj = $.parseJSON(response);
			$('.'+cType).html('').trigger('change');
			var newOption = new Option('Select City', '0', true, false);
			$('.'+cType).append(newOption).trigger('change');
			$.each(obj,function(i,k){
				var vOption = k.id == currentCity ? true : false;
				var newOption = new Option(k.name, k.id, true, vOption);
				$('.'+cType).append(newOption).trigger('change');
			})
		}
	})
}
// Add Category through ajax
$("#add_category").on('submit', function (e) {
	// alert('hello');
	e.preventDefault();
	form = new FormData(this);
	var listing_id = $('#listing_id').val();
	// alert(listing_id);
	// var formVal = $('form#add_category').serialize();
	console.log(form);
	// var actionUrl = "{{ url('/add_category')}}";
	$.ajax({
		type: "POST",
		url:" {{ url('/dashboard/addstore')}}/"+listing_id,
		data: form,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
			console.log(data);
			$('#store_data tbody').html(data);
			$('#add_category').trigger("reset");
			toastr.success('Information Updated successfully', '', {timeOut: 5000, positionClass: "toast-top-right"});
			$('#categoryTable').hide();
		$('#orderOnlineTable').show()
		},
		error: function() {
			$('#loading').hide();
			$('#checkcatid').prop("disabled",false);
			alert("Error posting feed");
		}
	});
	//return false;
});

</script>
@endsection
