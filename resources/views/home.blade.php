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
							<div class="bgl-primary rounded p-1">
								<h4 class="mb-0 text-capitalize">{{ Auth::user()->role ?? "Not Authorized"  }}</h4>
								<small>Designation</small>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer mt-0" >			
					<span style="display:inline-block">
						<button type="button" data-bs-toggle="modal" data-bs-target="#editInformation" class="btn btn-primary btn-sm mr-2">Edit My information</button>
						<button type="button" data-bs-toggle="modal" data-bs-target="#changePassword" class="btn btn-danger btn-sm">Change Password</button>
						<button type="button" href="/my_tasks_board" class="btn btn-info btn-sm">Task Board</button>
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
						@if ($errors->any())
							<div class="alert alert-danger">
								{{ $errors->first() }}
							</div>

                        @elseif(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
						@endif
						<h4 class="card-title">My Tasks</h4>
					</div>
					<div class="card-body">
						<div class="widget-timeline-icon dz-scroll height360">
							<ul class="timeline">
								@foreach($tasks as $dt)
								<li>
									<div class="icon bg-{{ $dt->theme }} fa fa-tasks"></div>
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
	

	<!-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
			</div>
		</div>
	</div> -->

	<div class="modal fade" id="editInformation">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit information</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal">
					</button>
				</div>
				<div class="modal-body">
				<form method="POST" action="{{ route('system_users.update', Auth::user()->id) }}">
						@csrf
						@method('PUT')
					<div class="row">
						
						<br>
						<div class="col-md-12">
							<label class="form-label">Full Name</label>
							<input hidden readonly name="role" id="role" type="text" value="{{ Auth::user()->role }}" class="form-control">
							<input hidden readonly name="email" required id="email" type="text" value="{{ Auth::user()->email }}" class="form-control">
							<input name="name" id="name" type="text" value="{{ Auth::user()->name }}" class="form-control">
						</div>
						<!-- <div class="col-md-12">
							<label class="form-label">Email Address</label>
						</div> -->
						<div class="col-md-12">
							<label class="form-label">Phone Number</label>
							<input name="email" required id="email" type="text" value="{{ Auth::user()->phone }}" class="form-control">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update Information</button>
				</div></form>
			</div>
		</div>
	</div>


	<div class="modal fade" id="changePassword">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Change Password</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal">
					</button>
				</div>
				<div class="modal-body">
				<form method="POST" action="/change-password">
						@csrf
					<div class="row">
						
						<br>
						<div class="col-md-12">
							<label class="form-label">Current Password</label>
							<input name="current_password" id="current_password" type="password" class="form-control text-primary fw-bold" placeholder="********">
						</div>
						<div class="col-md-12">
							<label class="form-label">New Password</label>
							<input name="new_password" id="new_password" type="password" class="form-control text-primary fw-bold" placeholder="********">
						</div>
						<div class="col-md-12">
							<label class="form-label">Confirm Password</label>
							<input name="new_password_confirmation" id="new_password_confirmation" type="password" class="form-control text-primary fw-bold" placeholder="********">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update Password</button>
				</div></form>
			</div>
		</div>
	</div>


	

	
	
	<!-- row -->
@endsection
