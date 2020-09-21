<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('frontend-assets/bootstrap/css/bootstrap.min.css')}}">
    <!-- Custom Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend-assets/css/style.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend-assets/fontawesome/css/all.min.css')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('/frontend-assets/dashboard/img/logo/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('/frontend-assets/dashboard/img/logo/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('/frontend-assets/dashboard/img/logo/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/frontend-assets/dashboard/img/logo/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('/frontend-assets/dashboard/img/logo/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('/frontend-assets/dashboard/img/logo/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('/frontend-assets/dashboard/img/logo/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('/frontend-assets/dashboard/img/logo/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/frontend-assets/dashboard/img/logo/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('/frontend-assets/dashboard/img/logo/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/frontend-assets/dashboard/img/logo/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('/frontend-assets/dashboard/img/logo/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/frontend-assets/dashboard/img/logo/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('/frontend-assets/dashboard/img/logo/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('/frontend-assets/dashboard/img/logo/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <title>Smart Cookie Tutors</title>
    @yield('styling')
  </head>
  <body>
    @include('frontend.includes.header')
    	@yield('content')
    @include('frontend.includes.footer')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="{{asset('frontend-assets/bootstrap/js/popper.min.js')}}" integrity="" crossorigin="anonymous"></script>
    <script src="{{asset('frontend-assets/bootstrap/js/bootstrap.min.js')}}" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/superfish/1.7.10/js/superfish.min.js"></script>
    <!-- Custom Script -->
    <script src="{{ asset('/frontend-assets/js/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend-assets/js/jquery.min.js') }}"></script>
    @yield('script')
    <script>
        var current = location.pathname;
        $('.sf-menu li a').each(function(){
        var $this = $(this);
          // if the current path is like this link, make it active
          if($this.attr('href').indexOf(current) !== -1){
            $this.addClass('active');
          }
        })
        $(".btn-refresh").click(function () {
          $.ajax({
            type: 'GET',
            url: '{{url ("refreshCaptcha")}}',
            success:function (data) {
              $('.captcha span').html(data);
            }
          });
        });

        // var idleMax = 30; // Logout after 30 minutes of IDLE
        // var idleTime = 0;
        //
        // var idleInterval = setInterval("timerIncrement()", 60000);  // 1 minute interval
        // $( "body" ).mousemove(function( event ) {
        //   idleTime = 0; // reset to zero
        // });
        //
        // // count minutes
        // function timerIncrement() {
        //   idleTime = idleTime + 1;
        //   if (idleTime > idleMax) {
        //     window.location="{{url('logout')}}";
        //   }
        // }

        $(document).ready(function(){
					var t;
					 idleTime = 0;
					window.onload = resetTimer;
					window.onmousemove = resetTimer;
					window.onmousedown = resetTimer;  // catches touchscreen presses as well
					window.ontouchstart = resetTimer; // catches touchscreen swipes as well
					window.onclick = resetTimer;      // catches touchpad clicks as well
					window.onkeydown = resetTimer;
					window.addEventListener('scroll', resetTimer, true);
					//Increment the idle time counter every second.
					var idleInterval = setInterval(timerIncrement, 60000);

					function timerIncrement()
					{
						idleTime++;
						if (idleTime >= 30)
						{
							doPreload();
						}
					}

					//Zero the idle timer on mouse movement.
					$(this).mousemove(function(e){
						idleTime = 0;
					});

					function doPreload()
					{
						console.log(idleTime);
				    window.location="{{url('logout')}}";
					}
					function resetTimer() {
						clearTimeout(t);
						idleTime = 0;
					}
				});

    </script>
  </body>
</html>
