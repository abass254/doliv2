@extends('layouts')

@section('page-title', 'Edit Document')

@section('content')
<style>
    .ck-editor__editable {
        min-height: 800px;
    }
</style>
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Return Back</a></li>
        </ol>
    </div>

    <div class="col-lg-12">
        <div class="card overflow-hidden">
            <form method="POST" action="{{ route('documents.update', $document->id) }}">
                <div class="m-3">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>

                    @elseif(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </div>
                @method('PUT')
                @csrf		
                <input hidden value="1" name="file_no" type="text">	
                <input hidden value="{{ Auth::user()->id }}" name="creater" type="text">	
                
                <div class="m-3">
                    <input type="text" value="{{ $document->title }}" name="title" class="form-control" placeholder="Title">
                </div>
                <div class="m-3 dz-scroll height360"  style="height:900px">
                    <textarea class="large-textarea" placeholder="Content" id="editor" name="content" rows="10" cols="50">{!! $document->content !!}</textarea>
                </div>
                <div class="m-3">
                    <button class="btn btn-primary" submit="submit">SAVE DATA</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>

@endsection
