<?php $page="admin.lesson.index";?>
@extends('master')
@section('content')     
@component('components.breadcrumb')                
    @slot('title') lessons  @endslot
    @slot('li_1') Dashboard @endslot
    @slot('li_2') lessons @endslot
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
							@if(Auth::user()->role_id == 2)
							<div class="col">
								<h3 class="page-title">Lesson List</h3>
							</div>
							@endif
							@if(Auth::user()->role_id == 1)
							<form action="{{ route('admin.lesson.index') }}" method="get">
								<div class="row">
									<div class="col-md-4">  
										<div class="form-group local-forms">
											<label>Course <span class="login-danger">*</span></label>
											<select name="course_id" class="form-control select">
											
											@if(isset($_GET['course_id']))
										
												@foreach ($courses  as $course)
												@if($_GET['course_id'] == $course->course_id)
												<option value="{{ $_GET['course_id'] }}">{{ $course->course_name }}</option>
												@endif
												@endforeach
	
											@endif 
												<option>Please choose Course</option>
												@foreach ($courses  as $course)
												<option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
												@endforeach
												
											</select>
										</div>
									</div>
									
									<div class="col-md-4">
										<button type="submit" class="btn btn-primary">Filter</button>
									</div>
								</div>
							</form>
							@endif
							</div>
							<div class="col-auto text-end float-end ms-auto download-grp">
								@if(Auth::user()->role_id == 2)
								<a href="{{route('admin.lesson.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
								@endif
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="table-responsive">
						<table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
							<thead class="student-thread">
								<tr>
									<th>Lesson Name</th>
									<th>Course</th>
									@if(Auth::user()->role_id == 1)
									<th>Teacher</th>
									@endif
									<th>Weekday</th>
									<th>Start Time</th>
									<th>End Time</th>
									<th>Status</th>
									
									<th class="text-end">Action</th>
									
								</tr>
							</thead>
							<tbody>
							@foreach ($lessons as $lesson)
								<tr>
								<td>
								<h2>
									<a>{{ $lesson->lesson_name }}</a>
										
									</h2>
								</td>
									
									<td>
									<h2>
										<a>{{ $lesson->course_name }}</a>
										</h2>
									</td>
									@if(Auth::user()->role_id == 1)
									<td>
										<h2>
											<a>{{ $lesson->user_name }}</a>
										</h2>
									</td>
									@endif
									<td>
										<h2>
											
											<a>{{ $lesson->weekday == 1 ? 'Monday' : '' }}</a>
											<a>{{ $lesson->weekday == 2 ? 'Tuesday' : '' }}</a>
											<a>{{ $lesson->weekday == 3 ? 'Wednesday' : '' }}</a>
											<a>{{ $lesson->weekday == 4 ? 'Thursday' : '' }}</a>
											<a>{{ $lesson->weekday == 5 ? 'Friday' : '' }}</a>

										</h2>
									</td>
									
									
									<td>
										<h2>
											<a>{{ $lesson->start_time }}</a>
										</h2>
									</td>
									<td>
										<h2>
											<a>{{ $lesson->end_time }}</a>
										</h2>
									</td>
									<td>
										<h2>
											@if($lesson->status == 1)
											<span class="badge badge-success">{{ $lesson->status == 1 ? 'Active' : 'Block' }}</span>
											@endif
											@if($lesson->status == 2)
											<span class="badge badge-block">{{ $lesson->status == 1 ? 'Active' : 'Block' }}</span>
											@endif
										</h2>
									</td>
									
									<td class="text-end">
									<div class="actions">
										@if(Auth::user()->role_id == 2)
										<a href="{{ route('admin.lesson.edit', ['id' => $lesson->lesson_id]) }}" class="btn btn-sm bg-success-light me-2">
											<i class="feather-edit"></i>
										</a>
										@endif
										<a onClick="return confirmDelete ()" href="{{ route('admin.lesson.destroy', ['id' => $lesson->lesson_id]) }}" class="btn btn-sm bg-danger-light me-2">
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
