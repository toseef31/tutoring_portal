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
		<a class="btn btn-success btn-lg" href="{{url('/dashboard/onlineFoodOrder')}}"> <i class="fa fa-home"></i> My Stores</a>
		<a class="btn btn-success btn-lg"  href="{{url('/dashboard/addstore/'.$listing_id)}}"> <i class="fa fa-list"></i> Add Store</a>
							
		</div>
	</div>
	<div class="row" style="margin: 30px auto;" id="orderOnlineTable">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Store Name</th>
							<th>Servie Type</th>
							<th>Address</th>
							<th>Mobile Numnber</th>
							<th>Email Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>OF-123</td>
							<td>Zeeshan</td>
							<td>Islamabad</td>
							<td>0587952241</td>
							<td>zeehsna@gmail.com</td>
							<td>On way</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- Category List -->
	
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


	function delete_category(category_id) {
	// alert(menu_id);
	if (confirm('Are you sure want to delete this menu')) {
			$.ajax({
				url: "{{url('/dashboard/delete_category')}}/"+category_id,
				success: function (response) {
					console.log(response);
					if (response == "1") {
						toastr.success('Category Deleted successfully', '', {timeOut: 5000, positionClass: "toast-top-right"});
						$('#tbl_show'+category_id).remove();

					}
				}
			});
	}
}
</script>
@endsection
