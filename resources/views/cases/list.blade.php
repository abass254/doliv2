@extends('layouts')




@section('js')


    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/list-files.js') }}" type="text/javascript"></script>

@endsection

@section('content')
@section('page-title', 'Files')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


<style>
	
.row {
	display: flex; /* Ensure the row uses flexbox layout */
	align-items: stretch; /* Make all child elements (columns) stretch equally */
}

.chatbox { /* Optional: Keep the flex layout for chatbox content */
	height: 100%; /* Ensure it takes up the full height of its parent column */
}
	/* Resize the pagination container */
.dataTables_paginate {
    font-size: 12px;  /* Reduce the font size */
}

/* Resize pagination buttons */
.dataTables_paginate .paginate_button {
    font-size: 12px;  /* Reduce button text size */
    padding: 5px 10px; /* Reduce padding inside the buttons */
}

/* Resize the "Previous" and "Next" buttons */
.dataTables_paginate .paginate_button.previous,
.dataTables_paginate .paginate_button.next {
    padding: 5px 12px;  /* Adjust padding for these buttons */
}

/* Resize the current page button */
.dataTables_paginate .paginate_button.current {
    font-size: 12px;
    padding: 5px 10px;
}

/* Optional: Reduce space between buttons */
.dataTables_paginate .paginate_button {
    margin-right: 5px;  /* Reduce space between buttons */
}

.dataTables_wrapper .dataTables_filter input {
	display: block;
	width: 100%;
	padding: 0.375rem 0.75rem;
	font-size: 0.875rem;
	font-weight: 400;
	line-height: 1.5;
	color: var(--bs-body-color);
	appearance: none;
	background-color: var(--bs-body-bg);
	background-clip: padding-box;
	border: var(--bs-border-width) solid #d7dae3;
	border-radius: var(--bs-border-radius);
	transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; 
}

#example_filter{
	margin-top:10px;
	margin-bottom: 2px;
}

	
	
</style>

<div class="container-fluid">
	<div class="page-titles">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/">Home Page</a></li>
		</ol>
	</div>

	
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body py-0 px-3">
					<div class="table">
						<table id="example" class="table display table-responsive table-bordeed -sm mb-0" >
							<thead>
								<tr class="text-uppercase text-info" >
									<th style="width:2px;" class="align-middle">
										<div class="form-check custom-checkbox">
											<input type="checkbox" class="form-check-input" id="checkAll">
											<label class="form-check-label d-block" for="checkAll"></label>
										</div>
									</th>
									<th style="width:2px;"></th>
									<th style="width:7px;">#</th>
									<th>DAYS REM</th>
									<th>FILE TYPE</th>
									<th class="align-middle">CLIENT INFORMATION</th>
									<th class="align-middle pe-7">DATE OF LOSS</th>
									<th class="align-middle pe-7">DATE OPENED</th>
									<th class="align-middle" style="min-width: 9.5rem;">PRIMARY ADDRESS</th>
									
									<th class="align-middle text-end">ACTION</th>
								</tr>
							</thead>
							<tbody id="orders">
								@foreach($data as $key => $dt)
								<tr class="btn-reveal-trigger">
									<td style="width:2px;" class="py-2">
										<div class="form-check custom-checkbox checkbox-success">
											<input type="checkbox" class="form-check-input" id="checkbox">
											<label class="form-check-label" for="checkbox"></label>
										</div>
									</td>
									<td style="width:2px;">
										<a {{ $dt->alert }} class="nav-link ai-icon" style="color: red;" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
											<i class="flaticon-381-ring"></i>
											
										</a>
									</td>
									
									<td style="width:7px;"><strong  class="text-primary">{{ $dt->file_no }}</strong></td>
									<td class="text-center"><span class="mx-auto badge badge-{{$dt->dol_theme }}">{{ $dt->dol_days }}</span></td>
									<td>{{ $dt->file_type }}</td>
									<td class="py-2" style="width:14px;">
										<a href="#">
											<strong class="text-primary"></strong></a><span class="text-primary text-capitalize">{{ $dt->first_name .' '. $dt->last_name }}</span>
											<br><a class="text=danger" href="javascript:void(0);">{{ $dt->client_phone_no }}</a>
									</td>
									<td class="py-2" style="width:12px;">{{ $dt->date_of_loss }}</td>
									<td class="py-2" style="width:12px;">{{ $dt->opened }}</td>
									<td class="py-2">
										<p class="mb-0 text-left text-500">{{ $dt->client_address }}</p>
									</td>
									<td class="py-2 d-flex">
										<a href="{{ route('files.edit', $dt->id) }}" class="btn btn-danger btn-sm sharp m-1">
											<b>EDIT</b>
										</a>
										<a href="files/{{ $dt->id }}" class="btn btn-primary btn-sm sharp m-1"><b>
										VIEW
										</b>
										
									</a>
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
	
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
	

@endsection