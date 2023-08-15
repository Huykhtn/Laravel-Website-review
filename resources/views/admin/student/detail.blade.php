
@extends('master')
@section('content')     
@component('components.breadcrumb')                
    @slot('title') Student  @endslot
    @slot('li_1') Dashboard @endslot
    @slot('li_2') Student @endslot
@endcomponent		



<div class="card">
	<div class="card-body">
    @foreach ($users as $user)
		
		<div class="row">
			<div class="col-lg-12">
				<div class="student-personals-grp">
					<div class="card">
						<div class="card-body">
							<div class="heading-detail">
								<h4>Student Details :</h4>
							</div>
							<div class="personal-activity">
								<div class="personal-icons">
									<i class="feather-user"></i>
								</div>
								<div class="views-personal">
									<h4>Name</h4>
									<h5>{{ $user->user_name }}</h5>
								</div>
							</div>
							<div class="personal-activity">
								<div class="personal-icons">
									<img src="{{ URL::asset('/assets/img/icons/buliding-icon.svg')}}" alt="">
								</div>
								<div class="views-personal">
									<h4>Course </h4>
									<h5>{{ $user->course_name }}</h5>
								</div>
							</div>
							<div class="personal-activity">
								<div class="personal-icons">
									<i class="feather-phone-call"></i>
								</div>
								<div class="views-personal">
									<h4>Mobile</h4>
									<h5>{{ $user->phone }}</h5>
								</div>
							</div>
							<div class="personal-activity">
								<div class="personal-icons">
									<i class="feather-mail"></i>
								</div>
								<div class="views-personal">
									<h4>Email</h4>
									<h5>{{ $user->email }}</h5>
								</div>
							</div>
							<div class="personal-activity">
								<div class="personal-icons">
									<i class="feather-user"></i>
								</div>
								<div class="views-personal">
									<h4>Gender</h4>
									<h5><a>{{ $user->gender == 1 ? 'Male' : 'Female' }}</a></h5>
								</div>
							</div>
							
							
						</div>
					</div>
				</div>
			</div>
			
		</div>
        @endforeach
    </div>
    
</div>



@endsection
