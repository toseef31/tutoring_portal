@extends('frontend.dashboard.layout.master')

<!-- @section('title', 'My Profile') -->
@section('title', 'View Agreement')


@section('styling')
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
				<a class="navbar-brand" href="#">Credits</a>
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
							<h3 class="title">Credits</h3>

							<hr>
						</div>
            @include('frontend.dashboard.menu.alerts')
						<div class="content">
							<form class="form-horizontals profile-form" action="{{url('user-portal/sign-agreement')}}" method="post">
								{{ csrf_field() }}

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<p>Text for Credit</p>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<p>Description</p>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<select class="form-control" name="credit_balance">
												<option value="">Select Credit</option>
												@if(SCT::checkCredit(auth()->user()->id) !='')
												<option value="4">4</option>
												<option value="6">6</option>
												<option value="8">8</option>
												<option value="10">10</option>
												@else
												<option value="1">1</option>
												@endif
											</select>
										</div>
									</div>
								</div>
								<div class="text-center">
									@if($credit !='')
									<button type="submit" class="btn btn-info btn-green btn-wd">Buy</button>
									@else
									<button type="submit" class="btn btn-info btn-green btn-wd" disabled>Buy</button>
									@endif
								</div>
								<div class="clearfix"></div>
							</form>

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
