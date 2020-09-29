@extends('frontend.dashboard.layout.master')

@section('title', 'View Agreement')


@section('styling')
@endsection
@section('content')

@include('frontend.dashboard.menu.menu')
<style media="screen">
	@media (max-width:490px) {
		.pdf_view {
			width: 100% !important;
		}
	}
	@media only screen
  and (min-device-width: 768px)
  and (max-device-width: 1024px)
  and (-webkit-min-device-pixel-ratio: 1) {
		.pdf_view {
			width: 100% !important;
		}
}
@media (min-width: 992px){
	.col-md-9{
		width: 100%;
	}
}
</style>
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
				@if($agreement !='')
	        @if(SCT::checkAggrementSend($agreement->aggreement_id,$agreement->user_id)->status == 'Awaiting Signature')
					<a class="navbar-brand" href="#">Sign Agreement</a>
	        @else
	        <a class="navbar-brand" href="#">Signed Agreement</a>
	        @endif
				@endif
			</div>

		</div>
	</nav>


	<div class="content">
		<div class="container-fluid app-view-mainCol">
			<div class="row">
				<!-- <div class="col-lg-4 col-md-5 app-view-mainCol">
					<div class="cards cards-user">
						<div class="image">
							<img src="{{asset('frontend-assets/images/dashboard/background.jpg')}}" alt="...">
						</div>
						<div class="content">
							<div class="author">
								<div class="re-img-box">
									<img class="avatar border-white" src="" alt="...">
									<div class="re-img-toolkit">
										<div class="re-file-btn">
											Change <i class="fa fa-camera"></i>
											<input type="file" class="upload" id="imageFile"  name="image"  onchange="uploadpicture(this)">
										</div>

									</div>
								</div>

								<h4 class="title" id="userName">Zeeshan<br>

								</h4>
							</div>

						</div>
						<hr>
						<div class="text-center">
							<div class="row">

							</div>
						</div>
					</div>

				</div> -->
				<div class="col-lg-9 col-md-9 app-view-mainCol">
					<div class="cards">
						<div class="header">
							@if($agreement !='')
	              @if(SCT::checkAggrementSend($agreement->aggreement_id,$agreement->user_id)->status == 'Awaiting Signature')
								<h3 class="title"><img src="{{asset('/frontend-assets/images/glasses.png')}}" class="glass-img" alt="logo"><span class="page-title">Sign Agreement</span></h3>
	              @else
								<h3 class="title"><img src="{{asset('/frontend-assets/images/glasses.png')}}" class="glass-img" alt="logo"><span class="page-title">Signed Agreement</span></h3>
	              @endif
              @endif
							<hr>
						</div>
            @include('frontend.dashboard.menu.alerts')
						<div class="content">
							@if($agreement !='')
							<form class="form-horizontals profile-form" action="{{url('user-portal/sign-agreement')}}" method="post">
								{{ csrf_field() }}
								<input type="hidden" name="aggreement_id" value="{{$agreement->aggreement_id}}">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Agreement Name</label>
											<input type="text" class="form-controls border-input" placeholder="Enter Student Name"  name="aggreement_name" value="{{$agreement->aggreement_name}}" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
                      @if(SCT::checkAggrementSend($agreement->aggreement_id,$agreement->user_id)->status == 'Awaiting Signature')
                      <embed class="pdf_view"  src="{{ url('user-portal/show_agreement/'.$agreement->aggreement_id) }}#toolbar=0&navpanes=0&scrollbar=0"
                        style="width:700px; height:800px;"
                        frameborder="0">
                      @else
                      <embed class="pdf_view" src="{{ url('user-portal/show_agreement/'.$agreement->aggreement_id) }}"
                        style="width:700px; height:800px;"
                        frameborder="0">
                      @endif
										</div>
									</div>
								</div>
                @if(SCT::checkAggrementSend($agreement->aggreement_id,$agreement->user_id)->status == 'Awaiting Signature')
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Name</label>
											<input type="text" class="form-control border-input" placeholder="Enter Name" id="user_name" name="user_name" required>
										</div>
									</div>
								</div>
                <div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Date</label>
											<input type="text" class="form-control border-input" placeholder="Enter Date" id="date" name="date" required>
										</div>
									</div>
								</div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="terms" required> I agree to terms of the agreement
                      </label>
                    </div>
                  </div>
                </div>


								<div class="text-center">
									<button type="submit" class="btn btn-info btn-success btn-wd">Submit</button>
								</div>
                @endif
								<div class="clearfix"></div>
							</form>
							@else
							<p>Sorry No Agreement Available for you.</p>
							@endif
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>


</div>
@endsection

@section('script')


@endsection
