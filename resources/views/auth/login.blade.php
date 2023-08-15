@extends('master-without-nav')
@section('content')		
	<div class="login-wrapper">
		<div class="container">
			<div class="loginbox">
				<div class="login-left">
					<img class="img-fluid" src="{{ URL::asset('assets/img/login.png')}}" alt="Logo">
				</div>
				<div class="login-right">
					<div class="login-right-wrap">
						<h1>Welcome to Preskool</h1>
						<!-- Form -->
						<form method="POST" action="{{ route('auth.post-login') }}">
							@csrf
							<div class="text-danger">
							@if($errors->any())
								<h6 style="color:red;">{{$errors->first()}}</h4>
							@endif
							</div>
							<div class="form-group">
								<label >Email <span class="login-danger">*</span></label>
								<input type="text" placeholder="Email" id="email" class="form-control" name="email" value="{{old('name')}}">
								
								<div class="text-danger">
									@error('0')
										{{$message}}
									@enderror
									@error('email')
										{{$message}}
									@enderror
								</div>
							</div>
							
							<div class="form-group pass-group">
								<label >Password <span class="login-danger">*</span></label>
								<input type="password" placeholder="Password" id="password" class="form-control pass-input " name="password" value="{{old('password')}}">
								
								<div class="text-danger">
									@error('0')
										{{$message}}
									@enderror
									@error('password')
										{{$message}}
									@enderror
								</div>
							</div>
							
							<div class="forgotpass">
								<div class="remember-me">
									<label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Remember me
									<input type="checkbox" name="radio">
									<span class="checkmark"></span>
									</label>
								</div>
								
							</div>
							<div class="form-group">
								<button class="btn btn-primary btn-block" type="submit">Login</button>
							</div>
						</form>
						<!-- /Form -->

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection