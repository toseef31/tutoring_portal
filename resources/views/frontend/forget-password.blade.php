@extends('frontend.layouts.master')
@section('styling')
@endsection
@section('content')
<div class="container">
	<div class="row justify-content-center mt-5 mb-8">
		<!-- <div class="text-center w-100 mt-4">
			<img src="{{asset('frontend-assets/images/logo.jpg')}}" style="width:13%">
		</div> -->
		<!-- <div class="col-md-4 col-xs-12 mt-5 mb-5">
			<div class="px-3 my-3">
				<a href="" class="btn btn-facebook btn-block facebook text-left mb-4 py-2 text-white"><i class="fab fa-facebook pr-2"></i> Find us on Facebook</a>
				<a href="" class="btn btn-instagram btn-block facebook text-left mb-4 py-2 text-white"><i class="fab fa-instagram pr-2"></i> Find us on Instagram</a>
				<a href="" class="btn btn-twitter btn-block facebook text-left mb-4 py-2 text-white"><i class="fab fa-twitter pr-2"></i> Find us on Twitter</a>
				<a href="" class="btn btn-linkedin btn-block facebook text-left mb-4 py-2 text-white"><i class="fab fa-linkedin pr-2"></i> Find us on Linkdin</a>
				<a href="" class="btn btn-youtube btn-block facebook text-left mb-4 py-2 text-white"><i class="fab fa-youtube pr-2"></i> Find us on Youtube</a>
			</div>
		</div> -->
		<div class="col-md-5 col-xs-12 mt-5 mb-5 shadow rounded">
			<h3 class="text-uppercase mb-3 mt-3 text-center">Reset Password</h3>
			@if(Session::has('verify'))
			<div class="alert alert-success">
				{{ Session::get('verify') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
			@if(Session::has('resetAlert'))
			<div class="alert alert-danger">
				 {{ Session::get('resetAlert') }}
				 <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right: 30px;">
				 <span aria-hidden="true">&times;</span>
				 </button>
			</div>
			@endif
			@if(Session::has('resetSuccess'))
			<div class="alert alert-success">
				 {{ Session::get('resetSuccess') }}
				 <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right: 30px;">
				 <span aria-hidden="true">&times;</span>
				 </button>
			</div>
			@endif
			<div class="login-form pb-5">
				<form action="{{ url('/sendResetLinkEmail') }}" method="post">
					{{ csrf_field() }}
				  <div class="form-group">
				    <input type="email" class="form-control" placeholder="Enter email" id="email" name="email">
				  </div>

				  <button type="submit" class="btn btn-green">Submit</button>
				</form>

			</div>
		</div>
	</div>
</div>
@endsection
@section('script')

@endsection
