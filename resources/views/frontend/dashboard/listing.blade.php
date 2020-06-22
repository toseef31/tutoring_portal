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
							<th>Business name</th>
							<th>Business name</th>
							<!--<th>범주</th>-->
							<th>Mutual image</th>
							<th>Representative name</th>
							<th>Mobile Phone Number</th>
							<th width="240px" align="center">Purchase Status</th>
						</tr>
					</thead>

					<tbody>
						@foreach($listing as $list)
						<tr>
							<td>{{$list->firstname}}</td>
							<td>{{$list->lastname}}</td>
							<td>

								<div class="media">
									<?php
									$cover_image = $list->listingimg;
									 ?>
									@if($cover_image !="")
									<img src="{{asset('/frontend-assets/images/listingimg/'.$list->listingimg->filename)}}" style="width:60px;" class="media-photo">
									@else
									<img src="{{asset('/frontend-assets/no-image.jpeg')}}" style="width:60px;" class="media-photo">
									@endif
								</div>
							</td>
							<td>{{$list->companyname}}</td>
							<td>{{$list->mobilenumber}}</td>
							<td>
								<a href="{{ url('/business-profile/'.$list->listing_id)}}" class="cstbtn color_orange" target="_blank" data-toggle="tooltip" title="" data-original-title="View"><i class="fa fa-eye"></i></a>
								<a href="{{url('/edit-free-listing/'.$list->listing_id)}}" class="cstbtn color_green" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
								<a href="{{ url('dashboard/form-listing/'.$list->listing_id)}}" class="cstbtn color_blue" data-toggle="tooltip" title="" data-original-title="Forms"><i class="fa fa-file-word-o"></i></a>
								<!-- <a href="{{ url('dashboard/addstore/'.$list->listing_id)}}" class="cstbtn color_darkblue" data-toggle="tooltip" title="" data-original-title="Add Stores"><i class="fa fa-home"></i></a> -->
								@foreach (BookingYo::form_icon($list->listing_id) as $li)
								@if($li->category_id == 11)
                 	<a href="{{url($li->form_url.'/')}}" class="cstbtn {{$li->form_class}}" data-toggle="tooltip" title="" data-original-title="{{$li->form_tooltip}}">{!!html_entity_decode($li->form_icon) !!}</a>
									@else
								 	<a href="{{url($li->form_url.'/'.$li->listing_id)}}" class="cstbtn {{$li->form_class}}" data-toggle="tooltip" title="" data-original-title="{{$li->form_tooltip}}">{!!html_entity_decode($li->form_icon) !!}</a>
									@endif
								@endforeach



							</td>
						</tr>
						@endforeach

					</tbody>
				</table>

				<div class="pag">
				<?php echo $listing->render(); ?>
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
