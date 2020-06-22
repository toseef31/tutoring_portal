@extends('frontend.dashboard.layout.master')

@section('title', 'Coupon')

@section('styling')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/food_order.css') }}">
<link href="{{ asset('frontend-assets/css/dropzone.css') }}" rel="stylesheet">
<script src="{{ asset('/frontend-assets/js/dropzone.js') }}"></script>
@endsection
@section('content')

@include('frontend.dashboard.menu.menu')
<?php
	$currency_type="";
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
        <a class="navbar-brand" href="#">Coupon</a>
      </div>
    </div>
  </nav>
	<div class="content">
	  <div class="container-fluid food-order">
			<div class="row">
				<div class="cards">

					<div class="row" style="padding: 20px;">
						<div class="col-md-12 text-center">
							<button class="btn btn-success btn-lg" id="coupan_list"> <i class="fa fa-list"></i> Coupon List</button>
							<button class="btn btn-success btn-lg" id="buy_coupan_form"> <i class="fa fa-wpforms"></i> Buy Coupon Form</button>
						</div>
					</div>

					<div class="row hide" style="margin: 30px auto;" id="coupanForm">
						<div class="col-md-offset-2 col-md-8 category-form">
							<div class="panel panel-default">
							    <div class="panel-heading">Coupon Buy Form</div>
							    <div class="panel-body">
									<div id="category_success" class="alert alert-success alert-dismissible" style="display: none;">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<span>New Category Created Successfully</span>
									</div>
							    	<form action="{{url('coupanPaypalPayment')}}" method="POST" class="form-horizontal" role="form">
                     				{{ csrf_field() }}

										<div class="form-group">
											<label>Comapny Name</label>
											<select class="form-control" name="comapny_name" id="company_name" required="">
												<option value="" selected>Select Company</option>
												@foreach($listing as $list)
												<option value="{{$list->listing_id}}">{{$list->companyname}}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group">
											<label>Category</label>
											<select class="form-control" name="category" id="category" required="">
												<option value="" selected>Select Category</option>
												@foreach($categories as $cat)
												<option value="{{$cat->cat_id}}">{{$cat->cat_title}}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group">
											 <label>Price</label>
											 <input type="text" name="price" class="form-control" value="50.00" readonly>
										 </div>

 										<div class="form-group">
 											 <button type="Submit" class="btn btn-large btn-block btn-success" id="buy_coupan_btn" style="float: right;font-size: 15px;margin-top: 30px; background: green;">Submit</button>
 										</div>

							    	</form>

										<!-- Form Body Ends -->

							    </div>
						  </div>
						</div>
					</div>

					<div class="row" style="margin: 30px auto;" id="coupanList">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Comapny Name</th>
											<th>Category</th>
											<th>Code</th>
											<th>Type</th>
											<th>Discount</th>
											<th>Amount</th>
											<th>Form Days</th>
											<th>Status</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($coupanlist as $list)
										<tr>
											<td class="comapny-details">
												{{BookingYo::getCompany($list->listing_id)}}
												<input type="hidden" class="listing-id" value="{{$list->listing_id}}">
												<input type="hidden" class="coupanform-id"  value="{{$list->coupanform_id}}">
												<input type="hidden" class="coupan_code"  value="{{$list->code}}">
												<input type="hidden" class="disc_type"  value="{{$list->type}}">
												<input type="hidden" class="percent"  value="{{$list->percent_off}}">
												<input type="hidden" class="fixed"  value="{{$list->fixed_value}}">
												<input type="hidden" class="amount"  value="{{$list->get_discount_on}}">
											</td>
											<td class="category_id">{{BookingYo::getCategoryName($list->category_id)}}</td>
											<td>{{$list->code}}</td>
											<td>{{$list->type}}</td>
											<?php
											$discount ="";
											$code = "";
											if($list->type == 'percent'){
												$discount=$list->percent_off;
											}else{
												$discount=$list->fixed_value;
											}
											if ($list->code !="") {
												$code=$list->code;
											}
											 ?>
											<td>{{$discount}}</td>
											<td>{{$list->get_discount_on}}</td>
											<td>{{$list->form_days}}</td>
											<td>{{$list->status}}</td>
											@if($code !="")
											<td class="text-center"><button type="button" class="btn btn-primary add_coupan_brn">Edit Coupon</button></td>
											@else
											<td class="text-center"><button type="button" class="btn btn-success add_coupan_brn">Add Coupon</button></td>
											@endif
										</tr>
										@endforeach
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

