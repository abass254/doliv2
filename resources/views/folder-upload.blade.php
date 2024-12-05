<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Folder</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Upload Folder (as ZIP)</h2>
    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif
    <form action="{{ route('folder.process') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="folder" class="form-label">Select ZIP File</label>
            <input type="file" class="form-control" id="zip" name="folders" accept=".zip" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    
</div>
</body>
</html>
