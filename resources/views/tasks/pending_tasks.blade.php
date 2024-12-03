<?php
$file = App\Models\File::all();
?>

@extends('layouts')

@section('content')
@section('page-title', 'Pending Tasks')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" /> -->



<div class="container-fluid">
<div class="page-titles d-flex justify-content-between align-items-center">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item text-uppercase">
                <strong class="text-primary">Pending Tasks</strong>
            </li>
        </ol>
       <button id="approve-selected" class="btn btn-success btn-sm" disabled data-bs-toggle="modal" data-bs-target="#confirmModal">
                        Approve Selected
                    </button>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="clearfix">
                <div class="card card-bx profile-card author-profile mb-3 ">
                <div class="row  dz-scroll height600">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="card-body py-0 px-3">
                                <div class="table-responsive">
                                    <table class="table table-sm mb-0">
                                        <thead>
                                            <tr class="text-uppercase">
                                                <th style="width:2px;" class="align-middle">
                                                    <div class="form-check custom-checkbox">
                                                        <input type="checkbox" class="form-check-input" id="checkAll">
                                                        <label class="form-check-label d-block" for="checkAll"></label>
                                                    </div>
                                                </th>
                                                <th>#</th>
                                                <th class="align-middle">DATE</th>
                                                <th class="align-middle">TASK OWNER</th>
                                                <th class="align-middle">ACTIVITY</th>
                                                <th class="align-middle">TIME</th>
                                                <th class="align-middle">RATE</th>
                                                <th class="align-middle text-end">STATUS</th>
                                                <th class="align-middle text-end">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody id="orders">
                                            @foreach($data as $key => $dt)
                                            <tr class="btn-reveal-trigger">
                                                <td style="width:2px;" class="py-2">
                                                    <div class="form-check custom-checkbox checkbox-success">
                                                        <input type="checkbox" class="form-check-input select-task" data-id="{{ $dt->id }}">
                                                    </div>
                                                </td>
                                                <td style=";"><strong  class="text-primary">{{ $key+1 }}</strong></td>
                                                <td class="py-2" style="width:120px;">{{ date_format (new DateTime($dt->ts_date), 'd/m/Y') ?? 'N/A' }}</td>
                                                <td class="py-2">{{ $dt->owner ?? "N/A" }}</td>
                                                <td class="py-2 text-left" style="width:500px; text-align:left;">
                                                    {{ $dt->ts_activity ?? 'N/A' }}
                                                </td> 
                                                <td class="" style="width:100px">{{ $dt->ts_time ?? 'N/A' }}</td>
                                                <td class="py-2" style="">{{ $dt->ts_rate ?? 'N/A' }}</td>
                                                <td class="py-2 text-end"><span class="badge badge-{{$dt->theme}} text-uppercase badge-sm"><span class="ms-1 fa fa-dot">{{ $dt->status ?? 'N/A' }}</span></span>
                                                </td>
                                                <td class="py-2 text-end">
                                                <form action="{{ route('tasks.approve.single', $dt->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="button" class="btn btn-success btn-xs approve-single" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                                        <b>APPROVE</b>
                                                    </button>
                                                </form>
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
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Approval</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to approve the selected task(s)?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="bulk-approve-form" method="POST" action="{{ route('tasks.approve.bulk') }}">
                        @csrf
                        <input type="hidden" name="task_ids" id="task-ids">
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </form>
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


        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.select-task');
            const bulkApproveBtn = document.getElementById('approve-selected');
            const taskIdsInput = document.getElementById('task-ids');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const selected = Array.from(checkboxes).filter(cb => cb.checked).map(cb => cb.dataset.id);
                    bulkApproveBtn.disabled = selected.length === 0;
                    taskIdsInput.value = JSON.stringify(selected);
                });
            });

            // Attach to single approval buttons
            document.querySelectorAll('.approve-single').forEach(button => {
                button.addEventListener('click', function () {
                    const form = button.closest('form');
                    const confirmModal = document.getElementById('confirmModal');

                    confirmModal.querySelector('.btn-primary').onclick = function () {
                        form.submit();
                    };
                });
            });
        });

    </script>

	


@endsection