<div class="modal fade" id="coupanFormModal" role="dialog"
   aria-labelledby="coupanFormModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" style="border-radius: 0px;">
         <!-- Modal Header -->
         <div class="modal-header cus-header">
            <button type="button" class="close"
               data-dismiss="modal"  style="margin-top: 14px;">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title" id="coupanFormModalLabel">
               Coupon Form
            </h4>
         </div>
         <!-- Modal Body -->
         <div class="modal-body">
            <form class="form-horizontal" role="form" id="coupanbuy_form" method="POST">
            	{{ csrf_field() }}
                <div class="form-group">
                  <label  class="col-sm-2 control-label"
                     for="inputEmail3">Coupon Code</label>
                  <div class="col-sm-10">
                     <input type="text" id="coupan_code" class="form-control text-uppercase"
                        name="coupan_code" required="" />
                        <input type="hidden" id="listing_id" name="listing_id">
                        <input type="hidden" id="category_id" name="category_id">
                        <input type="hidden" id="coupanform_id" name="coupanform_id">
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"
                     for="inputPassword3" >Type</label>
                    <div class="col-sm-10">
	                  	<select class="form-control" name="discount_type" id="discount_type" required="">

												<option value="">Select Coupon Type</option>
	                  		<option value="fixed">Fixed</option>
	                  		<option value="percent">Percent</option>
	                  	</select>

	                </div>
                </div>
                <div class="form-group hide" id="percent_off">
                  	<label  class="col-sm-2 control-label"
                     for="inputEmail3">Percent Off</label>
                  	<div class="col-sm-10">
                     <input type="text" id="percent_val" class="form-control text-right"
                        name="percent_off"/>
                  	</div>
                </div>
                <div class="form-group hide" id="fixed_value">
                  	<label  class="col-sm-2 control-label"
                     for="inputEmail3">Fixed Rate</label>
                  	<div class="col-sm-10">
                     <input type="text" id="fixed_val" class="form-control text-right"
                        name="fixed_value" />
                  	</div>
                </div>
                <div class="form-group hide" id="get_discount">
                  	<label  class="col-sm-2 control-label"
                     for="inputEmail3">Get Discount</label>
                  	<div class="col-sm-10">
                     <input type="text" class="form-control text-right"
                        name="get_discount" id="get_disc" required="" />
                  	</div>
                  	<br><br>
                  	<span style="padding-left: 15px;color: #ab9c79;">Add price range on which you want to give discount to customer</span>
                </div>
            </form>
         </div>
         <!-- Modal Footer -->
         <div class="modal-footer">
            <button type="button" class="btn btn-default"
               data-dismiss="modal">
            Close
            </button>
            <button type="button" class="btn btn-primary" id="coupan_submit_bnt">
            	Submit
            </button>
         </div>
      </div>
   </div>
</div>

@endsection
@section('script')
<script src="{{ asset('frontend-assets/tinymce/tinymce.min.js') }}"></script>
<script>
// $('#company_name').on('change', function() {

// 	var listing_id = $(this).val();

// 	if(listing_id == ""){
// 		$('#category').html('<option value="">Select Category</option>');
// 	}
// 	else
// 	{
// 		$.ajax({
// 			url: "{{ url('/dashboard/getCategoriesAgainstCompany')}}/"+listing_id,

// 			success: function(response) {



// 				var obj = $.parseJSON(response);
// 				console.log(obj);

// 				$.each(obj, function(key, value) {
// 				    $('#category')
// 				         .append($("<option></option>")
// 				                    .attr("value",value.category_id)
// 				                    .text(value.category_id));
// 				});

// 			}

// 		})

// 	}


