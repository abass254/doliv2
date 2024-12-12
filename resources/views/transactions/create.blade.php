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
									<th style="width:2px;"></th>
									<th style="width:7px;">#</th>
									<th class="align-middle">CLIENT INFORMATION</th>
									<th class="align-middle" width="2px;">TOTAL TRANSACTIONS</th>
									<th class="align-middle text-end">ACTION</th>
								</tr>
							</thead>
							<tbody id="orders">
								@foreach($data as $key => $dt)



									<div class="modal fade" id="financeModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="confirmModalLabel">Financial Statement</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<form id="" enctype="multipart/form-data" method="POST" action="{{ route('file-finances') }}">
													@csrf
													<div class="modal-body">
														<div class="row">
															<div class="mb-3 col-md-12">
																<label id="contact_details" class="form-label">Transaction Description</label>
																<textarea required name="fn_title" class="form-control form-control-sm" id="fn_title"></textarea>
															</div>
															<div class="mb-3 col-md-6">
																<label id="contact_details" class="form-label">Transaction Type</label>
																<select class="form-control form-control-sm" required name="fn_type" id="">
																	<option selected disabled value=""></option>
																	<option value="0">Expense</option>
																	<option value="1">Profit</option>
																</select>
															</div>
															<div class="mb-3 col-md-6">
																<label id="contact_details" class="form-label">Transaction Amount</label>
																<input required name="fn_amount" id="fn_amount" type="number" class="form-control form-control-sm text-right" placeholder="0.00">
															</div>
															<div class="mb-3 col-md-12">
																<label id="contact_details" class="form-label">Proof of Transaction(Cheque, Receipt....)</label>
																<input required name="fn_filename" id="fn_filename" type="file" class="form-control form-control-sm">
															</div>
														</div>
														
														<input type="hidden" name="fn_file" id="fn_file" value="{{ $dt->id }}">
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-primary">Save Data</button>
													</div>
												</form>
											</div>
										</div>
									</div>


									<div class="modal modal-lg fade" id="viewPDF" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="confirmModalLabel">Proof of payment</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<iframe id="pdfViewer" src="" width="100%" height="600px" frameborder="0"></iframe>
												</div>
											</div>
										</div>
									</div>





								<tr class="btn-reveal-trigger">
									<td style="width:2px;">
										<a {{ $dt->alert }} class="nav-link ai-icon" style="color: red;" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
											<i class="flaticon-381-ring"></i>
										</a>
									</td>
									<td style="width:7px;"><strong  class="text-primary">{{ $key +1 }}</strong></td>
									<td class="py-2" style="width:14px;">
										<a href="#">
											<strong class="text-primary"></strong></a><span class="text-primary text-capitalize">{{ $dt->file_no }} - {{ $dt->first_name .' '. $dt->last_name }}</span>
											<br><a class="text=danger" href="javascript:void(0);">{{ $dt->client_phone_no }}</a>
									</td>
									<td class="py-2" style="width:1px;">{{$dt->amount }}</td>
									<td class="py-2 d-flex">
										<a href="" class="btn btn-danger btn-sm btn-block sharp m-1" data-bs-toggle="modal" data-bs-target="#financeModal">
											<b>DISBURSMENT</b>
										</a>
										<a href="/files/{{ $dt->id }}" class="btn btn-primary btn-sm btn-block sharp m-1"><b>
										VIEW FILE
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
	<script>
       document.addEventListener('DOMContentLoaded', function () {
        const viewPDFModal = document.getElementById('viewPDF');

        viewPDFModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            const button = event.relatedTarget;

            // Extract the filename from data-* attributes
            const fileName = button.getAttribute('data-pdf-filename');

            // Build the full URL for the PDF file
            const fileUrl = `{{ asset('storage/finance') }}/${fileName}`;

            // Update the modal's iframe source
            const pdfViewer = viewPDFModal.querySelector('#pdfViewer');
            pdfViewer.src = fileUrl;
        });
    });

    </script>
	

@endsection