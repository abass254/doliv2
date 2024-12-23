@extends('layouts')

@section('page-title', 'View File')

@php

$fileP = asset('storage/uploads/'.$fileName);

@endphp
@section('content')
<style>
    #docx-container {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        border: 1px solid #ddd;
        padding: 10px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    }
    .scrollable-content {
        max-height: 1000px; /* Adjust the height as needed */
        overflow-y: auto; /* Enables vertical scrolling */
        border: 1px solid #ddd; /* Optional: Adds a border for better visibility */
        padding: 10px; /* Optional: Adds padding inside the container */
        border-radius: 5px 5px;
        background-color: #f9f9f9; /* Optional: Adds a background color */
    }
    .row {
        height: auto; /* Or a defined height for proper layout */
    }
    .type_msg {
        padding-top: 10px;
    }
    .type_msg .form-control {
        padding: 10px 0;
        height: 50px;
        border: 0;
    }
    .type_msg .btn {
        font-size: 18px;
        border-radius: 38px !important;
        width: 38px;
        height: 38px;
        padding: 0;
        margin-top: 6px;
    }
    .chat-list-header {
    justify-content: space-between;
    background: #fff; }
    [data-theme-version="dark"]

    .chat-list-header {
      background: #18042b; }
    .chat-list-header a {
      text-align: center;
      width: 30px;
      height: 30px;
      background: #e5e5e5;
      border-radius: 6px;
      line-height: 30px;
      display: block; }
      [data-theme-version="dark"]
      .chat-list-header a {
        background: rgba(118, 0, 159, 0.2); }
        [data-theme-version="dark"]
        .chat-list-header a svg g [fill] {
          fill: #fff; }







</style>
<div class="container-fluid">
    <div class="page-titles d-flex justify-content-between align-items-center">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item text-uppercase">
                <strong class="text-primary"></strong>
                <p>{{ $fileName }}</p>
            </li>
        </ol>
    </div>

    <span class="d-flex">
        <div class="col-lg-8 scrollable-content">
            <div class="card-body overflow-hidden p-3">
            <iframe src="{{ $fileP }}" frameborder="0" style="width:100%;height:600px;"></iframe>
            </div>
        </div>
        <div class="col-lg-4 ">
            <div class="card scrollable-content">
                <div class="card-header chat-list-header text-center">
                    <h3 class="mb-1 mx-auto text-primary">Comments Section</h3>
                </div>
                <div class="card-body">
                    <div class="widget-timeline-icon widget-timeline-icon-sm">
                        <ul id="comments-list" class="timeline  dz-scroll height700">

                                <!-- Comments will be dynamically loaded here -->
                        </ul>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="input-group type_msg">
                        <input hidden type="text" id="folder-input" name="folder" value="{{ $document->id ?? '0' }}">
                        <textarea id="comment-input" class="form-control" placeholder="Type your message..."></textarea>
                        <div class="input-group-append">
                            <button type="button" id="submit-comment" class="btn btn-primary"><i class="fa fa-location-arrow"></i></button>
                        </div>
                    </div>
                    <!-- <div class="input-group   input-danger">
                        <span class="input-group-text">With textarea</span>
                        <textarea class="form-control"></textarea>
                    </div> -->
                </div>
            </div>
        </div>

    </span>


</div>

<!-- Include jQuery from a CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/docx-preview/dist/docx-preview.min.js"></script> -->

<!-- <script src="https://unpkg.com/jszip/dist/jszip.min.js"></script> -->
<!-- <script src="docx-preview.min.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/docx@8.1.0/build/index.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.min.js"></script>

<script>

        // const filePath = ""; // Path to the file
        // const fileExtension = "";

        // if (fileExtension === 'docx') {
        //     // Fetch and render the .docx file
        //     fetch(filePath)
        //         .then(response => response.arrayBuffer())  // Fetch as ArrayBuffer
        //         .then(arrayBuffer => {
        //             const container = document.getElementById('docx-container');

        //             // Convert the .docx file to HTML using Mammoth.js
        //             mammoth.convertToHtml({ arrayBuffer: arrayBuffer })
        //                 .then(result => {
        //                     container.innerHTML = result.value;
        //                 })
        //                 .catch(error => {
        //                     console.error('Error parsing the document:', error);
        //                     container.innerHTML = '<p>Unable to load the document. Please try again later.</p>';
        //                 });
        //         })
        //         .catch(error => {
        //             console.error('Error fetching the document:', error);
        //             const container = document.getElementById('docx-container');
        //             container.innerHTML = '<p>Unable to load the document. Please check the file URL.</p>';
        //         });
        // }
        // else if (fileExtension === 'pdf') {
        //     // Fetch and render the .pdf file using PDF.js
        //     const container = document.getElementById('pdf-container');

        //     pdfjsLib.getDocument(filePath).promise.then(function (pdfDoc_) {
        //         const pdfDoc = pdfDoc_;
        //         const pageNum = 1; // Display the first page

        //         // Prepare the container for rendering
        //         const scale = 1.5;
        //         const viewport = pdfDoc.getPage(pageNum).getViewport({ scale: scale });

        //         // Create a canvas element to render the page
        //         const canvas = document.createElement('canvas');
        //         const context = canvas.getContext('2d');
        //         canvas.height = viewport.height;
        //         canvas.width = viewport.width;

        //         container.appendChild(canvas);

        //         // Render the page
        //         pdfDoc.getPage(pageNum).then(function (page) {
        //             page.render({
        //                 canvasContext: context,
        //                 viewport: viewport
        //             });
        //         });
        //     }).catch(function (error) {
        //         console.error('Error loading PDF document:', error);
        //         container.innerHTML = '<p>Unable to load the document. Please try again later.</p>';
        //     });
        // }

    // const docxPath = "";
    //     console.log(docxPath);

    //     // Fetch and parse the .docx file
    //     fetch(docxPath)
    //     .then(response => response.arrayBuffer())  // Fetch as ArrayBuffer
    //     .then(arrayBuffer => {
    //         const container = document.getElementById('docx-container');

    //         // Convert the .docx file to HTML using Mammoth.js
    //         mammoth.convertToHtml({ arrayBuffer: arrayBuffer })
    //             .then(result => {
    //                 // Insert the HTML content into the container
    //                 container.innerHTML = result.value;
    //             })
    //             .catch(error => {
    //                 console.error('Error parsing the document:', error);
    //                 container.innerHTML = '<p>Unable to load the document. Please try again later.</p>';
    //             });
    //     })
    //     .catch(error => {
    //         console.error('Error fetching the document:', error);
    //         const container = document.getElementById('docx-container');
    //         container.innerHTML = '<p>Unable to load the document. Please check the file URL.</p>';
    //     });




    function loadComments() {
    const file_id = $('#folder-input').val();
    $.ajax({
        url: `/file_comments/${file_id}`,
        method: 'GET',
        success: function (data) {
            let commentsHTML = '';
            if (data.length === 0) {
                commentsHTML = '<li><p class="text-danger fs-15 mb-0">No comments made</p></li>';
            }
            data.forEach(comment => {
                commentsHTML += `
                    <li>
                        <div class="icon bg-primary fa fa-comment"></div>
                        <a class="timeline-panel text-muted" href="">
                            <h6 class="mb-2 text-primary mt-1">${comment.comment}</h6>
                            <p class="fs-15 mb-0 ">at ${comment.time} by ${comment.creator_name}</p>
                        </a>
                    </li>
                `;
            });
            $('#comments-list').html(commentsHTML);
        },
        error: function () {
            alert('Failed to load comments.');
        }
    });
}

    // Call the function to load comments on page load
    $(document).ready(function () {
        loadComments();

     //   setInterval(loadComments, 1000);

        $('#submit-comment').on('click', function () {
            const comment = $('#comment-input').val();
            const folder = $('#folder-input').val();
            const status = "1";

            if (comment.trim() === '') {
                alert('Comment cannot be empty.');
                return;
            }

            $.ajax({
                url: '/file_comments',
                method: 'POST',
                data: {
                    comment: comment,
                    folder: folder,
                    status: status,
                    _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function (response) {
                    $('#comment-input').val(''); // Clear the textarea
                    loadComments(); // Reload comments
                    //alert('Comment saved.');
                },
                error: function () {
                    alert('Failed to submit the comment.');
                }
            });
        });



    });

</script>

@endsection
