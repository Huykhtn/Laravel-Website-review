
@extends('master')
@section('content')		
@component('components.breadcrumb')                
    @slot('title') Edit Course @endslot
    @slot('li_1') Course @endslot
    @slot('li_2') Edit Course @endslot
@endcomponent	

<div class="row">
	<div class="col-sm-12">
	
		<div class="card">
			<div class="card-body">
			<form action="{{ route('admin.course.update', ['id' => $courses->course_id]) }}" method="POST">
				@csrf
					<div class="row">
						<div class="col-12">
							<h5 class="form-title"><span>Course Edit</span></h5>
						</div>
						<!-- <div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label>course ID <span class="login-danger">*</span></label>
								<input type="text" name="course_id" class="form-control" disabled="disabled" value="{{ old('courses', $courses->course_id) }}">
							</div>
						</div> -->
						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label>Course Name <span class="login-danger">*</span></label>
								<input type="text" name="course_name" class="form-control" value="{{ old('courses', $courses->course_name) }}">
							</div>
						</div>
						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label>Description <span class="login-danger">*</span></label>
								<input type="text" name="description" class="form-control" value="{{ old('courses', $courses->description) }}">
							</div>
						</div>
						
						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Status<span class="login-danger">*</span></label>
								<select class="form-control select" name="status">
									<option>Select Status</option>
									<option value="1" {{ old('status', $courses->status) == 1 ? 'selected' : '' }}>Active</option>
									<option value="2" {{ old('status', $courses->status) == 2 ? 'selected' : '' }}>Block</option>
								</select>
							</div>
						</div>
                        <div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label>Major Name <span class="login-danger">*</span></label>
								<select name="major_id" class="form-control select" >
								<option value="">Please choose Major</option>
                                    @foreach ($majors as $major)
                                    	<option value="{{ $major->major_id }}" {{ old('major_id', $courses->major_id) == $major->major_id ? 'selected' : '' }}  >{{ $major->major_name }}</option>
									<@endforeach
								</select>
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