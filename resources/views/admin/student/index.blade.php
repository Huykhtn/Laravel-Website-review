<?php $page="admin.student.index";?>
@extends('master')
@section('content')     
@component('components.breadcrumb')                
    @slot('title') Student  @endslot
    @slot('li_1') Dashboard @endslot
    @slot('li_2') Student @endslot
@endcomponent
@component('components.search')  
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
								<h3 class="page-title">All Student List</h3>
							</div>
							<div class="col-auto text-end float-end ms-auto download-grp">
								
							<a href="{{route('admin.teacher.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="table-responsive">
						<table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
							<thead class="student-thread">
								<tr>
									
									<th>Name</th>
									<th>Course</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Level</th>
									<th>Status</th>
									<th class="text-end">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($users as $user)
								
								<tr>

									<td>
										<h2>
											<a>{{ $user->user_name }}</a>
										</h2>
									</td>
                                    <td>
										<h2>
											<a>{{ $user->course_name }}</a>
										</h2>
									</td>
									<td>
										<h2>
											<a>{{ $user->email }}</a>
										</h2>
									</td>
									<td>
										<h2>
											<a>{{ $user->phone }}</a>
										</h2>
									</td>
									
									<td>
										<h2>
											<a>{{ $user->role_id == 3 ? 'Student' : '' }}</a>
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
										
                                            <a href="{{ route('admin.student.detail', ['id' => $user->user_id]) }}" class="btn btn-sm bg-success-light me-2">
												<i class="feather-eye"></i>
											</a>
											<a href="{{ route('admin.student.edit', ['id' => $user->user_id]) }}" class="btn btn-sm bg-success-light me-2">
												<i class="feather-edit"></i>
											</a>
											<a onClick="return confirmDelete ()" href="{{ route('admin.student.destroy', ['id' => $user->user_id]) }}" class="btn btn-sm bg-danger-light">
												<i class="feather-trash"></i>
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
