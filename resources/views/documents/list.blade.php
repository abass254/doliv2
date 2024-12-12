@extends('layouts')

@section('js')


    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/list-files.js') }}" type="text/javascript"></script>

@endsection

@section('content')
@section('page-title', 'View Document')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<style>
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

	<div class="col-lg-12">
		<div class="card overflow-hidden">
			<div class="card-body py-0 px-3">
				<div class="table-responsive">
                    <a class="btn btn-primary m-3" href="/documents/create">CREATE NEW DOCUMENT</a>
					<table id="example" class="table display table-responsive table-bordeed m-2">
						<thead>
							<tr class="text-uppercase">
								<th style="width:2px;" class="align-middle">
									<div class="form-check custom-checkbox">
										<input type="checkbox" class="form-check-input" id="checkAll">
										<label class="form-check-label d-block" for="checkAll"></label>
									</div>
								</th>
								<th style="width:2px;">#</th>
								<th class="align-middle">Document Name</th>
                                <th>Created By</th>
								<th class="align-middle text-end">Action</th>
							</tr>
						</thead>
                        <tbody id="orders">
							@foreach($data as $key => $dt)
							<tr class="btn-reveal-trigger">
								<td style="width:2px;" class="">
									<div class="form-check custom-checkbox checkbox-success">
										<input type="checkbox" class="form-check-input" id="checkbox">
										<label class="form-check-label" for="checkbox"></label>
									</div>
								</td>
								<td style="width:1px;"><strong class="text-primary">{{ $key+1 }}</strong></td>
								<td class="py-2" style="width:12px;">
									<a href="#">
										<strong class="text-primary"></strong></a> <strong class="text-primary">{{ $dt->title }}
                                </td>
                                <td class="font-weight-light">{{ $dt->creator }}</td>
								<td class="py-2 text-end">
									<a href="/documents/{{$dt->id}}" class="btn btn-info btn-sm"><b>VIEW</b></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


@endsection