@extends('layouts')

@section('content')
@section('page-title', 'Edit User')
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
					<form method="POST" action="{{ route('system_users.update', $data->id) }}">
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
								<label class="form-label">FULL NAME</label>
								<input value="{{ $data->name }}" name="name" id="name" type="text" class="form-control text-primary" placeholder="">
							</div>
							<div class="col-md-3">
								<label class="form-label">EMAIL ADDRESS</label>
								<input value="{{ $data->email }}" name="email" id="email" type="email" class="form-control text-primary" placeholder="">
							</div>
							<div class="col-md-3">
								<label class="form-label">PHONE NUMBER</label>
								<input value="{{ $data->phone }}" name="phone" id="phone" type="phone" class="form-control text-primary" placeholder="">
							</div>
							
                            <div class="col-md-3">
								<label class="form-label">ROLE</label>
								<select class="form-control required" id="role" name="role" >
                                    <option value="{{ $data->role }}">{{ $data->role }}</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Clerk">Clerk</option>
                                    <option value="System Administrator">System Administrator</option>
                                    <option value="Accountant">Accountant</option>
                                    <option value="Paralegal">Paralegal</option>
                                </select>
							</div>
						</div>
						<hr>
						
						<button type="submit" class="btn btn-primary btn-register-doctor">SAVE DATA</button>
					</form>
				</div>
			</div>
		</div>
	</div>


@endsection