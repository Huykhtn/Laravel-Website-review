<?php $page="admin.major.index";?>
@extends('master')
@section('content')     
@component('components.breadcrumb')                
    @slot('title') Majors  @endslot
    @slot('li_1') Dashboard @endslot
    @slot('li_2') Majors @endslot
@endcomponent		

	<div class="row">
	@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
		<div class="col-sm-12">
		
			<div class="card card-table">
				<div class="card-body">
				
					<!-- Page Header -->
					<div class="page-header">
					<div class="col">
								<h3 class="page-title">Major List</h3>
							</div>
							<div class="col-auto text-end float-end ms-auto download-grp">
								
								<a href="{{route('admin.major.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
							</div>
						</div>
						
					</div>
					<!-- /Page Header -->
					<div class="table-responsive">
						<table class="table border-0 star-student table-hover table-center mb-0 datatable table-responsive">
							<thead class="student-thread">
								<tr>
									<!-- <th>ID</th> -->
									<th>Major Name</th>
									<th>Description</th>
									<th>Status</th>
									<th class="text-end">Action</th>
								</tr>
							</thead>
							<tbody>
							
								
								@foreach ($majors as $major)
								<tr>
									<td>
										<h2>
											<a>{{ $major->major_name }}</a>
										</h2>
									</td>
									<td>
										<h2>
											<a>{{ $major->description }}</a>
										</h2>
									</td>
									<td>
									<h2>
											@if($major->status == 1)
											<span class="badge badge-success">{{ $major->status == 1 ? 'Active' : 'Block' }}</span>
											@endif
											@if($major->status == 2)
											<span class="badge badge-block">{{ $major->status == 1 ? 'Active' : 'Block' }}</span>
											@endif
											
										</h2>
									</td>
									<td class="text-end">
									<div class="actions">
											<a href="{{ route('admin.course.index', ['major_id' => $major->major_id]) }}" class="btn btn-sm bg-success-light me-2">
												<i class="feather-eye"></i>
											</a>
											<a href="{{ route('admin.major.edit', ['id' => $major->major_id]) }}" class="btn btn-sm bg-success-light me-2">
												<i class="feather-edit"></i>
											</a>
											<a onClick="return confirmDelete ()" href="{{ route('admin.major.destroy', ['id' => $major->major_id]) }}" class="btn btn-sm bg-danger-light">
												<i class="feather-trash"></i>
											</a>
											
										</div>
									</td>
									
									
								</tr>
								@endforeach
								
								
							</tbody>
						</table>
					</div>
				</div>
				
			</div>							
		</div>					
	</div>					
@endsection
