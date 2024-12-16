<?php
$file = App\Models\File::all();
?>

@extends('layouts')

@section('content')
@section('page-title', 'All Tasks')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" /> -->

<style>
    .separator {
  display: flex;
  align-items: center;
  text-align: center;
}

.separator::before,
.separator::after {
  content: '';
  flex: 1;
  border-bottom: 1px solid #000;
}

.separator:not(:empty)::before {
  margin-right: .25em;
}

.separator:not(:empty)::after {
  margin-left: .25em;
}

.timeline-panel {
    padding: 10px; /* Reduce padding */
    display: flex; /* Flexbox for alignment */
    align-items: center; /* Vertical centering */
    justify-content: center; /* Horizontal centering */
}

.timeline-panel h4 {
    margin: 0; /* Remove default margins for h4 */
    text-align: left; /* Center the text */
}

</style>

<div class="container-fluid">
	<div class="page-titles">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('file_structure', ['path' => '/']) }}">FILE_SERVER</a></li>
            @php
                $segments = explode('/', trim($path, '/'));
                $currentPath = '';
            @endphp
            @foreach ($segments as $segment)
                @php
                    $currentPath .= '/' . $segment;
                @endphp
                <span>/</span>
                <li class="breadcrumb-item"><a href="{{ route('file_structure', ['path' => $currentPath ]) }}">{{ $segment }}</a></li>
            @endforeach
		</ol>
        
	</div>

    @if (request('search'))
        <h2>Search Results for "{{ request('search') }}"</h2>
        @if (count($folders) === 0 && count($files) === 0)
            <p class="no-results">No results found in the current directory or subdirectories.</p>
        @endif
    @endif


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" style="height: auto;">
                    <form method="GET" class="d-flex" action="{{ route('file_structure') }}">
                        <input type="text" class="form-control form-control-sm" name="search" placeholder="Search files or folders..." value="{{ request('search') }}">
                        <button class="btn btn-sm btn-primary" type="submit">Search</button>
                        <input type="hidden" name="path" value="{{ $path }}">
                    </form>
                </div>
            </div>
            
        </div>
        <div class="separator mt-3 mb-3">Folders</div>
        <span class="dz-scroll height500">
            @if (count($folders) > 0)
            @foreach ($folders as $folder)
                <div class="col-md-12">
                <div class="timeline-panel bg-white p-2 mb-4 d-flex align-items-center" style="height: auto;">
                    <div class="media-body text-center w-100">
                        <h4 class="mb-0"><span class="icon m-2">📁</span><a href="{{ route('file_structure', ['path' => $path . '/' . basename($folder)]) }}">{{ basename($folder) }}</a></h4>
                    </div>
                </div>
                </div>
                @endforeach
            @else
            <p class="no-results">No folders found.</p>
            @endif
        </span>


        <div class="separator mt-3 mb-3">Files</div>
        <span class="dz-scroll height500">
            @if (count($files) > 0)
                @foreach ($files as $folder)
                <div class="col-md-12">
                <div class="timeline-panel bg-white p-2 mb-4 d-flex align-items-center" style="height: auto;">
                        <div class="media-body text-center w-100">
                            <h4 class="mb-2"><span class="icon m-2">📄</span><a href="{{ url('/storage/' . ltrim($path, '/') . '/' . basename($file)) }}">{{ basename($folder) }}</a></h4>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            <p class="no-results">No files found.</p>
            @endif
        </span>
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

	


@endsection