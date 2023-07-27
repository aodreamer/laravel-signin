@extends('auth.dashboard')

@section('content')
<div class="container">
    <h2>Edit File</h2>
    <form method="POST" action="{{ route('update.file', ['file' => $file->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="filename" class="form-label">File Name</label>
            <input type="text" name="filename" class="form-control" value="{{ $file->filename }}">
        </div>
        <div class="mb-3">
            <label for="pdf_file" class="form-label">Upload PDF File</label>
            <input type="file" name="pdf_file" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
