<?php
$file = App\Models\File::all();
?>

@extends('layouts')

@section('content')
@section('page-title', 'All Tasks')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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


    
    <div class="row">

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