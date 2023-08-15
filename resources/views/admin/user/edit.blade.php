
@extends('master')
@section('content')		
@component('components.breadcrumb')                
    @slot('title') Users @endslot
    @slot('li_1') User @endslot
    @slot('li_2') Reset Pass @endslot
@endcomponent	

<div class="row">
	<div class="col-sm-12">
	
		<!-- <div class="card comman-shadow"> -->
			<div class="card-body">
			<!-- <div id="password_tab" class="tab-pane fade"> -->
				
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Reset Password</h5>
						<div class="row">
							<div class="col-md-10 col-lg-6">
								<form action="{{ route('admin.user.update-password', ['id' => $user->user_id]) }}" method="POST">
								@csrf
								
								<div class="form-group">
									<label >Name <span class="login-danger"></span></label>
									<input class="form-control" name="user_name" value="{{ old('user_name', $user->user_name) }}" type="text" placeholder="Enter Name" disabled="disabled" >
								
								</div>
						
								<div class="form-group">
									<label >Email <span class="login-danger"></span></label>
									<input class="form-control" name="email" value="{{ old('email', $user->email) }}" type="text" placeholder="Enter Email" disabled="disabled">
								
								</div>
						
								<!-- <div class="form-group">
									<label>Old Password <span class="login-danger">*</span></label>
									<input type="password" class="form-control" name="current_password" value="{{ old('password', $user->password) }}">
								</div> -->
								<div class="form-group">
									<label>New Password <span class="login-danger">*</span></label>
									<input type="password" class="form-control" name="password" placeholder="Enter New Password">
								</div>
								<div class="form-group">
									<label>Confirm Password <span class="login-danger">*</span></label>
									<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm New Password">
								</div>
								<button class="btn btn-primary" type="submit">Save Changes</button>
								</form>
							</div>
						</div>
					</div>
				</div>

		</div>

</div>		
                
@endsection
