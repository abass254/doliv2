@foreach ($files as $file)
    @php
        $extension = pathinfo($file->file_name, PATHINFO_EXTENSION);
        $fileUrl = route('file.show', ['fileName' => $file->file_name]);
    @endphp

    <div class="file-container">
        @if ($extension == 'pdf')
            <iframe src="{{ $fileUrl }}" width="100%" height="500px"></iframe>
        
        @elseif ($extension == 'docx')
            <iframe src="{{ $fileUrl }}" width="100%" height="500px"></iframe>
        
        @elseif ($extension == 'xlsx')
            <iframe src="{{ $fileUrl }}" width="100%" height="500px"></iframe>
        
        @elseif (in_array($extension, ['jpeg', 'jpg', 'png']))
            <img src="{{ $fileUrl }}" width="100%" alt="Image">
        
        @else
            <p>Unsupported file type</p>
        @endif
    </div>
@endforeach
