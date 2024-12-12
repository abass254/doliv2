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
                        <table class="table table-responsive table-striped table- display table-sm mb-0">
                            <thead>
                                <tr><th colspan="6" >
                                
                                </th>   
                                
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>FILE NO</th>
                                    <th>TRANSACTION</th>
                                    <th>AMOUNT</th>
                                    <th>TYPE</th>
                                    <th>DATE</th>
                                    <th class="text text-danger"><b>${{ number_format($amount) }}</b></th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @if(count($finances) < 1)
                                    <tr>
                                        <td colspan=7 class="text-center">No Transaction information</td>
                                    </tr>
                                @else
                                    @foreach($finances as $key=>$ct)
                                  
                                    <tr>
                                        <td>{{ $key +1}}</td>
                                        <td>{{$ct->file_no}}</td>
                                        <td>{{ $ct->fn_title }}</td>
                                        <td class="text-bold text-left"><b>${{ number_format($ct->fn_amount, 2) }}</b></td>
                                        <td>{{ $ct->fn_type == 0 ? 'Expense' : 'Profit' }}</td>
                                        <td>{{ $ct->date }}</td>
                                        <td><a href="" data-pdf-filename="{{ $ct->fn_filename }}" data-bs-toggle="modal" data-bs-target="#viewPDF" class="btn btn-primary btn-xs mr-0">TRANSACTION PROOF</a></td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
					</div>
				</div>
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