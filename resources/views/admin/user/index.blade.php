<?php $page="admin.user.index";?>
@extends('master')
@section('content')     
@component('components.breadcrumb')                
    @slot('title') Users  @endslot
    @slot('li_1') Dashboard @endslot
    @slot('li_2') Users @endslot
@endcomponent		

	<div class="row">
	@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
		<div class="col-sm-12">
		
			<div class="card card-table">
				<div class="card-body">
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Reset Member Password</h3>
							</div>
							
						</div>
						
					</div>
					<form action="{{ route('admin.user.index') }}" method="get">
						<div class="search-form">
							<div class="row">                                
								<div class="col-lg-3 col-md-6">  
									<div class="form-group">
										<input type="text" class="form-control" name="search_phone"  placeholder="Search by phone number">
									</div>
								</div>
								
								<div class="col-lg-2">  
									<div class="search-student-btn">
										<button type="submit" class="btn btn-primary">Search</button>
									</div>
								</div>
							</div>
						</div>
					</form>
					<!-- /Page Header -->
					<div class="table-responsive">
						<table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
							<thead class="student-thread">
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Email</th>
									<th>Full Name</th>
									<th>Gender</th>
									<th>Phone</th>
									<th>Level</th>
									<th>Status</th>
								
									<th class="text-end">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($users as $user)
								
								<tr>
									
									<td>{{ $user->user_id }}</td>
									<td>
										<h2>
											<a>{{ $user->user_name }}</a>
										</h2>
									</td>
									<td>
										<h2>
											<a>{{ $user->email }}</a>
										</h2>
									</td>
									<td>
										<h2>
											<a>{{ $user->fullname }}</a>
										</h2>
									</td>
									<td>
										<h2>
										<a>{{ $user->gender == 1 ? 'Male' : 'Female' }}</a>
										</h2>
									</td>
									<td>
										<h2>
											<a>{{ $user->phone }}</a>
										</h2>
									</td>
									<td>
										<h2>
											@if($user->role_id == 1)
												<a>Admin</a>
											@endif
											@if($user->role_id == 2)
												<a>Teacher</a>
											@endif
											@if($user->role_id == 3)
												<a>Student</a>
											@endif
											
										</h2>
									</td>
									
									<td>
										@if($user->status == 1)
										<span class="badge badge-success">{{ $user->status == 1 ? 'Active' : 'Block' }}</span>
										@endif
										@if($user->status == 2)
										<span class="badge badge-block">{{ $user->status == 1 ? 'Active' : 'Block' }}</span>
										@endif
										
									</td>
									
									<td class="text-end">
										<div class="actions">
										
											<a href="{{ route('admin.user.edit-password', ['id' => $user->user_id]) }}" class="btn btn-sm bg-success-light me-2">
												<i class="feather-edit"></i>
											</a>
											
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>							
		</div>					
	</div>					
@endsection
