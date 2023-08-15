<?php $page="admin.course.index";?>
@extends('master')
@section('content')     
@component('components.breadcrumb')                
    @slot('title') Courses  @endslot
    @slot('li_1') Dashboard @endslot
    @slot('li_2') Courses @endslot
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
						<div class="col-md-8">
							<form action="{{ route('admin.course.index') }}" method="get">
								<div class="row">
									<div class="col-md-4">  
										<div class="form-group local-forms">
											<label>Major <span class="login-danger">*</span></label>
											<select name="major_id" class="form-control select">
											
											@if(isset($_GET['major_id']))
										
												@foreach ($majors  as $major)
												@if($_GET['major_id'] == $major->major_id)
												<option value="{{ $_GET['major_id'] }}">{{ $major->major_name }}</option>
												@endif
												@endforeach
	
											@endif 
												<option>Please choose Major</option>
												@foreach ($majors  as $major)
												<option value="{{ $major->major_id }}">{{ $major->major_name }}</option>
												@endforeach
												
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<button type="submit" class="btn btn-primary">Filter</button>
									</div>
								</div>
							</form>
						</div>
						
							<div class="col-auto text-end float-end ms-auto download-grp">
								
								<a href="{{route('admin.course.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="table-responsive">
						<table class="table border-0 star-student table-hover table-center mb-0 datatable table-responsive">
							<thead class="student-thread">
								<tr>
									<!-- <th>ID</th> -->
									<th>Course Name</th>
									<th>Description</th>
									
									<th>Major Name</th>
									<th>Status</th>
									<th class="text-end">Action</th>
								</tr>
							</thead>
							<tbody>
							@foreach ($courses as $course)
							
								<tr>
									
									
									<td>
										<h2>
											<a>{{ $course->course_name }}</a>
										</h2>
									</td>
									<td>
										<h2>
											<a>{{ $course->description }}</a>
										</h2>
									</td>
									
									
									
									<td>
										<h2>
											<a>{{ $course->major_name }}</a>
										</h2>
									</td>
									<td>
										<h2>
											@if($course->status == 1)
											<span class="badge badge-success">{{ $course->status == 1 ? 'Active' : 'Block' }}</span>
											@endif
											@if($course->status == 2)
											<span class="badge badge-block">{{ $course->status == 1 ? 'Active' : 'Block' }}</span>
											@endif
											
										</h2>
									</td>
									<td class="text-end">
									<div class="actions">
										<a href="{{ route('admin.student.list', ['course_id' => $course->course_id]) }}" class="btn btn-sm bg-success-light me-2">
											<i class="feather-eye"></i>
										</a>
										<a href="{{ route('admin.course.edit', $course->course_id) }}" class="btn btn-sm bg-success-light me-2">
											<i class="feather-edit"></i>
										</a>
										<a onClick="return confirmDelete ()" href="{{ route('admin.course.destroy', $course->course_id) }}" class="btn btn-sm bg-danger-light me-2">
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
