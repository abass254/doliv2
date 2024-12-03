@extends('layouts')

@section('content')
<div class="container-fluid">
	<div class="page-titles">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="javascript:void(0)">Welcome {{ Auth::user()->name ?? "Local User" }}. I hope you have a productive day !!!</a></li>
		</ol>
	</div>
	<div class="row">
		<div class="col-xl-4 col-lg-12 col-sm-12">
			<div class="card overflow-hidden">
				<div class="text-center p-5 overlay-box" style="background-image: url(images/big/img5.jpg);">
					<img src="images/profile/small/user.jpg" width="100" class="img-fluid rounded-circle" alt="">
					<h3 class="mt-3 mb-0 text-white">{{ Auth::user()->name ?? "Local User" }}</h3>
				</div>
				<div class="card-body">
					<div class="row text-center">
						<div class="col-6 mx-auto">
							<div class="bgl-primary rounded p-3">
								<h4 class="mb-0 text-capitalize">{{ Auth::user()->role ?? "Not Authorized"  }}</h4>
								<small>Designation</small>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer mt-0" >			
					<span style="display:inline-block">
						<button class="btn btn-primary btn-sm mr-2">Edit My information</button>
						<button class="btn btn-danger btn-sm">Change Password</button>
					</span>					
				</div>
			</div>
		</div>
		@if(Auth::check() && Auth::user()->role == "Manager" || "System Administrator")
			<div class="col-md-8">
				<div class="row">
					<!-- <div class="col-xl-3 col-lg-3  col-xxl-12 col-sm-6">
						<div class="app-stat card bg-danger">
							<div class="card-body  p-4">
								<div class="media flex-wrap">
									<span class="me-3">
										<i class="flaticon-381-calendar-1"></i>
									</span>
									<div class="media-body text-white text-end">
										<p class="mb-1">Appointment</p>
										<h2 class="text-white">76</h2>
									</div>
								</div>
							</div>
						</div>
					</div>	
					<div class="col-xl-3 col-lg-3 col-xxl-12 col-sm-6">
						<div class="app-stat card bg-success">
							<div class="card-body p-4">
								<div class="media flex-wrap">
									<span class="me-3">
										<i class="flaticon-381-diamond"></i>
									</span>
									<div class="media-body text-white text-end">
										<p class="mb-1 text-nowrap">Hospital Earning</p>
										<h2 class="text-white">$56K</h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-sm-6">
						<div class="app-stat card bg-info">
							<div class="card-body p-4">
								<div class="media flex-wrap">
									<span class="me-3">
										<i class="flaticon-381-heart"></i>
									</span>
									<div class="media-body text-white text-end">
										<p class="mb-1 text-nowrap">Total Patient</p>
										<h2 class="text-white">783K</h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-sm-6">
						<div class="app-stat card bg-primary">
							<div class="card-body p-4">
								<div class="media flex-wrap">
									<span class="me-3">
										<i class="flaticon-381-user-7"></i>
									</span>
									<div class="media-body text-white text-end">
										<p class="mb-1">Operations</p>
										<h2 class="text-white">76</h2>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<div class="col-xl-12 col-lg-12 col-sm-12">
					<div class="card">
					<div class="card-header border-0 pb-0">
						<h4 class="card-title">My Tasks</h4>
					</div>
					<div class="card-body">
						<div class="widget-timeline-icon dz-scroll height360">
							<ul class="timeline">
								@foreach($tasks as $dt)
								<li>
									<div class="icon bg-{{ $dt->theme }} fa fa-dot"></div>
									<a class="timeline-panel text-muted" href="">
										<h5 class="mb-2 text-{{ $dt->theme }} mt-1">{{ $dt->ts_activity }}</h5>
										<p class="fs-15 mb-0 ">{{ $dt->time_created }}</p>
									</a>
								</li>
								@endforeach
								
							</ul>
						</div>
					</div>
					<div class="card-footer border-0 pt-0 text-center"><a class="btn-link" href="/my_tasks_board">See More  &gt;&gt; </a></div>
					</div>
					</div>
				</div>
			</div>
		@endif
	</div>
	


	

	
	
	<!-- row -->
@endsection
