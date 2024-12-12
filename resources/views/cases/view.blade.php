@extends('layouts')

@section('content')

@section('page-title', 'View Case')
<div class="container-fluid">
    <div class="page-titles">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/">Home Page</a></li>
		</ol>
	</div>
    
	
    <div class="row">
        <div class="col-xl-9">
            <div class="row">
                <div class="card h-auto">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item" role="presentation"><a href="#client-info" data-bs-toggle="tab" class="nav-link active" aria-selected="true" role="tab">Client Info</a>
                                    </li>
                                    
                                    <li class="nav-item" role="presentation"><a href="#medical-info" data-bs-toggle="tab" class="nav-link show" aria-selected="false" role="tab" tabindex="-1">Medical Info</a>
                                    </li>
                                    <li class="nav-item" role="presentation"><a href="#insurance-info" data-bs-toggle="tab" class="nav-link" aria-selected="false" role="tab" tabindex="-1">Insurance Info</a>
                                    </li>
                                    <li class="nav-item" role="presentation"><a href="#file-contacts" data-bs-toggle="tab" class="nav-link" aria-selected="true" role="tab">File Contacts</a>
                                    </li>
                                    @if(Auth::user()->role == "Accountant")
                                    <li class="nav-item" role="presentation"><a href="#finance" data-bs-toggle="tab" class="nav-link" aria-selected="true" role="tab">Finance</a>
                                    </li>
                                    @endif
                                </ul>
                                <div class="tab-content">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                    <div id="medical-info" class="tab-pane fade" role="tabpanel">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="row mt-3">
                                                    <div class="col-sm-5 col-5">
                                                        <h5 class="f-w-500">Family Doctor<span class="pull-end">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-sm-6 col-7"><span>{{ $data->family_doctor ?? 'N/A' }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-5 col-">
                                                        <h5 class="f-w-500">Doctor's Address <span class="pull-end">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-sm-6 col-7"><span>{{ $data->doctor_address ?? 'N/A' }} </span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-5 col-5">
                                                        <h5 class="f-w-500">Doctor's Phone Number<span class="pull-end">:</span></h5>
                                                    </div>
                                                    <div class="col-sm-6 col-7"><span>{{ $data->doctor_phone_no ?? 'N/A'}}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-5 col-5">
                                                        <h5 class="f-w-500">Doctor's Fax Number<span class="pull-end">:</span></h5>
                                                    </div>
                                                    <div class="col-sm-6 col-7 text-capitalize"><span>{{ $data->doc_fax_no ?? 'N/A' }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-5 col-5">
                                                        <h5 class="f-w-500">Rehab Center<span class="pull-end">:</span></h5>
                                                    </div>
                                                    <div class="col-sm-6 col-7 text-capitalize"><span>{{ $data->rehab ?? 'N/A' }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-5 col-5">
                                                        <h5 class="f-w-500">Rehab Phone No<span class="pull-end">:</span></h5>
                                                    </div>
                                                    <div class="col-sm-6 col-7 text-capitalize"><span>{{ $data->rehab_phone_no ?? 'N/A' }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-5 col-5">
                                                        <h5 class="f-w-500">Rehab Fax Number<span class="pull-end">:</span></h5>
                                                    </div>
                                                    <div class="col-sm-6 col-7 text-capitalize"><span>{{ $data->rehab_fax_no ?? 'N/A' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">    
                                                <div class="row mb-2">
                                                    <div class="col-sm-5 col-5">
                                                        <h5 class="f-w-500">Assessment Center<span class="pull-end">:</span></h5>
                                                    </div>
                                                    <div class="col-sm-6 col-7 text-capitalize"><span>{{ $data->assessment_center ?? 'N/A' }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-5 col-5">
                                                        <h5 class="f-w-500">Assessment Fax Number <span class="pull-end">:</span></h5>
                                                    </div>
                                                    <div class="col-sm-6 col-7 text-capitalize"><span>{{ $data->assessment_fax_no ?? 'N/A' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="insurance-info" class="tab-pane fade" role="tabpanel">
                                            <div class="row mb-2 mt-3">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-200">Insurance Company<span class="pull-end">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7"><span>{{ $data->ins_company ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">Physical Address <span class="pull-end">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7"><span>{{ $data->ins_address ?? 'N/A' }} </span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">Claim No<span class="pull-end">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7"><span>{{ $data->claim_no ?? 'N/A' }} </span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">Policy No<span class="pull-end">:</span></h5>
                                                </div>
                                                <div class="col-sm-9 col-7"><span>{{ $data->policy_no ?? 'N/A'}}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">Adjuster<span class="pull-end">:</span></h5>
                                                </div>
                                                <div class="col-sm-9 col-7 text-capitalize"><span>{{ $data->adj_name ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">Phone Number<span class="pull-end">:</span></h5>
                                                </div>
                                                <div class="col-sm-9 col-7 text-capitalize"><span>{{ $data->adj_phone_no }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">Fax Number<span class="pull-end">:</span></h5>
                                                </div>
                                                <div class="col-sm-9 col-7 text-capitalize"><span>{{ $data->adj_fax_no }}</span>
                                                </div>
                                            </div>
                                    </div>
                                    <div id="client-info" class="tab-pane fade active show" role="tabpanel">
                                        <div class="profile-personal-info">
                                            <!-- <h4 class="text-primary mb-4">Personal Information</h4> -->
                                            <div class="row mb-2 mt-3">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-200">Full Name<span class="pull-end">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7"><span>{{ $data->first_name .' '. $data->last_name ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">Physical Address <span class="pull-end">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7"><span>{{ $data->client_address ?? 'N/A' }} </span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">Phone Number<span class="pull-end">:</span></h5>
                                                </div>
                                                <div class="col-sm-9 col-7"><span>{{ $data->client_phone_no ?? 'N/A'}}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">Date of Birth<span class="pull-end">:</span></h5>
                                                </div>
                                                <div class="col-sm-9 col-7 text-capitalize"><span>{{ $data->date_of_birth ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">Drivers License<span class="pull-end">:</span></h5>
                                                </div>
                                                <div class="col-sm-9 col-7 text-capitalize"><span>{{ $data->drivers_license }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        
                                    </div>
                                    <div id="file-contacts" class="tab-pane fade" role="tabpanel">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <table class="table table-responsive table-striped table- display table-sm mb-0">
                                                        <thead>
                                                            <tr><th colspan="4" >
                                                                <button style="float:right;" id="approve-selected" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                                                    ADD CONTACT
                                                                </button>
                                                            </th>   
                                                            
                                                            </tr>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Contact Information</th>
                                                                <th>Phone/Cell/Fax No</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(count($contacts) < 1)
                                                                <tr>
                                                                    <td colspan=3 class="text-center">No Contact information</td>
                                                                </tr>
                                                            @else
                                                                @foreach($contacts as $key=>$ct)
                                                                <tr>
                                                                    <td>{{ $key +1}}</td>
                                                                    <td>{{ $ct->fl_title }}</td>
                                                                    <td>{{ $ct->fl_contact }}</td>
                                                                    <td><a href="" class="btn btn-danger btn-xs mr-0">EDIT</a></td>
                                                                </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="finance" class="tab-pane fade" role="tabpanel">
                                        <div class="col-lg-12">
                                            <div class="card"> 
                                                <div class="d-flex">
                                                    <button class="btn m-3 btn-success btn-sm ml-auto" data-bs-toggle="modal" data-bs-target="#financeModal">
                                                        ADD FINANCE INFORMATION
                                                    </button>
                                                </div>

                                                <div class="card-body dz-scroll height360">
                                                    <table class="table table-responsive table-striped table- display table-sm mb-0">
                                                        <thead>
                                                            <tr><th colspan="6" >
                                                            
                                                            </th>   
                                                            
                                                            </tr>
                                                            <tr>
                                                                <th>#</th>
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
                                                                    <td colspan=6 class="text-center">No Contact information</td>
                                                                </tr>
                                                            @else
                                                                @foreach($finances as $key=>$ct)
                                                                <tr>
                                                                    <td>{{ $key +1}}</td>
                                                                    <td>{{ $ct->fn_title }}</td>
                                                                    <td class="text-bold text-left"><b>${{ number_format($ct->fn_amount, 2) }}</b></td>
                                                                    <td>{{ $ct->fn_type == 0 ? 'Expense' : 'Profit' }}</td>
                                                                    <td>{{ $ct->date }}</td>
                                                                    <td><a href="" data-pdf-filename="{{ $ct->fn_filename }}" data-bs-toggle="modal" data-bs-target="#viewPDF" class="btn btn-primary btn-xs mr-0">VIEW</a></td>
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
                            </div>
                            <!-- Modal -->

                        </div>
                    </div>
                </div>
                <div class="card h-auto">
                    <div class="card-header">
                        <h4 class="card-title"><b><i class="la la-database me-2"></i>File Station</b></h4>
                    </div>
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#uploaded-files" aria-selected="true" role="tab"><i class="la la-folder me-2"></i>Uploaded Files</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#created-files" aria-selected="false" role="tab" tabindex="-1"><i class="la la-pen me-2"></i>Created Files</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane dz-scroll height600 fade active show" id="uploaded-files" role="tabpanel">
                                    <div class="pt-4">
                                        <div class="row">
                                            @foreach($files as $fl)
                                            <div class="col-md-2 mb-2" id="">
                                                <div class="new-arrival-product">
                                                    <div class="new-arrivals-img-connent">
                                                    <img class="img-fluid" src="{{ asset('images/product/pdf.png') }}" alt="">
                                                    </div>
                                                    <div class="new-arrival-content text-center mt-3">
                                                        <p class="text-capitalize text-truncate" title="{{ $fl->folder_name }}">{{ $fl->folder_name }}</p>
                                                        <span class="price">
                                                            <a href=" {{ route('view_uploaded_file', $fl->id) }}" 
                                                            class="btn btn-sm btn-block btn-danger">VIEW</a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="created-files" role="tabpanel">
                                    <div class="pt-4">
                                        <div class="row">
                                            @foreach($documents as $fl)
                                            <div class="col-md-2 mb-2" id="">
                                                <div class="new-arrival-product">
                                                    <div class="new-arrivals-img-connent">
                                                    <img class="img-fluid" src="{{ asset('images/product/pdf.png') }}" alt="">
                                                    </div>
                                                    <div class="new-arrival-content text-center mt-3">
                                                        <p class="text-capitalize text-truncate" title="{{ $fl->title }}">{{ $fl->title }}</p>
                                                        <span class="price">
                                                            <a href="/documents/{{ $fl->id }}" 
                                                            class="btn btn-sm btn-block btn-primary">VIEW</a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <div class="col-xl-3">
            <div class="row">
                <div class="clearfix">
                    <div class="card card-bx profile-card author-profile mb-3">
                        <div class="card-body">
                            <div class="p-2">
                            <div class="author-profile">
                                <div class="author-info" style="text-align:center;">
                                    <h1>{{ $data->file_no ?? 'N/A' }}</h1>
                                    <strong><span style="display: inline" class="badge badge-danger text-light mb-3">{{ $data->date_of_loss ?? 'YYYY-MM-DD' }}</span></strong>
                                    <h6 class="title text-uppercase mt-2">{{ $data->first_name . ' '. $data->last_name ?? 'Nella Vita' }}</h6>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a class="btn btn-primary btn-sm" href="{{ route('files.edit', $data->id) }}">EDIT</a>
                            <a class="btn btn-info btn-sm {{ $data->status == '2' ? 'disabled' : '' }}" href="/">CREATE DOCUMENT</a>
                            <!-- <a class="btn btn-primary btn-sm text-light" href="/documents/create">CREATE FILE</a> -->
                        </div>

                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h4 class="card-title">Timeline</h4>
                        </div>
                        <div class="card-body p-0">
                            <div id="DZ_W_TimeLine" class="widget-timeline dz-scroll  my-4 px-4 height370">
                                <ul class="timeline">
                                    <li>
                                        <div class="timeline-badge primary"></div>
                                        <a class="timeline-panel text-muted" href="#">
                                            <span>10 minutes ago</span>
                                            <h6 class="mb-0">Youtube, a video-sharing website, goes live <strong class="text-primary">$500</strong>.</h6>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="timeline-badge info">
                                        </div>
                                        <a class="timeline-panel text-muted" href="#">
                                            <span>20 minutes ago</span>
                                            <h6 class="mb-0">New order placed <strong class="text-info">#XF-2356.</strong></h6>
                                            <p class="mb-0">Quisque a consequat ante Sit amet magna at volutapt...</p>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="timeline-badge danger">
                                        </div>
                                        <a class="timeline-panel text-muted" href="#">
                                            <span>30 minutes ago</span>
                                            <h6 class="mb-0">john just buy your product <strong class="text-warning">Sell $250</strong></h6>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="timeline-badge success">
                                        </div>
                                        <a class="timeline-panel text-muted" href="#">
                                            <span>15 minutes ago</span>
                                            <h6 class="mb-0">StumbleUpon is acquired by eBay. </h6>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="timeline-badge warning">
                                        </div>
                                        <a class="timeline-panel text-muted" href="#">
                                            <span>20 minutes ago</span>
                                            <h6 class="mb-0">Mashable, a news website and blog, goes live.</h6>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="timeline-badge dark">
                                        </div>
                                        <a class="timeline-panel text-muted" href="#">
                                            <span>20 minutes ago</span>
                                            <h6 class="mb-0">Mashable, a news website and blog, goes live.</h6>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
	</div>


    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">File Contacts</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="" method="POST" action="{{ route('file-contacts') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 col-md-12">
                            <label id="contact_details" class="form-label">Contact Information</label>
                            <input name="fl_title" id="fl_title" type="text" class="form-control" placeholder="Provide general information of the contact">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label id="contact_details" class="form-label">Phone/Fax/Cell No</label>
                            <input name="fl_contact" id="fl_contact" type="text" class="form-control" placeholder="Phone/Fax/No">
                        </div>
                        <input type="hidden" name="fl_file" id="fl_file" value="{{ $data->id }}">
                        <!-- <button type="submit" class="btn btn-primary">Confirm</button> -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                        
                        <input type="hidden" name="fn_file" id="fn_file" value="{{ $data->id }}">
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