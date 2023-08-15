<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		@if(Route::is(['components']))
		<title>Preskool - Components</title>
		@endif

		<!-- Favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/img/favicon.png')}}">
	<style type="text/css">
		.d-none{
			display: none;
		}
		
	</style>
    @include('partials.head')
  </head>
	
  @if(Route::is(['error-404']))
  <body class="error-page">
  @endif
  <body>
  <!-- Main Wrapper -->
<div class="main-wrapper">
	@include('partials.header')
	@include('partials.nav')

	<!-- Page Wrapper --> 
        <div class="page-wrapper">
            <div class="content container-fluid">
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif

			@yield('content')

			</div>
    		
		</div>
	 <!-- /Page Wrapper -->
	
</div>
<!-- /Main Wrapper -->
@include('partials.footer-scripts')

<script>
    function confirmDelete () {
        if (window.confirm("Do you want to delete this row ?")) {
            return true;
        }

        return false
    }

  </script>
  <script src="{{ asset('js/main.js') }}"></script>
 </body>
</html>