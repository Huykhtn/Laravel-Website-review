<?php $page="admin.course.create";?>
@extends('master')
@section('content')		
@component('components.breadcrumb')                
    @slot('title') Add Course @endslot
    @slot('li_1') Course @endslot
    @slot('li_2') Add Course @endslot
@endcomponent	

<div class="row">
	<div class="col-sm-12">
	
		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin.course.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
					<div class="row">
						<div class="col-12">
							<h5 class="form-title"><span>Course Information</span></h5>
						</div>
						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label>Course Name <span class="login-danger">*</span></label>
								<input type="text" name="course_name" class="form-control">
							</div>
						</div>
						
						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label>Description <span class="login-danger">*</span></label>
								<input type="text" name="description" class="form-control">
							</div>
						</div>
						
                        
						
                        <div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label>Major Name <span class="login-danger">*</span></label>
								<select name="major_id" class="form-control select">
									<option>Please choose Major</option>
                                    @foreach ($majors as $major)
                                    <option value="{{ $major->major_id }}">{{ $major->major_name }}</option>
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