// });

	$('#discount_type').on('change', function(){

		var discount_type = $(this).val();

		if(discount_type != '') {

			if(discount_type == "fixed"){
				$('#fixed_value').addClass('show').removeClass('hide');
				$('#percent_off').addClass('hide').removeClass('show');
				$('#get_discount').addClass('show').removeClass('hide');
			} else {
				$('#percent_off').addClass('show').removeClass('hide');
				$('#fixed_value').addClass('hide').removeClass('show');
				$('#get_discount').addClass('show').removeClass('hide');
			}

		} else {
			$('#percent_off').addClass('hide').removeClass('show');
		    $('#fixed_value').addClass('hide').removeClass('show');
		    $('#get_discount').addClass('hide').removeClass('show');
		}

	});

	$('.add_coupan_brn').on('click', function(){
		var tr = $(this).closest('tr');
		$('#category_id').val(tr.find('.category_id').text());
		$('#listing_id').val(tr.find('.listing-id').val());
		$('#coupanform_id').val(tr.find('.coupanform-id').val());
		$('#coupan_code').val(tr.find('.coupan_code').val());
		$('#discount_type').val(tr.find('.discount_type').val());
		$('#percent_val').val(tr.find('.percent').val());
		$('#fixed_val').val(tr.find('.fixed').val());
		$('#get_disc').val(tr.find('.amount').val());
		var discount_type = tr.find('.disc_type').val();
		var value = $("#discount_type").val(discount_type);
		if(discount_type != '') {

			if(discount_type == "fixed"){
				$('#fixed_value').addClass('show').removeClass('hide');
				$('#percent_off').addClass('hide').removeClass('show');
				$('#get_discount').addClass('show').removeClass('hide');
			} else {
				$('#percent_off').addClass('show').removeClass('hide');
				$('#fixed_value').addClass('hide').removeClass('show');
				$('#get_discount').addClass('show').removeClass('hide');
			}

		} else {
			$('#percent_off').addClass('hide').removeClass('show');
				$('#fixed_value').addClass('hide').removeClass('show');
				$('#get_discount').addClass('hide').removeClass('show');
		}
		$('#coupanFormModal').modal('show');
	});

	$('#coupan_submit_bnt').on('click', function() {

		var coupan_code        = $('input[name="coupan_code"]').val(),
	    	discount_type      = $('#discount_type').val(),
	        get_discount       = $('input[name="get_discount"]').val(),
	        has_error          = false;

	    if(coupan_code==""){
	      $('input[name="coupan_code"]').addClass('error-cls').on('focus', function(){
	        $(this).removeClass('error-cls');
	      });
	      has_error = true;
	    }

	    if(discount_type==""){
	      $('#discount_type').addClass('error-cls').on('focus', function(){
	        $(this).removeClass('error-cls');
	      });
	      has_error = true;
	    }
	    if(get_discount==""){
	      $('input[name="get_discount"]').addClass('error-cls').on('focus', function(){
	        $(this).removeClass('error-cls');
	      });
	      has_error = true;
	    }

	    if(has_error) {

	      return false;

	    } else {


			var actionUrl = "{{ url('/dashboard/addCoupanCode')}}";

			$.ajax({
				 type: "POST",
				 url: actionUrl,
				 data: $('#coupanbuy_form').serializeArray(),
				 success: function(data){
					 toastr.success('Coupon Added successfully', '', {timeOut: 5000, positionClass: "toast-top-right"});
				 },
				 error: function() {
					 alert("Error posting feed");
				 }
			});

		}

	});


	$('#coupan_list').click(function(){
		$('#coupanList').addClass('show').removeClass('hide');
		$('#coupanForm').addClass('hide').removeClass('show');
	});
	$('#buy_coupan_form').click(function(){
		$('#coupanForm').addClass('show').removeClass('hide');
		$('#coupanList').addClass('hide').removeClass('show');
	});

	// $(document).on('change','#category', function () {
	// 	var company = $('#company_name').val();
	// 	var category = $('#category').val();
	// 	if(company =="" || category ==""){
	// 		$('#buy_coupan_btn').prop('disabled', true);
	// 	}else {
	// 		$('#buy_coupan_btn').prop('disabled', false);
	// 	}
	// });
	// $(document).on('change','#company_name', function () {
	// 	var company = $('#company_name').val();
	// 	var category = $('#category').val();
	// 	if(company =="" || category ==""){
	// 		$('#buy_coupan_btn').prop('disabled', true);
	// 	}else {
	// 		$('#buy_coupan_btn').prop('disabled', false);
	// 	}
	// });
</script>
@endsection
