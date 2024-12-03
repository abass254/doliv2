@extends('layouts')

@section('page-title', 'View Document')

@section('content')
<style>
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
                <strong class="text-primary">{{ $document->title }}</strong>
            </li>
        </ol>
        <a {{ $document->creater == Auth::user()->id ? '' : 'hidden' }} class="btn btn-danger btn-sm" href="{{ route('documents.edit', $document->id) }}">CONTINUE EDITING</a>
    </div>
        
    <span class="d-flex">
        <div class="col-lg-8 scrollable-content">
            <div class="card-body overflow-hidden p-3">
                {!! $document->content !!}
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
                        <input hidden type="text" id="doc-input" name="doc" value="{{ $document->id }}">
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


<script>

function loadComments() {
    const file_id = $('#doc-input').val();
    $.ajax({    
        

        url: `/doc_comments/${file_id}`,
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

    setInterval(loadComments, 1000);

    $('#submit-comment').on('click', function () {
        const comment = $('#comment-input').val();
        const doc = $('#doc-input').val();
        const status = "1";

        if (comment.trim() === '') {
            alert('Comment cannot be empty.');
            return;
        }

        $.ajax({
            url: '/doc_comments',
            method: 'POST',
            data: {
                comment: comment,
                doc: doc, 
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
