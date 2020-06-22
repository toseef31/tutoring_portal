
@extends('frontend.dashboard.layout.master')

@section('title', 'Dashboard')

@section('styling')
<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,100' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/dashboard.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
	.cus-alert-info{
		border: 2px solid #31708f !important;
		border: 0px !important;
	}
	span.select2.select2-container{
		width:100% !important;
	}
	a{
  text-decoration: none;
}
.modal-body form {
    padding: 0;
}
.price-table-wrapper{
  font-family: 'Lato', sans-serif;
  text-align: center;
  margin-top: 30px;
}
  .price-table-wrapper.featured-table{
    box-shadow: 0px 0px 19px -3px rgba(0,0,0,0.36);
  }

  .pricing-table{
    display: inline-block;
    border: 1px solid #C8C8C8;
    border-radius: 10px;
    background: white;
    margin: 20px;
    transition: all 0.3s ease-in-out;
		width:26%;
	}
    .pricing-table__header{
      padding: 20px;
      font-size: 20px;
      color: #909090 ;
      background: #E0E0E0;
    }
    .pricing-table__price{
      color: #E09D00;
      padding: 2px;
      margin: auto;
      font-size: 40px;
      font-weight: 500;
    }
    .pricing-table__button{
      display: block;
      background: #E09D00;
      text-decoration: none;
      padding: 20px;
      color: white;
      position: relative;
      overflow: hidden;
      transition: all 0.3s ease-in-out;
			border: none;
			width: 100%;
		}
      .pricing-table:before{
        position: absolute;
        left: -20%;
        top: -10%;

        width: 60%;
        height: 220%;
        transform: rotate(-30deg);
        background: white;
        opacity: .3;
        transition: all 0.3s ease-in-out;
      }

       .pricing-table:after{
          position: absolute;
          content: '>';
          top: 0;
          right: 0;
          font-size: 25px;
          padding: 15px;
          padding-right: 40px;
          color: white;
          opacity: 0;
         transition: all 0.3s ease-in-out;
        }

      .pricing-table:hover{
        background: #333333;
				color: #fff;
      }
		.duration{
				 margin-top: 5px;
			}

    .pricing-table__list{
      padding: 20px;
      color: #A0A0A0;
		}

        .pricing-table__list:last-child{
          border: none;
        }


    .pricing-table__button:hover{
      box-shadow: 0px 0px 19px -3px rgba(0,0,0,0.36);
		}

       .pricing-table__button:before{
          top: -80%;
          transform: rotate(0deg);
          width: 100%;
        }
       .pricing-table__button:after{
          opacity: 1;
          padding-right: 15px;
        }


</style>
@endsection
@section('content')

@include('frontend.dashboard.menu.menu')
<?php
 $listing_id=Request::segment(3);
 $chatstatus= (BookingYo::chatstatus($listing_id)->videochat == 0) ? 'checked' : '';
 $okstatus= (BookingYo::chatstatus($listing_id)->videochat == 1) ? 'checked' : '';
 $pckg=BookingYo::getvideopckg($listing_id);
