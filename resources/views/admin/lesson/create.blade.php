<?php $page="admin.lesson.create";?>
@extends('master')
@section('content')		
@component('components.breadcrumb')                
    @slot('title') Lesson @endslot
    @slot('li_1') Lesson @endslot
    @slot('li_2') Add Lesson @endslot
@endcomponent	

<div class="row">
	<div class="col-sm-12">
	
		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin.lesson.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
					<div class="row">
						<div class="col-12">
							<h5 class="form-title"><span>Lesson Create</span></h5>
						</div>

						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Lesson Name <span class="login-danger">*</span></label>
								<input class="form-control" name="lesson_name" type="text" placeholder="Enter Name" >
							</div>
						</div>
						
						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label>Course Name <span class="login-danger">*</span></label>
								<select name="course_id" class="form-control select">
									<option>Please choose Course</option>
                                    @foreach ($courses as $course)
                                    <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
									<@endforeach
								</select>
							</div>
						</div>

						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label>Teacher Name <span class="login-danger">*</span></label>
								<select name="teacher_id" class="form-control select">
									<option>Please choose Teacher</option>
                                    @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->user_id }}">{{ $teacher->user_name }}</option>
									<@endforeach
								</select>
							</div>
						</div>

						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label>Weekday <span class="login-danger">*</span></label>
								<select name="weekday" class="form-control select">
									<option>Please choose Weekday</option>
                                    <option value="1">Monday</option>
									<option value="2">Tuesday</option>
									<option value="3">Wednesday</option>
									<option value="4">Thursday</option>
									<option value="5">Friday</option>
									
									
								</select>
							</div>
						</div>

						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label class="required" for="start_time">Start time <span class="login-danger">*</span></label>
								<input class="form-control timepicker" type="time" name="start_time" value="{{ old('start_time') }}" >
                
							</div>
						</div>
						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label class="required" for="end_time">End time <span class="login-danger">*</span></label>
								<input class="form-control timepicker" type="time" name="end_time" value="{{ old('end_time') }}" >
                
							</div>
						</div>

						
                        
						<div class="col-12">
							<div class="student-submit">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		
	</div>					
</div>

<!-- <script>
	document.getElementById("start_time").step = "30";

</script> -->
@endsection
