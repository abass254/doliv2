@extends('layouts')

@section('content')
<div class="container-fluid">
<div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">OLD SERVER Files</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card overflow-hidden">
                <div class="card-body py-0 px-3">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th class=" pe-3">
                                        <div class="form-check custom-checkbox checkbox-primary mx-2">
                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                            <label class="form-check-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    <th>File Name</th>
                                    <th>File Type</th>
                                    <th>File Path</th>
                                    <th class=" pl-5" style="min-width: 200px;">Billing Address
                                    </th>
                                    <th>Joined</th>
                                    <th class="">Actions</th>
                                </tr>
                            </thead>
							<tbody>
							@foreach($data as $dt)
							<tr class="btn-reveal-trigger">
								<td class="py-2">
									<div class="form-check custom-checkbox checkbox-primary mx-2">
										<input type="checkbox" class="form-check-input" id="checkbox1">
										<label class="form-check-label" for="checkbox1"></label>
									</div>
								</td>
								<td class="py-2">
									<a href="javascript:void(0);">
										<div class="media d-flex align-items-center">
											<div class="avatar avatar-xl me-2">
												<div class=""><img class="rounded-circle img-fluid"
														src="{{ asset('images/avatar/5.png') }}" width="30" alt="">
												</div>
											</div>
											<div class="media-body">
												<h5 class="mb-0 fs--1">{{ $dt['name'] }}</h5>
											</div>
										</div>
									</a>
								</td>
								<td class="py-2">{{ $dt['meta_type'] }}</td>
								<td class="py-2">{{ $dt['meta_path'] }}</td>
								<td class="py-2 pl-5">2392 Main Avenue, Penasauka</td>
								<td class="py-2">30/03/2018</td>
								<td class="py-2 text-right">
									<div class="dropdown"><button class="btn btn-primary tp-btn-light sharp" type="button" data-bs-toggle="dropdown"><span class="fs--1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></span></button>
										<div class="dropdown-menu dropdown-menu-end border py-0">
											<div class="py-2"><a class="dropdown-item"  href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
										</div>
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
</div>
@endsection