// dd($pckg);
	if ($pckg !="") {
		$your_date = strtotime($pckg->package_duration." day", strtotime($pckg->created_at));
		$expiry_date = date("Y-m-d", $your_date);
    $start = strtotime(date('Y-m-d'));
		$end = strtotime($expiry_date);

		$remeingdays=ceil(abs($end - $start) / 86400);
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
                    <a class="navbar-brand" href="#">Buy Listing Form</a>
                </div>

            </div>
        </nav>

<div class="content">
  <div class="container-fluid app-view-mainCol">
	<div class="row">
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
	<div class="cards">

		<div class="row" style="margin: 0;">
			<!-- <div class="col-md-6 app-view-mainCol" style="margin-top: 22px;">
				<form class="form-inline" action="" >
					<div class="main-login main-center">
						<h5>Contact Setting</h5>
						<div class="formbody">
							@if($pckg)
							<p style="">Package Title: <span>{{ucfirst($pckg->package_name)}}</span></p>
							<p style="">Expiry Date: {{$expiry_date}} <span style="color:green"> ({{$remeingdays}}) </span> days left</p>
							@endif
							<div class="form-group">
								<label class=" control-label col-sm-3">Video Chat</label>
								<div class="col-sm-8">
									<label class="radio-inline"><input type="radio" name="videochat"  value="1" {{$okstatus}} data-toggle="modal" data-target="#mychat">Yes</label>
									<label class="radio-inline"><input type="radio" name="videochat" value="0" {{$chatstatus}}>No</label>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3"></label>
								<div class="control-label col-sm-9">
								</div>
							</div>

							<div class="clear"></div>
						</div>
					</div>
				</form>
			</div> -->

			<div class="col-md-6 app-view-mainCol" style="margin-top: 22px;">
				<form class="form-inline" action="" >
					<div class="main-login main-center">
						<h5>VideoChat Setting</h5>
						<div class="formbody">
							@if($pckg)
							<p style="">Package Title: <span>{{ucfirst($pckg->package_name)}}</span></p>
							<p style="">Expiry Date: {{$expiry_date}} <span style="color:green"> ({{$remeingdays}}) </span> days left</p>
							@endif
							<div class="form-group">
								<label class=" control-label col-sm-3">Video Chat</label>
								<div class="col-sm-8">
									@if($listing_info->videochat == 1)
									<label class="radio-inline"><input type="radio" name="videochat"  value="1" onclick="ChatOn();" checked="">ON</label>
									<label class="radio-inline"><input type="radio" name="videochat" value="0" onclick="ChatOff();">OFF</label>
									@else
									<!-- {{BookingYo::CheckFormBuy($listing_info->listing_id)}} -->
									@if(BookingYo::CheckFormBuy($listing_info->listing_id) == 1)
									<label class="radio-inline"><input type="radio" name="videochat"  value="1" onclick="ChatOn();">ON</label>
									<label class="radio-inline"><input type="radio" name="videochat" value="0" onclick="ChatOff();" checked="">OFF</label>
									@else
									<label class="radio-inline"><input type="radio" name="videochat"  value="1" disabled="">ON</label>
									<label class="radio-inline"><input type="radio" name="videochat" value="0" checked="">OFF</label>
									@endif
									@endif
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3"></label>
								<div class="control-label col-sm-9">
									<!--<button type="button" class="btn btn-info btn-lg" >Save </button>-->
								</div>
							</div>

							<div class="clear"></div>
						</div>
					</div>
				</form>
			</div>

			<div class="col-md-6 verification_div">
				@if($verify == "")
				<div class="verification">
						<h3 class="text-danger">Not Verified</h3>
						<p>Your Business is not verified please click on the button to verify the business</p>
						<a class="btn btn-success" href="{{url('dashboard/verification/'.$listing_id)}}">Verify</a>
				</div>
				@elseif($verify->status == "pending")
				<h4 class="text-warning">Pendig</h4>
				<p>Your Verification request has been send to admin</p>
				@elseif($verify->status == "verified")
				<h3 class="text-success">Verified</h3>
				<p>Your Business is Verified</p>
				@elseif($verify->status == "not_verified")
				<div class="verification">
						<h4>Not Verified</h4>
						<p>Your Business is not verified please click on the button to verify the business</p>
						<a class="btn btn-success" href="{{url('dashboard/verification/'.$listing_id)}}">Verify</a>
				</div>
				@endif
			</div>
		</div>
    	<div class="row" style="margin: 0;">
			<div class="col-md-12 app-view-mainCol">
					<div class="main-login main-center">
					<h5>Forms for your Category</h5>
						<div class="formbody app-formbody">
				<div class="settingtabs">
				<div class="tabcontent active">
					<p>
						</p>


						<form id="PostSubmit" action="{{url('formbuymethod')}}" method="post">
						{{ csrf_field() }}
							<input type="hidden" name="listing_id" value="{{ $listing_id }}"/>
							<input type="hidden" name="service_price">
							<div class="table-responsive">
								<table class="table table-striped table-bordered">
									<tbody>
									<tr class="heading-table">
										<th>Form Name</th>
										<th>Form Price</th>
										<th></th>
										<th></th>
										<th>Form Duration</th>
									</tr>
									@foreach($formcat as $list)
									<!-- <input type="hidden" name="category_id" value="{{ $list->category_id }}"/> -->
									@if(BookingYo::listingcategory($listing_id)->category_id == $list->category_id)
									<tr>
										<td>
										{!!html_entity_decode($list->form_icon) !!} {{$list->form_name}}
										</td>
										<td>$ {{$list->form_price}}</td>

										@if(BookingYo::getformbuy($list->form_id,$listing_id) != null)
										@if(BookingYo::getformbuy($list->form_id,$listing_id)->status == 'Expire')
											<td>
											<label>
												<input type="radio"  class="clickbtn" value="{{$list->form_price}},{{$list->form_id}},0,{{$list->category_id}}" disabled>Enable

											</label>
										</td>
										<td><span style="color: red;font-weight: bold;"> Your package has been expire</span>

										@foreach(BookingYo::form_renew($listing_id) as $renew)

											@if($renew->form_id == $list->form_id)
											<label>
											<span style="color:green">(Please Renew Your Package </span>
												<input type="radio" name="listdata" onclick="PostSubmit();" class="clickbtn" value="{{$list->form_price}},{{$list->form_id}},{{$renew->formbuy_id}}" >
											)
											</label>
											@endif
									    	@endforeach
										</td>
											@else
											<!--<td><select class="js-example-basic-multiple" name="states[]" multiple="multiple">
													<option value="AL">Alabama</option>
														...
													<option value="WY">Wyoming</option>
													</select>-->
													<td>
													<button type="button" class="btn btn-info btn-sm" onclick="getcat('{{$list->category_id}}')">Buy Category</button>
                                              </td>
											<td>
											<label>
												<input type="radio" name="listdata" onclick="PostSubmit();" class="clickbtn" value="{{$list->form_price}},{{$list->form_id}}" disabled>Enable

											</label>
										</td>


										<td>Remaining<span style="color: green;font-weight: bold;"> {{BookingYo::getformbuy($list->form_id,$listing_id)->form_days}}</span>  Days</td>
										@endif
									@else
									<td>
								    	</td>
									<td>
											@if($list->category_id == 20 || $list->category_id == 59 || $list->category_id == 30)
												<label>
													<input type="radio" name="listdata" onclick="PostSubmitWithServices();" class="clickbtn" value="{{$list->form_price}},{{$list->form_id}},0,{{$list->category_id}}">Enable
												</label>
											@else
												<label>
													<input type="radio" name="listdata" onclick="PostSubmit();" class="clickbtn" value="{{$list->form_price}},{{$list->form_id}},0,{{$list->category_id}}">Enable
												</label>
											@endif
										</td>

										<td>{{$list->form_duration}} Days</td>
										@endif
									</tr>
									@endif
									@endforeach
								</tbody></table>
							</div>
						</form>




					<p>If you need another form please click to More Form <button class="btn btn-success pull-right" id="formbtn"> More Form </button></p>
					<form id="moreform" action="{{url('formbuymethod')}}" method="post" style="display:none;margin-top: 30px;">
						{{ csrf_field() }}
							<input type="hidden" name="listing_id" value="{{ $listing_id }}"/>
							<input type="hidden" name="service_price">
							<table class="table table-striped table-bordered">
								<tbody>
								<tr class="heading-table">
									<th>Form Name</th>
									<th>Form Price</th>
									<th></th>
									<th></th>
									<th>Form Duration</th>
								</tr>

									@foreach($formlist as $list)
							  	<tr>
									<td>
									{!!html_entity_decode($list->form_icon) !!} {{$list->form_name}}
									</td>
									<td>$ {{$list->form_price}}</td>

									@if(BookingYo::getformbuy($list->form_id,$listing_id) != null)
                                       <td>
												<button type="button" class="btn btn-info btn-sm" onclick="getcat('{{$list->category_id}}')">Buy Category</button>
                                              </td>
									<td>
										<label>
											<input type="radio" name="listdata" onclick="PostSubmits();" class="clickbtn" value="{{$list->form_price}},{{$list->form_id}},0" disabled>Enable

										</label>
									  </td>

									<td>Remaining<span style="color: green;font-weight: bold;"></span>{{BookingYo::getformbuy($list->form_id,$listing_id)->form_days}} Days</td>
									@else
									<td>
								    	</td>
									<td>
										@if($list->category_id == 20 || $list->category_id == 59 || $list->category_id == 30)
											<label>
												<input type="radio" name="listdata" onclick="PostSubmitsWithServices();" class="clickbtn" value="{{$list->form_price}},{{$list->form_id}},0,{{$list->category_id}}">Enable
											</label>
										@else
											<label>
												<input type="radio" name="listdata" onclick="PostSubmits();" class="clickbtn" value="{{$list->form_price}},{{$list->form_id}},0,{{$list->category_id}}">Enable
											</label>
										@endif
									</td>

									<td>{{$list->form_duration}} Days</td>
									@endif
								</tr>

								@endforeach

							</tbody></table>
						</form>


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


<div id="mychat" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 652px;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Video & Chat Packages</h4>
      </div>
      <div class="modal-body">

		<div class="price-table-wrapper">

    <div class="pricing-table">

    <h2 class="pricing-table__header">- BASIC -</h2>
    <h3 class="pricing-table__price">$50</h3>
		<span class="duration">1 month</span>
		<form action="{{url('/dashboard/videochatpckg')}}" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="listing_id" value="{{$listing_id}}">
		<input type="hidden" name="package_duration" value="30">
		<input type="hidden" name="package_price" value="50">
		<input type="hidden" name="package_name" value="basic">
    <button type="submit" class="pricing-table__button">
      Buy Now!
    </button>
		</form>
    <ul class="pricing-table__list">
      <li>20% discount</li><br>
      <li>24 hour support</li>
    </ul>

  </div>

  <div class="pricing-table featured-table">
    <h2 class="pricing-table__header">- BUSINESS -</h2>
    <h3 class="pricing-table__price">$80</h3>
		<span class="duration">3 months</span>
    <form action="{{url('/dashboard/videochatpckg')}}" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="listing_id" value="{{$listing_id}}">
		<input type="hidden" name="package_duration" value="90">
		<input type="hidden" name="package_price" value="80">
		<input type="hidden" name="package_name" value="business">
    <button type="submit" class="pricing-table__button">
      Buy Now!
    </button>
		</form>
    <ul class="pricing-table__list">
      <li>25% discount</li></br>
      <li>24 hour support</li>
    </ul>
  </div>
		<div class="pricing-table">
			<h2 class="pricing-table__header">- PREMIUM -</h2>
			<h3 class="pricing-table__price">$130</h3>
			<span class="duration">6 months</span>
			<form action="{{url('/dashboard/videochatpckg')}}" method="post">
			{{ csrf_field() }}
			<input type="hidden" name="listing_id" value="{{$listing_id}}">
		<input type="hidden" name="package_duration" value="180">
		<input type="hidden" name="package_price" value="130">
		<input type="hidden" name="package_name" value="premium">
    <button type="submit" class="pricing-table__button">
      Buy Now!
    </button>
		</form>
			<ul class="pricing-table__list">
				<li>40% discount</li><br>
				<li>24 hour support</li>
			</ul>
		</div>
	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
	            <p style="padding-left:15px;">Do you want to buy form of shipping services ?</p>
	          	<div class="alert alert-info cus-alert-info">
				  <strong style="color: #31708f;">Note:</strong>It will charge $4.00 extra to buy form of shipping services.
				</div>
	        </div>
	        <div class="modal-footer">
		        <button type="button" class="btn btn-default" id="modal-btn-yes">Yes</button>
		        <button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
	      	</div>
      	</div>
    </div>
</div>
<!-- Modal -->
  <div class="modal fade" id="mycat" role="dialog">
    <div class="modal-dialog modal-sm" style="width: 500px; !important">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #161e2c;border-top-left-radius: 6px;border-top-right-radius: 3px;color: white;text-align: center;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Buy Category</h4>
        </div>
		<form id="" action="{{url('dashboard/buycategory')}}" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="listind_id" value="{{$listing_id}}">
		<span id="totalinput"></span>
        <div class="modal-body" id="catdata" style="height: 400px;overflow-y: scroll;">

          <p>This is a small modal.</p>
        </div>
        <div class="modal-footer">
		<p id="totalprice" style="float: left;"></p>
		<button type="submit" class="btn btn-primary" id="yes-m" style="display:none">Buy Now</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
		</form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="servicesmore_modal" role="dialog">
    <div class="modal-dialog">
		<div class="modal-content">
	        <div class="modal-header" style="background-color: #161e2c;border-top-left-radius: 6px;border-top-right-radius: 3px;color: white;text-align: center;">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Confirmation</h4>
	        </div>
	        <div class="modal-body">
	          	<div class="alert alert-info cus-alert-info">
				  <strong style="color: #31708f;">Note:</strong>It will charge $4.00 extra to buy form of shipping services.
				</div>
	          	<p style="padding-left:15px;">Do you want to buy form of shipping services ?</p>
	        </div>
	        <div class="modal-footer">
		        <button type="button" class="btn btn-default" id="modal-btn-yes-m">Yes</button>
		        <button type="button" class="btn btn-primary" id="modal-btn-no-m">No</button>
	      	</div>
      	</div>
    </div>
</div>

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
function getcat(id){
	//alert(id);
	//$('#catdata').html(id);
		$.ajax({
		type: 'get',
		url: "{{ url('get-shopping-category/') }}/"+id,
		dataType:'json',
		success: function(response){
            console.log(response);
			var html='';
			html+='<ul>';
			for(var i=0; i<response.length; i++){

				// html+='<div class="checkparent"><lable style="font-size: 15px;font-weight: 600;"><input type="checkbox" name="cat[]" class="checkcat" value="'+response[i].cat_id+'"> '+response[i].cat_title+'</lable><span style="color:green; float:right">5</span><small style="color:orange;">$</small></div><br>';
				  html+= '<li class="appendli_'+response[i].cat_id+'">';
                  html+= '<span class="loading loading_'+response[i].cat_id+'"></span>';
                  html+= '<label> <i  class="fa fa-plus icon-queue lisub_'+response[i].cat_id+'"> </i><input type="checkbox" class="hummingbird"  name="cat[]" value='+response[i].cat_id+' onclick="accord_cat('+response[i].cat_id+');"/> '+response[i].cat_title+'</label>';
                 html+= ' </li><br>';
			}
			html+='</ul>';
			$('#catdata').html(html);
			$('#mycat').modal('show');

		}

	});

}

function accord_cat(ids)
  {
    //alert(ids);
    //$('.fa-plus').removeClass('icon-queue');
    //$('.fa-plus').addClass('icon-queue');
    //$('.loading_'+ids).show();
    if($('.lisub_'+ids).hasClass('fa-minus')) {
      $( '.lisub_'+ids ).toggleClass(function() {
        if ( $( this ).parent().is( ".fa-plus" ) ) {
          return "fa-queue";
        } else {
          return "fa-minus";
        }
      });
      $('#sublevel_'+ids).remove();
      $('.loading_'+ids).hide();
      //$('.loading_'+ids).hide();
      //$('#sublevel_'+ids).toggle();
    }else{
      //$('#loading_'+ids).show();
      $( '.lisub_'+ids ).toggleClass(function() {
        if ( $( this ).parent().is( ".fa-plus" ) ) {
          return "fa-queue";
        } else {
          return "fa-minus";
        }
      });
      $.ajax({
        type: "get",
        url: "{{url('/free_listing/buygetsubcat')}}/"+ids,
        success: function (data, text) {
          $('.sublevelmain').remove();
          //console.log(data);
          var obj = JSON.parse(data);
          if(data == 0){

          }else{
            $('.appendli_'+ids).append(obj.dropdown);
          }
          $('.loading_'+ids).hide();/**/
        },
        //add this error handler you'll get alert
        error: function (request, status, error) {
          alert(request.responseText);
        }
      });
      $('#sublevel_'+ids).toggle();
      //$('.loading_'+ids).hide();
    }
  }
$(document).ready(function () {
   // var ckbox = $('.checkcat');
var total=0;
    $(document).on('click','.hummingbird',function () {
        if ($(this).is(':checked')) {
			var getcatprice= 5;
			var convert=parseInt(getcatprice);

			total+=convert;
			//alert(total);
			$('#yes-m').show();
			$('#totalinput').html('<input type="hidden" name="totalprice" value="'+total+'" >');
			$('#totalprice').html('<span>Total Price= $ '+total+'</span>');
        } else {
			var getcatprice= 5;
			var convert=parseInt(getcatprice);
			total=total-convert;
			if(total < 1){
			$('#yes-m').hide();
			}
			$('#totalinput').html('<input type="hidden" name="totalprice" value="'+total+'" >');
			$('#totalprice').html('<span>Total Price= $ '+total+'</span>');
          //  alert('You Un-Checked it');
        }
    });
});
$('.checkcat').is('checked',function(){
var getcatprice= $(this).closest('.checkparent').find('span').text();
alert(getcatprice);
});
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

function ChatOn () {
	var listing_id = "<?php echo $listing_id; ?>";
	// console.log(listing_id);
	$.ajax({
		type: "POST",
		url:" {{ url('/dashboard/videoChatOn')}}/"+listing_id,
		data: {id:listing_id,_token: '{{ csrf_token() }}'},
		success: function(data){
			toastr.success('Video Chat On successfully', '', {timeOut: 5000, positionClass: "toast-top-right"});
		},
		error: function() {
			$('#gifid').hide();
			$('#loading').hide();
			$('#checkcatid').prop("disabled",false);
			alert("Error posting feed");
		}
	});
}

function ChatOff () {
	var listing_id = "<?php echo $listing_id; ?>";
	// console.log(listing_id);
	$.ajax({
		type: "POST",
		url:" {{ url('/dashboard/videoChatOff')}}/"+listing_id,
		data: {id:listing_id,_token: '{{ csrf_token() }}'},
		success: function(data){
			toastr.success('Video Chat OFF successfully', '', {timeOut: 5000, positionClass: "toast-top-right"});
		},
		error: function() {
			$('#gifid').hide();
			$('#loading').hide();
			$('#checkcatid').prop("disabled",false);
			alert("Error posting feed");
		}
	});
}
</script>

@endsection
@endsection
