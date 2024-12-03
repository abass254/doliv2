@extends('layouts')

@section('content')
<div class="container-fluid">
	<div class="page-titles">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="javascript:void(0)">Welcome to a seamless appointment planner</a></li>
		</ol>
	</div>
	<div class="row">
		<div class="col-xl-4 col-lg-12 col-sm-12">
			<div class="card overflow-hidden">
				<div class="text-center p-5 overlay-box" style="background-image: url(images/big/img5.jpg);">
					<img src="images/profile/small/user.jpg" width="100" class="img-fluid rounded-circle" alt="">
					<h3 class="mt-3 mb-0 text-white">{{ Auth::user()->name ?? "Offline User" }}</h3>
				</div>
				<div class="card-body">
					<div class="row text-center">
						<div class="col-6">
							<div class="bgl-primary rounded p-3">
								<h4 class="mb-0 text-capitalize">{{ Auth::user()->role ?? "Unauthorized User"  }}</h4>
								<small>Designation</small>
							</div>
						</div>
						<div class="col-6">
							<div class="bgl-primary rounded p-3">
								<h4 class="mb-0">Age: {{ Auth::user()->age ?? "24"  }}</h4>
								<small>Years Old</small>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer mt-0">								
					<button class="btn btn-primary btn-lg btn-block">View Profile</button>		
				</div>
			</div>
		</div>
		@if(Auth::check() && Auth::user()->role == "doctor" || "admin")
			<div class="col-md-8">
				<div class="row">
					<div class="col-xl-3 col-lg-3  col-xxl-12 col-sm-6">
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
					</div>
				</div>
			</div>
		@endif
	</div>
	


	

	
	
	<!-- row -->
@endsection
