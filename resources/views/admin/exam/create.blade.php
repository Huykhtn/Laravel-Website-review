@extends('master')
@section('content')		
@component('components.breadcrumb')                
	@slot('title') Practice @endslot
	@slot('li_1') Practice @endslot
	@slot('li_2') Practice @endslot
@endcomponent

<div class="row">
	<div class="col-sm-12">
	
		<div class="card comman-shadow">
			<div class="card-body">
				
                <form action="{{ route('admin.exam.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
					<div class="row">
						<div class="col-12">
							<h5 class="form-title student-info">Practice Create <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
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
								<label >Name <span class="login-danger">*</span></label>
								<input class="form-control" name="exam_name" type="text" placeholder="Enter Name" >
							</div>
						</div>
                        <div class="form-group">
								<p class="settings-label">File <span class="star-red">*</span></p>
								<div class="settings-btn">
                                    
									<input type="file" name="file" id="file" value="file">
										<label for="file" class="upload">
											<i class="feather-upload"></i>
										</label>
								</div>	
						</div>
                        
						<div class="col-12">
							<div class="submit">
								<button type="submit" class="btn btn-primary">Upload</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>							
	</div>					
</div>					
@endsection

	  