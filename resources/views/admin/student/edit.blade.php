
@extends('master')
@section('content')		
@component('components.breadcrumb')                
    @slot('title') Edit Student @endslot
    @slot('li_1') Student @endslot
    @slot('li_2') Edit Student @endslot
@endcomponent	

<div class="row">
	<div class="col-sm-12">
	
		<div class="card comman-shadow">
			<div class="card-body">
				
                <form action="{{ route('admin.student.update', ['id' => $user->user_id]) }}" method="POST">
				@csrf
					<div class="row">
						<div class="col-12">
							<h5 class="form-title student-info">User Information <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
						</div>

                        <div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Name <span class="login-danger">*</span></label>
								<input class="form-control" name="user_name" value="{{ old('name', $user->user_name) }}" type="text" placeholder="Enter Name" >
								
							</div>
						</div>
                        <div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Email <span class="login-danger">*</span></label>
								<input class="form-control" name="email" value="{{ old('email', $user->email) }}" type="text" placeholder="Enter Email" disabled="disabled">
								
							</div>
						</div>

                        <!-- <div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Password <span class="login-danger">*</span></label>
								<input class="form-control" name="password" value="{{ old('password', $user->password) }}" type="text" placeholder="Enter Password" >
								
							</div>
						</div> -->
						
						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Full Name<span class="login-danger">*</span></label>
								<input class="form-control" name="fullname" value="{{ old('fullname', $user->fullname) }}" type="text" placeholder="Enter Fullname" >
							</div>
						</div>

						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Level<span class="login-danger">*</span></label>
								<select name="role_id" class="form-control select">
									<option value="3" {{ old('role_id') == 3 ? 'selected' : '' }}>Student</option>
								</select>
							</div>
						</div>

						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Gender<span class="login-danger">*</span></label>
								<select name="gender" value="{{ old('gender', $user->gender) }}" class="form-control select">
									<option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>Male</option>
									<option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>Female</option>
								</select>
							</div>
						</div>

						<div class="col-12 col-sm-4" id="course">  
							<div class="form-group local-forms">
								<label>Course <span class="login-danger">*</span></label>
								<select name="course_id" class="form-control select" >
									<option>Please choose Course</option>
                                    @foreach ($courses as $course)
                                    <option value="{{ $course->course_id }}" {{ old('course_id', $user->course_id) == $course->course_id ? 'selected' : '' }}>{{ $course->course_name }}</option>
                
									<@endforeach
								</select>
							</div>
						</div>

						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Phone<span class="login-danger">*</span></label>
								<input class="form-control" name="phone" value="{{ old('phone', $user->phone) }}" type="text" placeholder="Enter Fullname" >
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
