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
							<a class="btn btn-success btn-lg" href="{{url('/dashboard/onlineFoodOrder/'.$listing_id->listing_id)}}"> <i class="fa fa-home"></i> Online Order</a>
							<a class="btn btn-success btn-lg"  href="{{url('/dashboard/onlineFoodOrder/'.$listing_id->listing_id)}}"> <i class="fa fa-list"></i> Category</a>
						</div>
					</div>
					<div class="row" style="margin: 30px auto;">
						<div class="col-md-offset-2 col-md-8 category-form">
							<div class="panel panel-default">
							    <div class="panel-heading">Send Verification Request</div>
							    <div class="panel-body">
										<div id="category_success" class="alert alert-success alert-dismissible" style="display: none;">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											<span>New Category Created Successfully</span>
										</div>
							    	<form action="" method="POST" id="verify" class="form-horizontal" role="form">
                     {{ csrf_field() }}
										 <input type="hidden" id="listing_id" name="listing_id" value="{{$listing_id->listing_id}}">
											<div class="form-group">
							    			<label>Business Name</label>
												<input type="text" class="form-control" name="business_name" value="{{$listing_id->bus_name}}">
							    		</div>
											<div class="form-group">
							    			<label>Business Registration Number</label>
												<input type="text" class="form-control" name="business_registeration" value="{{$listing_id->bus_Registration}}">
							    		</div>

											<div class="form-group">
												<label>Country</label>
												<select class="form-control  doctor-country" name="country">
													<option value="" >Select Country</option>
													@foreach(BookingYo::getJobCountries() as $cntry)
													<option value="{{ $cntry->id }}"  {{ $listing_id->country == $cntry->id ? 'selected="selected"' : '' }}>{{$cntry->name}}</option>
													@endforeach
												</select>
											</div>

													<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>State</label>
														<select class="form-control select2 doctor-state" name="state" data-state="{{ $listing_id->state }}">
															@foreach(BookingYo::getJobStates($listing_id->country) as $cntry)
															<option value="{{ $cntry->id }}"  {{ $listing_id->state == $cntry->id ? 'selected="selected"' : '' }}>{{$cntry->name}}</option>
															@endforeach
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>City</label>
														<select class="form-control select2 doctor-city" name="city" data-city="{{ $listing_id->city }}">
															@foreach(BookingYo::getJobCities($listing_id->state) as $cntry)
															<option value="{{ $cntry->id }}"  {{ $listing_id->city == $cntry->id ? 'selected="selected"' : '' }}>{{$cntry->name}}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>


							    		<div class="form-group text-right">
						    				<button type="submit" id="category_submit_btn" class="btn btn-success">Submit</button>
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

$(document).ready(function () {
	$('.doctor-country').on('change',function(){
		var countryId = $(this).val();
		// alert(countryId);
		dcStates(countryId,'doctor-state')
	})
	function dcStates(countryId,cType){
		$.ajax({
			url: "{{ url('get-state') }}/"+countryId,
			success: function(response){

				var obj = $.parseJSON(response);
				$('.doctor-state').html('');

				$.each(obj,function(i,k){

					var newOption = new Option(k.name, k.id, true);
					$('.doctor-state').append(newOption);
				})
				$('.doctor-state').trigger('change');
			}
		})
	}
	$('.doctor-state').on('change',function(){
		var stateId = $(this).val();
		dcCities(stateId,'doctor-city');
	})

	function dcCities(stateId,cType){

		$.ajax({
			url: "{{ url('get-city') }}/"+stateId,
			success: function(response){
				var currentCity = $('.doctor-city').attr('doctor-city');
				var obj = $.parseJSON(response);
				$('.doctor-city').html('').trigger('change');

				$.each(obj,function(i,k){
					var vOption = k.id == currentCity ? true : false;
					var newOption = new Option(k.name, k.id, true, vOption);
					$('.doctor-city').append(newOption).trigger('change');
				})
			}
		})
	}
});


// Add Verification through ajax
$("#verify").on('submit', function (e) {
	// alert('hello');
	e.preventDefault();
	form = new FormData(this);
	var listing_id = $('#listing_id').val();
	// var formVal = $('form#add_category').serialize();
	// console.log(form);
	// var actionUrl = "{{ url('/add_category')}}";
	$.ajax({
		type: "POST",
		url:" {{ url('/send_verfication_request')}}",
		data: form,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
			toastr.success('Verification request send successfully', '', {timeOut: 5000, positionClass: "toast-top-right"});
			window.location.href = "{{url('/dashboard/form-listing/')}}/"+listing_id

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
