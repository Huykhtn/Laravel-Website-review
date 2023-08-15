
@extends('master')
@section('content')		
@component('components.breadcrumb')                
    @slot('title') Edit Users @endslot
    @slot('li_1') Users @endslot
    @slot('li_2') Edit Userss @endslot
@endcomponent	

<div class="row">
	<div class="col-sm-12">
	
		<div class="card comman-shadow">
			<div class="card-body">
				
                <form action="{{ route('update-profile', ['id' => $user->user_id]) }}" method="POST">
				@csrf
					<div class="row">
						<div class="col-12">
							<h5 class="form-title student-info">User Information <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
						</div>
						

                        <div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Name <span class="login-danger">*</span></label>
								<input class="form-control" name="user_name" value="{{ old('user_name', $user->user_name) }}" type="text" placeholder="Enter Name" >
								
							</div>
						</div>
                        <div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Email <span class="login-danger">*</span></label>
								<input class="form-control" name="email" value="{{ old('email', $user->email) }}" type="text" placeholder="Enter Email" disabled="disabled">
								
							</div>
						</div>

						<div class="col-12 col-sm-4">  
							<div class="form-group local-forms">
								<label >Level<span class="login-danger">*</span></label>
								<select name="level" value="{{ old('role_id', $user->role_id) }}" class="form-control select" disabled="disabled">
									<option value="1" {{ old('role_id') == 1 ? 'selected' : '' }}>Admin</option>
									<option value="2" {{ old('role_id') == 2 ? 'selected' : '' }}>Member</option>
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
