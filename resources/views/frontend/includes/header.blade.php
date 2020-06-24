<nav class="navbar navbar-default sticky-top">
	<!-- <div class="top-line d-none d-sm-block hidden-xs">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-6">
					<p> <span><i class="fa fa-phone"></i><a href="tel:0123 - 45678">0123 - 45678</a></span> <span><i class="fa fa-envelope-o"></i><a href="mailto:info@company.com">info@company.com</a></span> </p>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-6 text-right">
					<p> <span><i class="fa fa-certificate"></i><a href="certificates.html">Our Certifications</a></span> <span><i class="fa fa-file-pdf-o"></i><a href="brochure.pdf">Download Brochure</a></span> </p>
				</div>
			</div>
		</div>
	</div> -->
	<div class="header-inner" style="height: 120px;">
		<div class="container">

				<div class="row">
						<div class="col-md-12">
								<div class="brand">
									<a href="{{url('/user-portal')}}">
										<img src="{{asset('frontend-assets/images/logo.png')}}" style="height: 105px; padding-top: 10px;">
									</a> </div>
								<nav  id="nav-wrap" class="main-nav">
									<a id="toggle-btn" class="navbar-toggler"><i class="fa fa-bars"></i> </a>
								<ul class="sf-menu">
										<!-- <li class=""> <a href="index.html">Home</a> </li> -->
										<!-- <li> <a href="about-us.html">About Us </a></li>
										<li> <a href="products.html">Products</a></li>
										<li> <a href="exports.html">Exports</a></li>
										<li> <a href="clients.html">Clients</a> </li> -->
										<!-- <li> <a href="">Contact</a> </li> -->
										@if(\Auth::check())
										<li class="dropdown">
											<a href="" class="dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<img src="{{asset('frontend-assets/images/user.jpg')}}" class="rounded-circle">{{auth()->user()->f_name}}</a>
											<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							          <a class="dropdown-item" href="{{url('/user-portal')}}"><i class="fas fa-tachometer-alt pr-2"></i> Dashboard</a>
							          <a class="dropdown-item" href="{{url('user-portal/change-password')}}"><i class="fas fa-lock pr-2"></i> Change Password</a>
							          <a href="{{url('/logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a>
							        </div>
										</li>
										@else
										<li> <a href="{{url('/register')}}">Register</a> </li>
										<li> <a href="{{url('/login')}}">Login</a> </li>
										@endif
								</ul>
								</nav> </div>
				</div>
			</div>
		</div>
	</div>
</nav>
<!-- <nav class="navbar navbar-expand-md navbar-light bg-light">
  <div class="container">
   	<div class="row">
   		<div class="col-md-12">
   			<a href="#" class="navbar-brand">Brand</a>
   			<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
   			    <span class="navbar-toggler-icon"></span>
   			</button>

   			<div class="collapse navbar-collapse" id="navbarCollapse">
   			    <div class="navbar-nav">
   			        <a href="#" class="nav-item nav-link active">Home</a>
   			        <a href="#" class="nav-item nav-link">Profile</a>
   			        <a href="#" class="nav-item nav-link">Messages</a>
   			        <a href="#" class="nav-item nav-link disabled" tabindex="-1">Reports</a>
   			    </div>
   			    <div class="navbar-nav ml-auto">
   			        <a href="#" class="nav-item nav-link">Login</a>
   			    </div>
   			</div>
   		</div>
   	</div>
  </div>
</nav> -->
