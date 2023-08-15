<?php $page="admin.calendar.index";?>
@extends('master')
@section('content')     
@component('components.breadcrumb')                
    @slot('title') Time Table  @endslot
    @slot('li_1') Dashboard @endslot
    @slot('li_2') Time Table @endslot
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
            @if(Auth::user()->role_id == 1)
            <form action="{{ route('admin.calendar.index') }}" method="get">
                <div class="row">
                    <div class="col-md-4">  
                        <div class="form-group local-forms">
                            <label>Course <span class="login-danger">*</span></label>
                            <select name="course_id" class="form-control select">
                            
                            @if(isset($_GET['course_id']))
                        
                                @foreach ($courses  as $course)
                                @if($_GET['course_id'] == $course->course_id)
                                <option value="{{ $_GET['course_id'] }}">{{ $course->course_name }}</option>
                                @endif
                                @endforeach

                            @endif 
                                <option>Please choose Course</option>
                                @foreach ($courses  as $course)
                                <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>	
            @endif

            @if(Auth::user()->role_id ==1)
            <table class="table table-bordered">
                <thead>
                    <th width="100">Time</th>
                    @foreach($weekDays as $day)
                        <th>{{ $day }}</th>
                    @endforeach
                </thead>
                    
                <tbody>
                    @foreach($calendarData as $time => $days)
                        <tr>
                            <td>
                                {{ $time }}
                            </td>
                            @foreach($days as $value)
                                @if (is_array($value))
                                    <td rowspan="{{ $value['rowspan'] }}" class="align-middle text-center" style="background-color:#f0f0f0">
                                        {{ $value['course_name'] }}<br>
                                        Teacher: {{ $value['teacher_name'] }}
                                    </td>
                                @elseif ($value === 1)
                                    <td></td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif

 <!-- 

  -->

                    @if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                    <table class="table table-bordered">
                        
                        <thead>
                            <th width="100">Time</th>
                            @foreach($weekDays as $day)
                                <th>{{ $day }}</th>
                            @endforeach
                        </thead>
                            
                        <tbody>
                            @foreach($calendarData as $time => $days)
                                <tr>
                                    <td>
                                        {{ $time }}
                                    </td>
                                    @foreach($days as $value)
                                        @if (is_array($value))
                                            <td rowspan="{{ $value['rowspan'] }}" class="align-middle text-center" style="background-color:#f0f0f0">
                                                {{ $value['course_name'] }}<br>
                                                Teacher: {{ $value['teacher_name'] }}
                                            </td>
                                        @elseif ($value === 1)
                                            <td></td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    @endif

                    
            </div>
		</div>
	</div>							
</div>					
					
@endsection
