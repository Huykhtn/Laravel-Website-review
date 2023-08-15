
@extends('master')
@section('content')     
@component('components.breadcrumb')  
@if(Auth::user()->role_id == 1)     
    @slot('title') Welcome Admin! @endslot
    @slot('li_1') Home @endslot
	@slot('li_2') Admin @endslot
@endif
@if(Auth::user()->role_id == 2)              
    @slot('title') Welcome Teacher {{Auth::user()->user_name}}! @endslot
    @slot('li_1') Home @endslot
	@slot('li_2') Teacher @endslot
@endif
@if(Auth::user()->role_id == 3)              
    @slot('title') Welcome Student {{Auth::user()->user_name}}! @endslot
    @slot('li_1') Home @endslot
	@slot('li_2') Student @endslot
@endif
@endcomponent 	

<div class="row">
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
@if(Auth::user()->role_id == 1)  
<div class="col-12 col-md-12 col-lg-3 d-flex">
	<div class="card flex-fill bg-white">
		<div class="card-body" style="font-size:200%">
			<a class="card-link" href="{{ route('admin.user.index') }}">
			<p style="text-align:center">Reset Password</p>
			</a>
		</div>
	</div>
</div>

<div class="col-12 col-md-12 col-lg-3 d-flex">
	<div class="card flex-fill bg-white">
		<div class="card-body" style="font-size:200%">
			<a class="card-link" href="{{ route('admin.teacher.index') }}">
			<p style="text-align:center">Teachers</p>
			</a>
		</div>
	</div>
</div>
@endif
@if(Auth::user()->role_id == 1)
<div class="col-12 col-md-12 col-lg-3 d-flex">
	<div class="card flex-fill bg-white">
		<div class="card-body" style="font-size:200%">
			<a class="card-link" href="{{ route('admin.student.index') }}">
			<p style="text-align:center">Students</p>
			</a>
			
		</div>
	</div>
</div>
<div class="col-12 col-md-12 col-lg-3 d-flex">
	<div class="card flex-fill bg-white">
		<div class="card-body" style="font-size:200%">
			<a class="card-link" href="{{ route('admin.major.index') }}">
			<p style="text-align:center">Majors</p>
			</a>
		</div>
	</div>
</div>

<div class="col-12 col-md-12 col-lg-3 d-flex">
	<div class="card flex-fill bg-white">
		<div class="card-body" style="font-size:200%">
			<a class="card-link" href="{{ route('admin.course.index') }}">
			<p style="text-align:center">Courses</p>
			</a>
		</div>
	</div>
</div>
@endif

@if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
<div class="col-12 col-md-12 col-lg-3 d-flex">
	<div class="card flex-fill bg-white">
		<div class="card-body" style="font-size:200%">
			<a class="card-link" href="{{ route('admin.lesson.index') }}">
			<p style="text-align:center">Lessons</p>
			</a>
		</div>
	</div>
</div>
@endif

<div class="col-12 col-md-12 col-lg-3 d-flex">
	<div class="card flex-fill bg-white">
		<div class="card-body" style="font-size:200%">
			<a class="card-link" href="{{ route('admin.exam.index') }}">
			<p style="text-align:center">Exams</p>
			</a>
		</div>
	</div>
</div>
<div class="col-12 col-md-12 col-lg-3 d-flex">
	<div class="card flex-fill bg-white">
		<div class="card-body" style="font-size:200%">
			<a class="card-link" href="{{ route('admin.calendar.index') }}">
			<p style="text-align:center">Time Table</p>
			</a>
		</div>
	</div>
</div>
</div>


@endsection