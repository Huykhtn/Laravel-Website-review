<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        @if(Route::is(['login']))
		<title>Preskool - Login</title>
		@endif
	
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ URL::asset('assets/img/favicon.png')}}">
    @include('partials.head')
  </head>
  <body>
  <!-- Main Wrapper -->
  <div class="main-wrapper login-body">
		@yield('content')
	</div>
<!-- /Main Wrapper -->

	@include('partials.footer')
 </body>
</html>