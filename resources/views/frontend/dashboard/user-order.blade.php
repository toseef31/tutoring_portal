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
		<div class="col-md-12 text-center">
			<button class="btn btn-success btn-lg" id="orderOnline"> <i class="fa fa-home"></i> Online Order</button>
		</div>
	</div>
	<div class="row" style="margin: 30px auto;" id="orderOnlineTable">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Order Numnber</th>
							<th>Product Image</th>
							<th>Product Name</th>
							<th>Business Name</th>
							<th>Address</th>
							<th>Email</th>
							<th>Toll Free</th>
							<th>Progress</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($order_list as $order)
						<tr class="tbl_show{{$order->order_id}}">
							<td>{{$order->order_id}}</td>
							@if($order->order_type == 'dailyneeds')
							<td><img src="{{asset('frontend-assets/images/dashboard/grocery_images/'.$order->image)}}" style=" width: 100%;"></td>
							@else
							<td><img src="{{asset('frontend-assets/images/dashboard/shopping_images/color/'.$order->image)}}" style=" width: 100%;"></td>
							@endif
							<td>{{$order->product_name}}</td>
							<td>{{$order->listinfo->bus_name}}</td>
							<td>{{$order->address}}</td>
							<td>{{$order->listinfo->email_id}}</td>
							<td>{{$order->listinfo->toll_free}}</td>
							<td>On way</td>
							<td class="text-center">
								<a href="{{url('/dashboard/show-user-order/'.$order->order_id)}}" class="btn btn-xs btn-warning">View Order</a>
							</td>
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


	function delete_product(product_id) {
	// alert(product_id);
	if (confirm('Are you sure want to delete this menu')) {
			$.ajax({
				url: "{{url('/dashboard/delete_shopping_product')}}/"+product_id,
				success: function (response) {
					console.log(response);
					if (response == "1") {
						toastr.success('Product Deleted successfully', '', {timeOut: 5000, positionClass: "toast-top-right"});
						$('#tbl_show'+product_id).remove();

					}
				}
			});
	}
}
</script>
@endsection
