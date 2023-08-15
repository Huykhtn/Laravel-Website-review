					 
	<!-- Page Header -->
	@if(!Route::is(['admin.dashboard.index']))
	<div class="page-header">
		<div class="row align-items-center">
			<div class="col">
				<h3 class="page-title">{{ $title }}</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item">{{ $li_1 }}</a></li>
					<li class="breadcrumb-item active">{{ $li_2 }}</li>
				
				</ul>
			</div>
		</div>
	</div>
	@endif

				