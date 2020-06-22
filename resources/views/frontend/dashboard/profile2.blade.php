@extends('frontend.layouts.app')
@section('title', 'Booking Yo')
@section('content')
<!--  -->


<div class="container" style="background-color: #fff;">
	<div class="row" id="row_pdng">
		<div class="col-md-2"></div>
			<div class="col-md-8">
				<form class="form-horizontal" style="padding:15px; background-color:#ece7e794; border-radius: 5px;">
				{{ csrf_field() }}
					<h3 style="text-align: center; background-color: #ece8e8; padding: 10px 0px;">Update Your Profile</h3>
					<br>

				  <div class="form-group">
				    <label for="Castle" class="col-sm-2 control-label">First Name</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputEmail3" name="user_firstname" value="{{$userdata->user_firstname}}">
				      <div style="color: darkgrey;"> Example: Hong</div>
				    </div>
				  </div>

				  <div class="form-group">
				    <label for="name" class="col-sm-2 control-label">Last Name</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputEmail3" name="user_lastname" value="{{$userdata->user_lastname}}">
				      <div style="color: darkgrey;"> For Example</div>
				    </div>
				  </div>

				  <div class="form-group">
				    <label for="address" class="col-sm-2 control-label">Address</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" name="address" id="inputEmail3"value="{{$userdata->address}}">
				    </div>
				  </div>

				  <div class="form-group">
				    <label for="City and Province" class="col-sm-2 control-label">Country</label>
				    <div class="col-sm-10">
							<select class="form-control job-country" name="country">
							<option value="" >Select Country</option>
								@foreach(BookingYo::getJobCountries() as $cntry)
									<option value="{{ $cntry->id }}"  {{ $userdata->country == $cntry->id ? 'selected="selected"' : '' }}>{{$cntry->name}}</option>
								@endforeach
							</select>
						</div>
				  </div>

				  <div class="form-group">
				    <label for="Old Town" class="col-sm-2 control-label">State</label>
				    <div class="col-sm-10">
						<select class="form-control select2 job-state" name="state" data-state="{{ $userdata->state }}" required>
								</select>
				    </div>
				  </div>
					<div class="form-group">
				    <label for="Old Town" class="col-sm-2 control-label">City</label>
				    <div class="col-sm-10">
						<select class="form-control select2 job-city" name="city" data-city="{{ $userdata->city }}" required>
								</select>
				    </div>
				  </div>

				  <div class="form-group">
				    <label for="Gender" class="col-sm-2 control-label">Gender</label>
				    <div class="col-sm-10">
				      <label class="radio-inline"><input type="radio" class="form-check-input" name="gender" style="display: block;" {{ $userdata->gender == 'Male' ? 'checked="checked"' : '' }} value="Male">Male</label>
				      <label class="radio-inline "><input type="radio" class="form-check-input" name="gender" style="display: block;" value="Female" {{ $userdata->gender == 'Female' ? 'checked="checked"' : '' }}>Female</label>
				      <label class="radio-inline"><input type="radio" class="form-check-input" name="gender" style="display: block;" value="Irrelevant" {{ $userdata->gender == 'Irrelevant' ? 'checked="checked"' : '' }}>Irrelevant</label>
				    </div>
				  </div>

				  <div class="form-group">
				    <label class="col-sm-2"></label>
				    <div class="col-sm-10">
				      <button class="btn btn-primary btn_styl" type="submit" style="float: left;">Save</button>
				 	 <button class="btn btn-danger btn_styl" type="button" style="float: right;">Cancel</button>
				    </div>
				  </div>

				  
				  <br>
				</form>


			</div>
		<div class="col-md-2"></div>
	</div>
</div>

@endsection

@section('script')

<script type="text/javascript" charset="utf-8">
$('form.form-horizontal').submit(function(e){
	$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
	var formdata = $('form.form-horizontal').serialize(); 
	console.log(formdata);
	$.ajax({
		type: 'post',
		data: formdata,
	
		url: "{{ url('dashboard/profileUpdate') }}",
		success: function(response){
			console.log(response);
			toastr.success('update successfully', '', {timeOut: 5000, positionClass: "toast-top-right"});
		}

	});
	e.preventDefault();
})

$('.job-country').on('change',function(){
    var countryId = $(this).val();
    getStates(countryId)
})
function getStates(countryId){
    $.ajax({
        url: "{{ url('get-state') }}/"+countryId,
        success: function(response){
            console.log(response);
            var obj = $.parseJSON(response);
            $(".job-state").html('').trigger('change');
            var newOption = new Option('Select State', '0', true, false);
            //$(".job-state").append(response).trigger('change');
            $.each(obj,function(i,k){
                var newOption = new Option(k.name, k.id, true, false);
                $(".job-state").append(newOption);
            })
            $(".job-state").trigger('change');
        }
    })
}
$('.job-state').on('change',function(){
    var stateId = $(this).val();
    getCities(stateId)
})
function getCities(countryId){
    $.ajax({
        url: "{{ url('get-city') }}/"+countryId,
        success: function(response){
            console.log(response);
            var obj = $.parseJSON(response);
             $(".job-city").html('').trigger('change');
            var newOption = new Option('Select City', '0', true, false);
            //$(".job-city").append(response).trigger('change');
            $.each(obj,function(i,k){
                var newOption = new Option(k.name, k.id, true, false);
                $(".job-city").append(newOption).trigger('change');
            })
						$(".job-city").trigger('change');
        }
    })
}
</script>

@endsection