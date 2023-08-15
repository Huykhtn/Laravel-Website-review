@extends('master')
@section('content')		
@component('components.breadcrumb')                
    @slot('title') Add Teacher @endslot
    @slot('li_1') User @endslot
    @slot('li_2') Add Teacher @endslot
@endcomponent	

<div class="row">
	<div class="col-sm-12">
	
		<div class="card comman-shadow">
			<div class="card-body">
				
                <form action="{{ route('admin.teacher.store') }}" method="POST">
				@csrf
					<div class="row">
						<div class="col-12">
							<h5 class="form-title student-info">Teacher Information <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
						</div>
						

                        <div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Name <span class="login-danger">*</span></label>
								<input class="form-control" name="user_name" type="text" placeholder="Enter Name" >
							</div>
						</div>
                        <div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Email <span class="login-danger">*</span></label>
								<input class="form-control" name="email" type="text" placeholder="Enter Email" >
							</div>
						</div>

                        <div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Password <span class="login-danger">*</span></label>
								<input class="form-control" name="password" type="text" placeholder="Enter Password" >
							</div>
						</div>

						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Password Confirm <span class="login-danger">*</span></label>
								<input class="form-control" name="password_confirmation" type="text" placeholder="Enter Password" >
							</div>
						</div>
						
						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Full Name<span class="login-danger">*</span></label>
								<input class="form-control" name="fullname" type="text" placeholder="Enter Fullname" >
							</div>
						</div>

						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Level<span class="login-danger">*</span></label>
								<select class="form-control select" name="role_id" onChange="showDepartment(this)">
									<option>Select Level</option>
									<option value="2" {{ old('role_id') == 2 ? 'selected' : '' }}>Teacher</option>
									
								</select>
							</div>	
						</div>

						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Gender<span class="login-danger">*</span></label>
								<select class="form-control select" name="gender">
									<option>Select Gender</option>
									<option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>Male</option>
									<option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>Female</option>
								</select>
							</div>
						</div>

						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label>course ID <span class="login-danger">*</span></label>
								<select name="course_id" class="form-control select">
									<option>Please choose course</option>
                                    @foreach ($courses as $course)
                                    <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
									<@endforeach
								</select>
							</div>
						</div>

						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Phone<span class="login-danger">*</span></label>
								<input class="form-control" name="phone" type="text" placeholder="Enter Fullname" >
							</div>
						</div>

                        
						<div class="col-12">
							<div class="submit">
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
