
@extends('master')
@section('content')		
@component('components.breadcrumb')                
    @slot('title') Lesson @endslot
    @slot('li_1') Lesson @endslot
    @slot('li_2') Edit Lesson @endslot
@endcomponent	

<div class="row">
	<div class="col-sm-12">
	
		<div class="card">
			<div class="card-body">
			<form action="{{ route('admin.lesson.update', ['id' => $lessons->lesson_id]) }}" method="POST">
				@csrf
					<div class="row">
						<div class="col-12">
							<h5 class="form-title"><span>Lesson Edit</span></h5>
						</div>
						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Lesson Name <span class="login-danger">*</span></label>
								<input class="form-control" name="lesson_name" value="{{ old('lesson_name', $lessons->lesson_name) }}" type="text" placeholder="Enter Name" >
							</div>
						</div>
						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label>Course Name <span class="login-danger">*</span></label>
								<select name="course_id" class="form-control select">
									<option>Please choose Course</option>
                                    @foreach ($courses as $course)
                                    <option value="{{ $course->course_id }}" {{ old('course_id', $course->course_id) == $course->course_id ? 'selected' : '' }}>{{ $course->course_name }}</option>
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
                                    <option value="{{ $teacher->user_id }}" {{ old('teacher_id', $teacher->user_id) == $teacher->user_id ? 'selected' : '' }}>{{ $teacher->user_name }}</option>
									<@endforeach
								</select>
							</div>
						</div>

						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label>Weekday <span class="login-danger">*</span></label>
								<select name="weekday" class="form-control select" >
									<option>Please choose Weekday</option>
									
                                    <option value="1" {{ old('weekday', $lessons->weekday) == 1 ? 'selected' : '' }}>Monday</option>
									<option value="2" {{ old('weekday', $lessons->weekday) == 2 ? 'selected' : '' }}>Tuesday</option>
									<option value="3" {{ old('weekday', $lessons->weekday) == 3 ? 'selected' : '' }}>Wednesday</option>
									<option value="4" {{ old('weekday', $lessons->weekday) == 4 ? 'selected' : '' }}>Thursday</option>
									<option value="5" {{ old('weekday', $lessons->weekday) == 5 ? 'selected' : '' }}>Friday</option>
									<!-- <option value="6">Saturday</option>
									<option value="7">Sunday</option> -->
									
								</select>
							</div>
						</div>

						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label class="required" for="start_time"></label>
								<input class="form-control timepicker" type="time" name="start_time" value="{{ old('start_time', $lessons->start_time) }}" >
								
							</div>
						</div>
						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label class="required" for="end_time"></label>
								<input class="form-control timepicker" type="time" name="end_time" value="{{ old('end_time', $lessons->end_time) }}" >
                
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
@endsection