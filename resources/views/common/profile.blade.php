@extends('master')
 
@section('content')     
@component('components.breadcrumb')                
    @slot('title') Profile @endslot
    @slot('li_1') Dashboard @endslot
    @slot('li_2') Profile @endslot
@endcomponent 
					
	<div class="row">
		<div class="col-md-12">
			<div class="profile-header">
				<div class="row align-items-center">
				<div class="col-auto profile-image">
						<a href="#">
							<img class="rounded-circle" alt="User Image" src="{{ URL::asset('assets/img/profiles/avatar-02.jpg')}}">
						</a>
					</div>
					<div class="col ms-md-n2 profile-user-info">
						<h4 class="user-name mb-0">{{ $users->user_name }}</h4>
						<div class="row">
							<h5 class="card-title">Role:  {{ $users->title }}</h5>
						</div>
						
						@if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
						
						<div class="user-Location">
							<h5> Course: {{ $users->course_name }}</h5>
						</div>
						@endif
					</div>
					
				</div>
			</div>
			
			<div class="profile-menu">
				<ul class="nav nav-tabs nav-tabs-solid">
					<li class="nav-item">
						<a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#password_tab">Password</a>
					</li>
				</ul>
			</div>	
			<div class="tab-content profile-tab-cont">
				
				<!-- Personal Details Tab -->
				<div class="tab-pane fade show active" id="per_details_tab">
					
					<!-- Account Status -->
					<div class="row">
						<div class="col-lg-9">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title d-flex justify-content-between">
										<span>Account Status</span>
										<!-- <a class="edit-link" href="#"><i class="far fa-edit me-1"></i> Edit</a> -->
									</h5>
									<button class="btn btn-success" type="button"><i class="fe fe-check-verified"></i> {{ $users->status == 1 ? 'Active' : 'Block'}}</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /Account Status -->

					<!-- Personal Details -->
					<div class="row">
						<div class="col-lg-9">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title d-flex justify-content-between">
										<span>Personal Details</span> 
										
										<a class="edit-link" href="{{ route('edit-profile', ['id' => $users->user_id]) }}"><i class="far fa-edit me-1"></i>Edit</a>
										
									</h5>
									
									<div class="row">
										<p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Name</p>
										<p class="col-sm-9">{{ $users->user_name }}</p>
									</div>
									<div class="row">
										<p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Gender</p>
										<p class="col-sm-9">{{ $users->gender == 1 ? 'Male' : 'Female' }}</p>
										
									</div>
									<div class="row">
										<p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email ID</p>
										<p class="col-sm-9">{{ $users->email }}</p>
									</div>
									<div class="row">
										<p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Mobile</p>
										<p class="col-sm-9">{{ $users->phone }}</p>
									</div>
									
								</div>
							</div>
							
						</div>

					</div>
					<!-- /Personal Details -->

				</div>
				<!-- /Personal Details Tab -->
				
				<!-- Change Password Tab -->
				<div id="password_tab" class="tab-pane fade">
				
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Change Password</h5>
							<div class="row">
								<div class="col-md-10 col-lg-6">
									<form action="{{ route('change-password') }}" method="POST">
									@csrf
										<div class="form-group">
											<label>Old Password <span class="login-danger">*</span></label>
											<input type="password" class="form-control" name="current_password" placeholder="Enter Old Password">
										</div>
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
				<!-- /Change Password Tab -->
				
			</div>
		</div>
	</div>
@endsection
