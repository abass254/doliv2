@extends('layouts')

@section('content')
@section('page-title', 'Create a File')
<div class="container-fluid">
	<div class="page-titles">
		<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/files">View Files</a></li>
		</ol>
	</div>

	<div class="col-xl-12 col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Please fill in the form below</h4>
			</div>
			<div class="card-body">
					<form action="/import-file" method="POST" enctype="multipart/form-data">
						@csrf
						<label for="file">Upload Excel File:</label>
						<span class="d-flex">
							<input class="form-control form-control-sm" type="file" name="file" accept=".xlsx,.xls,.csv">
							<button class="btn btn-sm btn-success" type="submit">Import</button>
						</span>
						
					</form>
				<div class="basic-form">
					<br><br><br>

					<form method="POST" action="/files">
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
								<input name="file_no" id="file_no" style="background-color:#e5e5e5" readonly type="text" class="form-control text-primary fw-bold" placeholder="Select file type">
							</div>
                            <div class="col-md-3">
								<label class="form-label">FILE TYPE</label>
								<select class="form-control" id="file_type" name="file_type" required onchange="updateFileNo()">
                                    <option value="">-- Select File Type --</option>
                                    <option value="Accident Benefit">Accident Benefit</option>
                                    <option value="Personal Injury">Personal Injury</option>
                                    <option value="Immigration Matter">Immigration</option>
                                    <option value="Slip Fall">Slip & Fall</option>
                                    <option value="Family">Family</option>
									<option value="Medical Case">Medical Case</option>
                                </select>
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">FILE CITY</label>
								<select class="form-control" id="" name="file_city" required>
                                    <option value="">-- Select City --</option>
                                    <option value="Ottawa">Ottawa</option>
                                    <option value="Toronto">Toronto</option>
                                </select>
							</div>
							<div class="mb-3 col-md-3">
								<label id="first_name" class="form-label">CLIENT'S FIRST NAME</label>
								<input name="first_name" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">CLIENT'S LAST NAME</label>
								<input name="last_name" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">TORT(Y/N)</label>
								<input name="tort" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">DATE OF LOSS</label>
								<input name="date_of_loss" id="facility_location" type="date" class="form-control text-uppercase" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">DATE OPENED</label>
								<input name="opened" id="facility_location" type="date" class="text-uppercase form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">CLAIM NO</label>
								<input name="claim_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">POLICY NO</label>
								<input name="policy_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">CLIENT ADDRESS</label>
								<input name="client_address" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">CLIENT PHONE NO</label>
								<input name="client_phone_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">CLIENT DOB</label>
								<input name="date_of_birth" id="facility_location" type="date" class="text-uppercase form-control" placeholder="">
							</div>
							<div class="mb-3 col-md-3">
								<label class="form-label">DRIVERS LICENSE</label>
								<input name="drivers_license" id="email" type="email" class="form-control" placeholder="">
							</div>
							<div class="mb-3 col-md-3">
								<label class="form-label">INSURANCE COMPANY</label>
								<input name="ins_company" id="phone" type="text" class="form-control" placeholder="">
							</div>
							<div class="mb-3 col-md-3">
								<label class="form-label">INSURANCE ADDRESS</label>
                                <input name="ins_address" id="phone" type="text" class="form-control" placeholder="">							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">ADJUSTER NAME</label>
								<input name="adj_name" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">ADJUSTER PHONE NO</label>
								<input name="adj_phone_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">ADJUSTER FAX NO</label>
								<input name="adj_fax_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">FAMILY DOCTOR</label>
								<input name="family_doctor" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">DOCTORS ADDRESS</label>
								<input name="doctor_address" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">DOCTOR'S PHONE NO</label>
								<input name="doctor_phone_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">DOCTOR'S FAX NO</label>
								<input name="doc_fax_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">REHAB CENTER</label>
								<input name="rehab" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">REHAB'S PHONE N0</label>
								<input name="rehab_phone_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">REHAB'S FAX NO</label>
								<input name="rehab_fax_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">ASSESSMENT CENTER</label>
								<input name="assessment_center" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">ASSESSEMENT'S FAX NO</label>
								<input name="assessment_fax_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">OHIP NO</label>
								<input name="ohip_no" id="facility_location" type="text" class="form-control" placeholder="">
							</div>
                            <div class="mb-3 col-md-3">
								<label class="form-label">SIN NO</label>
								<input name="sin_no" id="facility_location" type="text" class="form-control" placeholder="">
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

    document.addEventListener("DOMContentLoaded", function () {
        // Find all input fields
        const inputs = document.querySelectorAll("input, textarea, select");

        inputs.forEach(input => {
            // Get the input's associated label
            const label = document.querySelector(`label[for="${input.id}"]`);
            if (label) {
                // Set the placeholder to "Enter " + label's text
                input.placeholder = `Enter ${label.textContent.trim()}`;
            }
        });
    });
    function updateFileNo() {
        const file_type = document.getElementById('file_type').value;


        

        if (file_type) {
            fetch(`/files/next-file-no?file_type=${encodeURIComponent(file_type)}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    document.getElementById('file_no').value = data.NextFileNo;
                })
                .catch(error => {
                    console.error('Error fetching file number:', error);
                });
        } else {
            document.getElementById('file_no').value = '--/----';
        }
    }
</script>

@endsection