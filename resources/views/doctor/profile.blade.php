@extends('layouts')

@section('content')

@section('page-title', 'User Profile')
<div class="container-fluid">
    <div class="page-titles">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/">Home Page</a></li>
		</ol>
	</div>
	
    <div class="row">
    <div class="col-lg-12">
			<div class="profile card card-body px-3 pt-3 pb-0">
				<div class="profile-head">
					<div class="photo-content">
						<div class="cover-photo rounded"></div>
					</div>
					<div class="profile-info">
						<div class="profile-photo">
							<img src="images/profile/profile.png" class="img-fluid rounded-circle" alt="">
						</div>
						<div class="profile-details">
							<button class="btn btn-primary rounded-pill light me-1 px-3" data-bs-toggle="modal" data-bs-target="#editPhoto"><span class=""><i class="fa fa-camera"></i></span></button>
							<div class="dropdown ms-auto">
								<a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li class="dropdown-item"><a href="javascript:void(0);"><i class="fa fa-user-circle text-primary me-2"></i> View profile</a></li>
									<li class="dropdown-item"><a href="javascript:void(0);"><i class="fa fa-users text-primary me-2"></i> Add to close friends</a></li>
									<li class="dropdown-item"><a href="javascript:void(0);"><i class="fa fa-plus text-primary me-2"></i> Add to group</a></li>
									<li class="dropdown-item"><a href="javascript:void(0);" class="text-danger"><i class="fa fa-ban text-danger me-2"></i> Block</a></li>
								</ul>

								<!-- <button class="btn btn-sm btn-dark"><span class="me-2"><i class="fa fa-camera"></button> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-12">
			<div class="card h-auto">
				<div class="card-body">
					<div class="profile-tab">
						<div class="custom-tab-1">
							<ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation"><a href="#personal-settings" data-bs-toggle="tab" class="nav-link active" aria-selected="true" role="tab">Personal Settings</a>
								</li>
								@if(Auth::user()->is_admin == '1')
								<li class="nav-item" role="presentation"><a href="#my-posts" data-bs-toggle="tab" class="nav-link show" aria-selected="false" role="tab" tabindex="-1">Facility Staff</a>
								</li>
								<li class="nav-item" role="presentation"><a href="#about-me" data-bs-toggle="tab" class="nav-link" aria-selected="false" role="tab" tabindex="-1">Services Offered</a>
								</li>
								<li class="nav-item" role="presentation"><a href="#profile-settings" data-bs-toggle="tab" class="nav-link" aria-selected="true" role="tab">Facility Settings</a>
								</li>
                                <li class="nav-item" role="presentation"><a href="#partner-settings" data-bs-toggle="tab" class="nav-link" aria-selected="true" role="tab">Facility Partners</a>
								</li>
								@endif
                                
							</ul>
							<div class="tab-content">
								<div id="my-posts" class="tab-pane fade" role="tabpanel">
									<div class="my-post-content pt-3">
                                    <div class="card-body">
                                        <div class="table-responsive ">
                                            <table class="table patient-activity flex-nowrap">
                                                <tbody>
                                                    @for($i=1;$i<5;$i++)
                                                
                                                    <tr>
                                                        <td><b>{{ $i }}</b></td>
                                                        <td>
                                                            <div class="media align-items-center">
                                                                <img class="me-3 img-fluid rounded" width="78" src="images/avatar/1.jpg" alt="DexignZone">
                                                                <div class="media-body">
                                                                    <h5 class="mt-0 mb-1">Abass Ahmed</h5>
                                                                    <p class="mb-0">41 Years Old</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <p class="mb-0">Speciality</p>
                                                            <h5 class="my-0 text-primary">Phisio &amp; Therapist</h5>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <p class="mb-1">Availability</p>
                                                                    <h5 class="mt-0 mb-1 text-success">Recovered</h5>
                                                                    <small>22/03/2021 12:34 AM</small>
                                                                </div>
                                                                <div class="dropdown ms-auto">
                                                                    <div class="btn-link" data-bs-toggle="dropdown">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="12" cy="5" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="19" r="2"></circle></g></svg>
                                                                    </div>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="javascript:void(0);">Share Password Reset Link</a>
                                                                        <a class="dropdown-item" href="javascript:void(0);">Remove Doctor</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endfor
                                                </tbody>
                                            </table>
                                                
                                            <button class="btn btn-sm btn-danger me-2" data-bs-toggle="modal" data-bs-target="#replyModal"><span class="me-2"><i class="fa fa-share"></i></span>LINK EXISTING DOCTOR</button>
                                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#replyModal"><span class="me-2"><i class="fa fa-add"></i></span>ADD NEW DOCTOR/STAFF</button>
                                            <button class="btn btn-sm btn-primary me-2"><span class="me-2"><i class="fa fa-eye"></i></span>VIEW ALL DOCTOR/STAFF</button>
                                        </div>
                                    </div>-
										
									</div>
								</div>
								<div id="about-me" class="tab-pane fade" role="tabpanel">
									<div class="profile-about-me">
										<div class="pt-4 border-bottom-1 pb-3">
											<h4 class="text-primary">Brief Description</h4>
											<p class="mb-2">{{ $facility->fc_desc ?? 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence was created for the bliss of souls like mine.I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.'}} </p>
										</div>
									</div>
									<div class="profile-skills mb-5">
										<h4 class="text-primary mb-2">Specialities</h4>
										<!-- @foreach($doctor as $doc)
										<a href="javascript:void(0);" class="btn btn-primary light btn-xs mb-1">{{ $doc->dc_speciality }}</a>
										@endforeach -->
									</div>
								</div>
								<div id="personal-settings" class="tab-pane fade active show" role="tabpanel">
                                <div class="profile-personal-info">
										<!-- <h4 class="text-primary mb-4">Personal Information</h4> -->
										<div class="row mb-2 mt-3">
											<div class="col-sm-3 col-5">
												<h5 class="f-w-500">Full Name<span class="pull-end">:</span>
												</h5>
											</div>
											<div class="col-sm-9 col-7"><span>{{ Auth::user()->name ?? 'N/A' }}</span>
											</div>
										</div>
										<div class="row mb-2">
											<div class="col-sm-3 col-5">
												<h5 class="f-w-500">Email Adress <span class="pull-end">:</span>
												</h5>
											</div>
											<div class="col-sm-9 col-7"><span>{{ Auth::user()->email ?? 'N/A' }} </span>
											</div>
										</div>
										<div class="row mb-2">
											<div class="col-sm-3 col-5">
												<h5 class="f-w-500">Phone Number<span class="pull-end">:</span></h5>
											</div>
											<div class="col-sm-9 col-7"><span>{{ Auth::user()->phone ?? 'N/A' }}</span>
											</div>
										</div>
										<div class="row mb-2">
											<div class="col-sm-3 col-5">
												<h5 class="f-w-500">Role<span class="pull-end">:</span></h5>
											</div>
											<div class="col-sm-9 col-7 text-capitalize"><span>{{ Auth::user()->role ?? 'N/A' }}</span>
											</div>
										</div>
									</div>
                                    <br>
                                    <button data-bs-toggle="modal" data-bs-target="#editProfile" class="btn btn-sm btn-primary me-2"><span class="me-2"><i class="fa fa-pen"></i></span>Edit Profile</button>
                                    <button data-bs-toggle="modal" data-bs-target="#editPassword" class="btn btn-sm btn-danger"><span class="me-2"><i class="fa fa-key"></i></span>Change Password</button>
									<!-- <div class="p  t-3">
										<div class="settings-form">
											<h4 class="text-primary"></h4>
											<form class="row">
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">FULL NAME</label>
                                                <input id="name" type="text" class="form-control" placeholder="John Doe">
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">EMAIL ADDRESS</label>
                                                <input id="email" type="email" class="form-control" placeholder="johndoe@mail.com">
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">PHONE NUMBER</label>
                                                <input id="phone" type="text" class="form-control" placeholder="+254XXXXXXXX">
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">MY SPECIALITY</label>
                                                <input id="speciality" type="text" class="form-control" placeholder="Optician, Dentist, Phlebotomist">
                                            </div>
											</form>
										</div>
									</div> -->
								</div>
                                <div id="facility-settings" class="tab-pane fade" role="tabpanel">
                                </div>
							</div>
						</div>
						<!-- Modal -->
						<div class="modal fade" id="replyModal">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Post Reply</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
									</div>
									<div class="modal-body">
										<form>
							<input type="hidden" name="_token" value="eB0n2NdjGLN3bGnjbX2PnNw3rbcfOZJ2WUR5dX5m">											<textarea class="form-control" rows="4">Message</textarea>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary">Reply</button>
									</div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="editPassword" data-backdrop="static">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Password</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
									</div>
									<div class="modal-body">
										<form>
											<div class="row">
												<div class="col-md-12">
													<label class="form-label">CURRENT PASSWORD</label>
													<input name="current_password" id="current_password" type="password" class="form-control" placeholder="********">
												</div>
												<div class="col-md-12">
													<label class="form-label">NEW PASSWORD</label>
													<input name="new_password" id="new_password" type="password" class="form-control" placeholder="********">
												</div>
												<div class="col-md-12">
													<label class="form-label">CONFIRM PASSWORD</label>
													<input name="confirm_password" id="confirm_password" type="password" class="form-control" placeholder="*********">
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary">Reply</button>
									</div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="editProfile" data-backdrop="static">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Profile</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
									</div>
									<div class="modal-body">
										<form>
											<div class="row">
												<div class="col-md-12">
													<label class="form-label">FULL NAME</label>
													<input name="current_password" id="current_password" type="text" class="form-control" value="{{ Auth::user()->name }}">
												</div>
												<div class="col-md-12">
													<label class="form-label">EMAIL ADDRESS</label>
													<input name="new_password" id="new_password" type="text" class="form-control" value="{{ Auth::user()->email }}">
												</div>
												<div class="col-md-12">
													<label class="form-label">PHONE NUMBER</label>
													<input name="confirm_password" id="confirm_password" type="text" class="form-control" value="{{ Auth::user()->phone }}">
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary">Reply</button>
									</div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="editPhoto" data-backdrop="static">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Upload images</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal">
										</button>
									</div>
									<div class="modal-body">
										<div class="input-group mb-3">
											<span class="input-group-text">Upload</span>
											<div class="form-file">
												<input type="file" class="form-file-input form-control  border-s-1">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
@endsection