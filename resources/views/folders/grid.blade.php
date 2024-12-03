@extends('layouts')



<?php

// $data = $_SERVER['REQUEST_URI'];
// 

$requestUri = $_SERVER['REQUEST_URI'];
$value = 0;
if (preg_match('/\/sub_folders\/(\d+)/', $requestUri, $matches)) {
    $value = $matches[1];
}

$file = \App\Models\File::where('id', $id)->first();

?>
    



@section('content')
@section('page-title', 'File Documents')

<style>
    .fixed-size {
    width: 100px; /* Set your desired width */
    height: 100px; /* Set your desired height */
    object-fit: contain; /* Ensures the entire image is visible */
    background-color: #f8f9fa; /* Optional: Adds a background to fill empty space */
    border-radius: 5px; /* Matches the 'rounded' class effect */
}


</style>
<div class="container-fluid">
	<div class="page-titles">
		<ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url('/files_station') }}">
                <b class="text-primary">Files Station </b>
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ url('/file_stations/'.$id.'/main') }}">
                <b class="text-primary">{{ $file->file_no }} </b>
            </a>
        </li>
        @foreach ($breadcrumbs as $key => $breadcrumb)
        
        @if ($key == count($breadcrumbs) - 1)
                <!-- Last item in the breadcrumb (current folder) -->
                <li class="breadcrumb-item active">
                    {{ $breadcrumb->folder_name }}
                </li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{ route('file_stations.show', ['id' => $id, 'sub_id' => $breadcrumb->id]) }}">
                        {{ $breadcrumb->folder_name }}
                    </a>
                </li>
            @endif>
            <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li> -->
        @endforeach
            
			<!-- <li class="breadcrumb-item"><a href="/">Home Page</a></li> -->
		</ol>
	</div>
    <div class="row">
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>

    @elseif(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    @php
        $url = url()->current();  // Get the current full URL
        $segments = explode('/', $url);  // Split the URL into segments
        $lastSegment = end($segments) == "main" ? '0' : end($segments);
        @endphp
    
    @csrf
        <div class="col-md-3">
            <form method="POST" action="{{ url('/folders') }}">
                @csrf
                <input hidden required type="text" id="file_no" name="file" value="{{ $id }}">
                <input hidden type="text" id="text" name="folder_type" value="1">
                <input hidden type="text" id="" name="primary_folder" value="{{ $lastSegment }}">
                <div class="input-group">
                    <input type="text" rounded id="folder_name" name="folder_name" class="form-control form-control-sm" placeholder="Create New Folder" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-success btn-sm" type="submit">CREATE</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-7">
            <form method="POST" action="{{ route('upload-files') }}" enctype="multipart/form-data">
                @csrf
                <input hidden required type="text" id="file" name="file" value="{{ $id}}">
                <input hidden required type="text" id="folder_status" name="folder_status" value="1">
                <input hidden required type="text" id="primary_folder" name="primary_folder" value="{{ $lastSegment }}">
                <div class="input-group">
                    <input multiple type="file" id="folder_name" name="folder_name[]" class="form-control form-control-sm" placeholder="Create New Folder" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" id="" type="submit">UPLOAD</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-2">
            <a href="/documents/create" class="btn btn-info btn-sm"><i class="fa fa-pen"></i>   WRITE DOCUMENT</a>
        </div>

    </div><br><br>
        
    <div class="row">
        <!-- <span id="refreshedData"> -->
            @if(count($data) < 1)
            
            <p>No Folders Found</p>
            
            @else
            @foreach($data as $item)
            <div class="col-md-2" id="">
                <div class="card">
                    <div class="card-body product-grid-card">
                        <div class="new-arrival-product">
                            <div class="new-arrivals-img-contnent">
                            <img class="img-fluid rounded fixed-size" src="{{ asset('images/product/' . ($item->folder_type == '1' ? 'folder.jpg' : 'pdf.png')) }}" alt="">
                            </div>
                            <div class="new-arrival-content text-center mt-3">
                                <h4 class="text-capitalize">{{$item->folder_name}}</h4>
                                <span class="price">
                                    <a href="{{ $item->folder_type == '1' ? '/files_station/'.$id. '/folder/' .$item->id : '/uploaded_file/' . $item->id }}" 
                                    class="btn btn-sm btn-{{ $item->folder_type == '1' ? 'primary' : 'danger' }}">{{ $item->folder_type == '1' ? 'OPEN' : 'VIEW' }}</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                @endforeach
                @endif
            <!-- </span> -->
        </div>
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

document.addEventListener("DOMContentLoaded", () => {
    // const container = document.getElementById("folders-id");

    // const fetchFolders = async (folderId) => {
    //     try {
    //         const response = await fetch(`/file_documents_data/${folderId}`);
    //         const items = await response.json();

    //         const source = `{{ asset('images/product/folder.jpg')}}`

    //         console.log(items);

    //         // Clear the container before adding new content
    //         container.innerHTML = "";

    //         // Create cards for each item
    //         items.forEach(item => {
    //             const card = `
    //                 <div class="card">
    //                     <div class="card-body product-grid-card">
    //                         <div class="new-arrival-product">
    //                             <div class="new-arrivals-img-contnent">
    //                                 <img class="img-fluid rounded" src="${source}" alt="">
    //                             </div>
    //                             <div class="new-arrival-content text-center mt-3">
    //                                 <h4>${item.file_name}</h4>
    //                                 <p style="text-align: left; font-weight: 12px;">Total Documents: ${item.total_documents || 0}</p>
    //                                 <p style="text-align: left; font-weight: 12px;">Total Files: ${item.total_files || 0}</p>
    //                                 <span class="price"> <a href="#" class="btn btn-sm btn-primary">OPEN</a> </span>
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </div>
    //             `;
    //             container.innerHTML += card;
    //         });
    //     } catch (error) {
    //         console.error("Error fetching items:", error);
    //     }
    // };

    // // Replace `1` with the folder ID you want to fetch
    // const folderId = 2; 
    // fetchFolders(folderId);

    // // Optionally, refresh the items periodically (e.g., every 10 seconds)
    // setInterval(() => fetchFolders(folderId), 10000);
});

    $('#saveFolder').click(function () {
        const folder_name = $('#folder_name').val();
        const file = $('#file').val();
        const folder_status = $('#folder_status').val();
        const primary_folder = $('#primary_folder').val();

        if ($.trim(folder_name) === '') {
            alert('Folder name cannot be empty!');
            return;
        }

        $.ajax({
            url: '/folders',
            method: 'POST',
            data: {
                folder_name: folder_name,
                file: file,
                folder_status: folder_status,
                primary_folder: primary_folder,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                // Clear the input field
                location.reload();
              //  $('#folderName').val('');

                // Update the refreshedData section
              //  $('#refreshedData').html(response.html);
            },
            error: function (error) {
                console.error('Error saving folder:', error);
                alert('An error occurred while saving the folder. Please try again.'+error);
            }
        });
    });
</script>
@endsection