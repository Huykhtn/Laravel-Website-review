<?php error_reporting(0);?>
<!-- Sidebar -->
<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
				<li class="menu-title"> 
					<span>Main Menu</span>
				</li>
				
				@if(Auth::user()->role_id == 1)
				<li class="submenu">
					<a href="#"><i class="fas fa-graduation-cap"></i> <span> Users</span> <span class="menu-arrow"></span></a>
						<ul>
						<li><a class="<?php if($page=="admin.user.index")  ?>" href="{{route('admin.user.index')}}">Reset Password</a></li>
							<li><a class="<?php if($page=="admin.teacher.index")  ?>" href="{{route('admin.teacher.index')}}">Teacher List</a></li>
								
							<li><a class="<?php if($page=="admin.student.create")  ?>" href="{{route('admin.student.create')}}">Student Add</a></li>
							<li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['admin.student.list', 'admin.student.edit', 'admin.student.index']) ? 'nav-item-expanded' : '' }} ">
							<a href="#"><i class="fas fa-graduation-cap"></i> <span> Student List</span> <span class="menu-arrow"></span></a>
								
								<ul class="nav nav-group-sub" >
									@foreach(DB::table('courses')->where('status','=','1')->get() as $c)
                                    	<li class="nav-item"><a href="{{ route('admin.student.list', ['course_id' => $c->course_id]) }}" class="nav-link ">{{ $c->course_name }}</a></li>
                                    @endforeach
                                </ul>
							</li>
						</ul>	
				</li>
				@endif

				@if(Auth::user()->role_id == 1)
				<li class="submenu <?php if($page=="admin.major.index" || $page=="admin.major.create")  ?>">
					<a href="#"><i class="fas fa-building"></i> <span> Majors</span> <span class="menu-arrow"></span></a>
					<ul>
						<li><a class="<?php if($page=="admin.major.index")  ?>" href="{{ route('admin.major.index') }}">Major List</a></li>
						<li><a class="<?php if($page=="admin.major.create")  ?>" href="{{ route('admin.major.create') }}">Major Add</a></li>
					</ul>
				</li>
				@endif
				@if(Auth::user()->role_id == 1)
				<li class="submenu <?php if($page=="admin.course.index" || $page=="admin.course.create")  ?>">
					<a href="#"><i class="fas fa-book-reader"></i> <span> Courses</span> <span class="menu-arrow"></span></a>
					<ul>
						<li><a class="<?php if($page=="admin.course.index")  ?>" href="{{route('admin.course.index')}}">Course List</a></li>
						<li><a class="<?php if($page=="admin.course.create")  ?>" href="{{route('admin.course.create')}}">Course Add</a></li>

					</ul>
				</li>
				@endif

				@if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2)
				<li class="submenu <?php if($page=="admin.lesson.index" || $page=="admin.lesson.create")  ?>">
					<a href="#"><i class="fas fa-book-reader"></i> <span> Lessons</span> <span class="menu-arrow"></span></a>
					<ul>
						<li><a class="<?php if($page=="admin.lesson.index")  ?>" href="{{route('admin.lesson.index')}}">Lesson List</a></li>
						@if(Auth::user()->role_id == 2)
						<li><a class="<?php if($page=="admin.lesson.create")  ?>" href="{{route('admin.lesson.create')}}">Lesson Add</a></li>
						@endif
					</ul>
				</li>
				@endif

				<li class="submenu <?php if($page=="admin.exam.index" || $page=="admin.exam.create" )  ?>">
					<a href="#"><i class="fas fa-book-reader"></i> <span> Practices</span> <span class="menu-arrow"></span></a>
					<ul>
						<li><a class="<?php if($page=="admin.exam.index")  ?>" href="{{route('admin.exam.index')}}">Practice List</a></li>
						
					</ul>
				</li>


				<li class="{{ Request::is('calendar') ? 'active' : '' }}"> 
					<a href="{{ route('admin.calendar.index') }}"><i class="fas fa-table"></i> <span>Time Table</span></a>
				</li>
				
				
			</ul>
		</div>
	</div>
</div>
<!-- /Sidebar -->