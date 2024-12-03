@extends('layouts')

@section('content')
@section('page-title', 'Edit File')
<div class="container-fluid">
	<div class="page-titles">
		<ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="btn btn-info text-light" href="/files/{{$data->id}}">Back to view File</a></li>
		</ol>
	</div>

	<div class="col-xl-12 col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Please fill in the form below</h4>
			</div>
			<div class="card-body">
				<div class="basic-form">
					<form method="POST" action="{{ route('files.update', $data->id) }}">
                        @csrf
                        @method('PUT')
						<h3>Basic information</h3>
						@if ($errors->any())
							<div class="alert alert-danger">
								{{ $errors->first() }}
							</div>

                        @elseif(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
						@endif
                        
						@csrf
						<div class="row">
							
							<br>
							<div class="col-md-3">
								<label class="form-label">FILE NO</label>
								<input name="file_no" id="file_no" value="{{ $data->file_no }}" style="background-color:#e5e5e5" readonly type="text" class="form-control text-primary fw-bold" placeholder="Select file type">
							</div>
                            <div class="col-md-3">
								<label class="form-label">FILE TYPE</label>
								<select disabled class="form-control" id="file_type" value="{{$data->file_type}}" name="file_type" required onchange="updateFileNo()">
                                    <option selected value="{{$data->file_type}}">{{$data->file_type}}</option>
                                    <option value="Accident Benefit">Accident Benefit</option>
                                    <option value="Personal Injury">Personal Injury</option>
                                </select>
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">FILE CITY</label>
								<select class="form-control" id=""  name="file_city" required>
                                    <option selected value="{{$data->file_city}}">{{$data->file_city}}</option>
                                    <option value="Ottawa">Ottawa</option>
                                    <option value="Toronto">Toronto</option>
                                </select>
							</div>
							<div class="mb-3 col-md-3">
								<label id="first_name" class="form-label">CLIENT'S FIRST NAME</label>
								<input value="{{$data->first_name}}" name="first_name" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">CLIENT'S LAST NAME</label>
								<input value="{{$data->last_name}}" name="last_name" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">TORT(Y/N)</label>
								<input value="{{$data->tort}}" name="tort" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">DATE OF LOSS</label>
								<input value="{{$data->date_of_loss}}" name="date_of_loss" id="facility_location" type="date" class="form-control text-uppercase" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">DATE OPENED</label>
								<input value="{{$data->opened}}" name="opened" id="facility_location" type="date" class="text-uppercase form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">CLAIM NO</label>
								<input value="{{$data->claim_no}}" name="claim_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">POLICY NO</label>
								<input value="{{$data->policy_no}}" name="policy_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">CLIENT ADDRESS</label>
								<input value="{{$data->client_address}}" name="client_address" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">CLIENT PHONE NO</label>
								<input value="{{$data->client_phone_no}}" name="client_phone_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">CLIENT DOB</label>
								<input value="{{$data->date_of_birth}}" name="date_of_birth" id="facility_location" type="date" class="text-uppercase form-control" placeholder="">
							</div>
							<div class="mb-3 col-md-3">
								<label class="form-label">DRIVERS LICENSE</label>
								<input value="{{$data->drivers_license}}" name="drivers_license" id="email" type="email" class="form-control" placeholder="">
							</div>
							<div class="mb-3 col-md-3">
								<label class="form-label">INSURANCE COMPANY</label>
								<input value="{{$data->ins_company}}" name="ins_company" id="phone" type="text" class="form-control" placeholder="">
							</div>
							<div class="mb-3 col-md-3">
								<label class="form-label">INSURANCE ADDRESS</label>
                                <input value="{{$data->ins_address}}" name="ins_address" id="phone" type="text" class="form-control" placeholder="">							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">ADJUSTER NAME</label>
								<input value="{{$data->adj_name}}" name="adj_name" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">ADJUSTER PHONE NO</label>
								<input value="{{$data->adj_phone_no}}" name="adj_phone_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">ADJUSTER FAX NO</label>
								<input value="{{$data->adj_fax_no}}" name="adj_fax_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">FAMILY DOCTOR</label>
								<input value="{{$data->family_doctor}}" name="family_doctor" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">DOCTORS ADDRESS</label>
								<input value="{{$data->doctor_address}}" name="doctor_address" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">DOCTOR'S PHONE NO</label>
								<input value="{{$data->doctor_phone_no}}" name="doctor_phone_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">DOCTOR'S FAX NO</label>
								<input value="{{$data->doc_fax_no}}" name="doc_fax_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">REHAB CENTER</label>
								<input value="{{$data->rehab}}" name="rehab" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">REHAB'S PHONE N0</label>
								<input value="{{$data->rehab_phone_no}}" name="rehab_phone_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">REHAB'S FAX NO</label>
								<input value="{{$data->rehab_fax_no}}" name="rehab_fax_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">ASSESSMENT CENTER</label>
								<input value="{{$data->assessment_center}}" name="assessment_center" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">ASSESSEMENT'S FAX NO</label>
								<input value="{{$data->assessment_fax_no}}" name="assessment_fax_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">OHIP NO</label>
								<input value="{{$data->ohip_no}}" name="ohip_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">SIN NO</label>
								<input value="{{$data->sin_no}}" name="sin_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            
							
						</div>
						<hr>
						
						<button type="submit" class="btn btn-primary btn-register-doctor">SAVE DATA</button>
					</form>
				</div>
			</div>
		</div>
	</div>
    <script>

    
</script>

@endsection