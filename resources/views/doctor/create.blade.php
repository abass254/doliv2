@extends('layouts')

@section('content')
@section('page-title', 'Facility Registration')
<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.min.css"
  rel="stylesheet"
/>
<div class="container-fluid">
	<div class="page-titles">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/">Home Page</a></li>
		</ol>
	</div>
    <div class="col-xl-12 col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Please fill in the form below</h4>
			</div>
			<div class="card-body">
				<div class="basic-form">
					<form method="POST" action="{{ route('facility-register') }}">
						<h3>Facility information</h3>
						@if ($errors->any())
							<div class="alert alert-danger">
								{{ $errors->first() }}
							</div>
						@endif
						@csrf
						<div class="row">
							
							<br>
							<div class="col-md-3">
								<label class="form-label">FACILITY NAME</label>
								<input name="fc_name" id="hospital" type="text" class="form-control" placeholder="ABC Hospital Clinic">
							</div>
							<div class="mb-3 col-md-3">
								<label class="form-label">FACILITY LOCATION</label>
								<input name="fc_location" id="facility_location" type="text" class="form-control" placeholder="ABC Building, Juja Rd, Pangani, Nairobi">
							</div>
							<div class="mb-3 col-md-3">
								<label class="form-label">FACILITY EMAIL</label>
								<input name="fc_email" id="email" type="email" class="form-control" placeholder="johndoe@mail.com">
							</div>
							<div class="mb-3 col-md-2">
								<label class="form-label">FACILITY PHONE</label>
								<input name="fc_phone" id="phone" type="text" class="form-control" placeholder="07XXXXXXXX">
							</div>
							<div class="mb-3 col-md-12">
								<label class="form-label">SERVICES WE OFFER</label>
								<textarea name="fc_desc" placeholder="We offer Optical, Dentist, etc" rows="4" id="" class="form-control"></textarea>
							</div>
							
						</div>
						<hr>
						<div class="row">
							<h3>Doctor's information</h3>
							<br>
							<br>
							<div class="mb-3 col-md-4">
								<label class="form-label">PRIMARY DOCTOR</label>
								<input name="name" id="name" type="text" class="form-control" placeholder="John Doe">
							</div>
							<div class="mb-3 col-md-4">
								<label class="form-label">EMAIL ADDRESS</label>
								<input name="email" type="email" class="form-control" placeholder="johndoe@mail.com">
							</div>
							<div class="form-outline" data-mdb-inline="true" data-mdb-datepicker-init="" data-mdb-input-init="" style="width: 22rem;" data-mdb-input-initialized="true" data-mdb-datepicker-initialized="true">
									<input type="text" class="form-control form-icon-trailing" id="exampleDatepicker2">
									<label for="exampleDatepicker2" class="form-label" style="margin-left: 0px;">Select a date</label>
								<div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 81.6px;"></div><div class="form-notch-trailing"></div></div>
								<button id="datepicker-toggle-632196" type="button" class="datepicker-toggle-button" data-mdb-toggle="datepicker">
								<i class="far fa-calendar datepicker-toggle-icon"></i>
								</button>
							</div>
							<div class="mb-3 col-md-4">
								<label class="form-label">DATE OF BIRTH</label>
								<input name="age" type="date" class="form-control" placeholder="D/M/Y">
							</div>
							<div class="mb-3 col-md-4">
								<label class="form-label">GENDER</label>
								<select name="gender" class="form-control" id="">
									<option disabled selected value="">---</option>
									<option value="male">Male</option>
									<option value="female">Female</option>
								</select>
							</div>
							<div class="mb-3 col-md-4">
								<label class="form-label">PHONE NUMBER</label>
								<input name="phone" type="text" class="form-control" placeholder="07XXXXXXXX">
							</div>
							<div class="mb-3 col-md-4">
								<label class="form-label">SPECIALITY</label>
								<input name="dc_speciality" type="text" class="form-control" placeholder="Optician, Dentist, Phlebotomist">
							</div>
							
						</div>
						<button type="submit" class="btn btn-primary btn-register-doctor">REGISTER FACILITY</button>
					</form>
				</div>
			</div>
		</div>
	</div>
		<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.umd.min.js"
></script>
	<!-- row -->
@endsection
