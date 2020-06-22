@extends('frontend.dashboard.layout.master')

@section('title', 'Listing')

@section('styling')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/dashboard.css') }}">
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
  <div class="container-fluid app-view-mainCol">
	<div class="row">
	@if(session()->has('warning'))
    <div class="alert alert-warning">
        {{ session()->get('warning') }}
    </div>
@endif
	@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

	<div class="cards">
	<div class="row" style="margin: 0">
		<div class="col-md-12 app-view-mainCol">
			<div class="table-responsive" style="margin-top: 15px;">
				<table class="table table-stripped defaulttb">
					<thead>
						<tr>
							<th>News Title</th>
							<th>News Category</th>
							<!--<th>범주</th>-->
							<th>Mutual image</th>
							<th>Representative name</th>
							<th>Mobile Phone Number</th>
							<th width="240px" align="center">Purchase Status</th>
						</tr>
					</thead>

					<tbody>
					

					</tbody>
				</table>

				<div class="pag">
				
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

	//   $('body').on('click', '.pagination a', function(e) {
    //     e.preventDefault();

    //     $('#load a').css('color', '#dfecf6');
    //     $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

    //     var page = $(this).attr('href').split('page=')[1];
    //    //alert(page);
    //    getArticles(page)
    // });
    //  function getArticles(page) {
    //      location.hash=page;
    //      var data=$('#form').serialize();
    //     $.ajax({
    //         url : '/ajex/products?page='+page,
    //         data: data
    //     }).done(function (data) {
    //         $('.show-jobs').html(data);

    //     }).fail(function () {
    //         alert('Articles could not be loaded.');
    //     });
    // }
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
   </script>
	@endsection
