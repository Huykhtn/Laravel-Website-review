<?php $page="admin.exam.index";?>
@extends('master')
@section('content')		
@component('components.breadcrumb')                
    @slot('title') Practice @endslot
    @slot('li_1') Dashboard @endslot
    @slot('li_2') Practice @endslot
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
				@if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
				<div class="col">
							<h3 class="page-title">Practice List</h3>
						</div>
						@endif
					<div class="row align-items-center">
						
						@if(Auth::user()->role_id == 1)
							<form action="{{ route('admin.exam.index') }}" method="get">
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
						@if(Auth::user()->role_id == 2)
						<div class="col-auto text-end float-end ms-auto download-grp">
							
							<a href="{{ route('admin.exam.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
						</div>
						@endif
					</div>
				</div>
				<!-- /Page Header -->
				<div class="table-responsive">
					<table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
						<thead class="student-thread">
							<tr>
								<th>Course</th>
								<th>Practice Name</th>
								<th>File</th>
								<th class="text-end">Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($exams as $exam)
							<tr>
								<td>
									<h2>
										<a>{{ $exam->course_name }}</a>
									</h2>
								</td>
								<td>{{ $exam->exam_name }}</td>
								<td>{{ $exam->file_path }}</td>
								
								<td class="text-end">
									<div class="actions">
										<!-- <a href="#" class="btn"><i class="fas fa-download"></i> Download</a> -->
										<a href="{{ route('admin.exam.download', $exam->file_path) }}" class="btn btn-sm bg-success-light me-2">
											<i class="feather-download"></i>
										</a>
										@if(Auth::user()->role_id == 2)
										<a onClick="return confirmDelete ()" href="{{ route('admin.exam.destroy', ['id' => $exam->exam_id]) }}" class="btn btn-sm bg-danger-light">
												<i class="feather-trash"></i>
											</a>
										@endif
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
