@extends('frontend.layouts.master')
@section('styling')
@endsection
@section('content')
<div class="container">
	<div class="row justify-content-center mt-5 mb-8">
		<div class="text-center w-100 mt-4">
			<!-- <img src="{{asset('frontend-assets/images/logo.png')}}" style="width:13%"> -->
		</div>
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
			<h3 class="text-uppercase mb-3 mt-3 text-center">Account Login</h3>
			@if(Session::has('verify'))
			<div class="alert alert-success">
				{{ Session::get('verify') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
			@if(Session::has('loginAlert'))
			<div class="alert alert-danger">
				{{ Session::get('loginAlert') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
			@if(Session::has('passwordSuccess'))
			<div class="alert alert-success">
				 {{ Session::get('passwordSuccess') }}
				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				 <span aria-hidden="true">&times;</span>
				 </button>
			</div>
			@endif
			@if(Session::has('registerSuccess'))
			<div class="alert alert-success">
				 {{ Session::get('registerSuccess') }}
				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				 <span aria-hidden="true">&times;</span>
				 </button>
			</div>
			@endif
			<div class="login-form pb-5">
				<form action="" method="post">
					{{ csrf_field() }}
				  <div class="form-group">
				    <input type="email" class="form-control" placeholder="Enter email" id="email" onkeyup="checkInput();" name="email">
				  </div>
				  <div class="form-group">
				    <input type="password" class="form-control" placeholder="Enter password" onkeyup="checkInput();" id="pwd" name="password">
				  </div>
				  <div class="form-group form-check">
				    <!-- <label class="form-check-label text-danger">
				      <input class="form-check-input" type="checkbox"> Remember me
				    </label> -->
				    <a href="{{url('forget-password')}}" class="float-right">Forget Password?</a>
				  </div>
				  <button type="submit" id="submit-btn" class="btn bg-gray" disabled>Login</button>
					 <!-- <a href="{{url('/register')}}" class="float-right mt-3">Creat new account</a> -->
					 <a href="{{url('/register')}}" class="btn btn-default btn-green">Register</a>
				</form>

			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
	function checkInput() {
		var email = $('#email').val();
		var password = $('#pwd').val();
		// alert(email);
		if (email !='' && password !='') {
			$('#submit-btn').addClass("btn-green");
			$('#submit-btn').removeClass("bg-gray");
			$('#submit-btn').prop('disabled', false);
		}else {
			$('#submit-btn').addClass("bg-gray");
			$('#submit-btn').removeClass("btn-green");
			$('#submit-btn').prop('disabled', true);
		}
	}
</script>
@endsection
