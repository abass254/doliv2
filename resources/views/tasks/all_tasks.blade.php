<?php
$file = App\Models\File::all();
?>

@extends('layouts')

@section('content')
@section('page-title', 'All Tasks')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" /> -->



<div class="container-fluid">
	<div class="page-titles">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/">Home Page</a></li>
		</ol>
	</div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>All Tasks</h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="clearfix">
                <div class="card card-bx profile-card author-profile mb-3 ">
                <div class="row  dz-scroll height600">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="card-body py-0 px-3">
                                <div class="table-responsive">
                                    <table class="table display table-sm mb-0 ">
                                        <thead>
                                            <tr class="text-uppercase">
                                                <!-- <th style="width:2px;" class="align-middle">
                                                    <div class="form-check custom-checkbox">
                                                        <input type="checkbox" class="form-check-input" id="checkAll">
                                                        <label class="form-check-label d-block" for="checkAll"></label>
                                                    </div>
                                                </th> -->
                                                <th>#</th>
                                                <th class="align-middle">DATE</th>
                                                <th class="align-middle">TASK OWNER</th>
                                                <th class="align-middle">ACTIVITY</th>
                                                <th class="align-middle">TIME</th>
                                                <th class="align-middle">RATE</th>
                                                <th class="align-middle text-end">STATUS</th>
                                                <!-- <th class="align-middle text-end">ACTION</th> -->
                                            </tr>
                                        </thead>
                                        <tbody id="orders">
                                            @foreach($data as $key => $dt)
                                            <tr class="btn-reveal-trigger">
                                                <!-- <td style="width:2px;" class="py-2">
                                                    <div class="form-check custom-checkbox checkbox-success">
                                                        <input type="checkbox" class="form-check-input" id="checkbox">
                                                        <label class="form-check-label" for="checkbox"></label>
                                                    </div>
                                                </td> -->
                                                <td style=";"><strong  class="text-primary">{{ $key+1 }}</strong></td>
                                                <td class="py-2" style="width:120px;">{{ date_format (new DateTime($dt->ts_date), 'd/m/Y') ?? 'N/A' }}</td>
                                                <td class="py-2">{{ $dt->owner ?? 'N/A' }}</td>
                                                <td class="py-2 text-left" style="width:500px; text-align:left;">
                                                    {{ $dt->ts_activity ?? 'N/A' }}
                                                </td> 
                                                <td class="" style="width:100px">{{ $dt->ts_time ?? 'N/A' }}</td>
                                                <td class="py-2" style="">{{ $dt->ts_rate ?? 'N/A' }}</td>
                                                <td class="py-2 text-end"><span class="badge badge-{{$dt->theme}} text-uppercase badge-sm"><span class="ms-1 fa fa-dot">{{ $dt->status ?? 'N/A' }}</span></span>
                                                </td>
                                                <!-- <td class="py-2 text-end">
                                                    <a href="" class="btn btn-primary btn-sm"><b>RETRIEVE</b></a>
                                                </td> -->
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
            </div>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- <script>
        $(document).ready(function() {
            
        });
    </script> -->

    <script>
        var firstOpen = true;
        var time;
        
        
        // $('.searchable-dropdown').select2({
        //     placeholder: "Select or search FILE NO",
        //     allowClear: true,
        //     width: '100%',
        //     dropdownParent: $('#file_no')
        // });

        // // Add 'form-control' class to the generated Select2 element
        // $('.searchable-dropdown').next('.select2').find('.select2-selection').addClass('form-control');


        
        $('#startTime').datetimepicker({
            useCurrent: false,
            format: "hh:mm A"
        }).on('dp.show', function() {
            if(firstOpen) {
                time = moment().startOf('day');
                firstOpen = false;
            } else {
                time = "01:00 PM"
            }        
            $(this).data('DateTimePicker').date(time);
        });

        $('#endTime').datetimepicker({
            useCurrent: false,
            format: "hh:mm A"
        }).on('dp.show', function() {
            if(firstOpen) {
                time = moment().startOf('day');
                firstOpen = false;
            } else {
                time = "01:00 PM"
            }        
            $(this).data('DateTimePicker').date(time);
        });
    </script>

	


@endsection