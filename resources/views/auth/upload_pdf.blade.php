@extends('auth.dashboard')
@section('content')
@if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-info">
            {{ session('success') }}
        </div>
    @endif
<div class="container mt-4">
    <h2>Upload File PDF</h2>
    <form action="{{ route('upload.pdf') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file_name">Nama File:</label>
            <input type="text" class="form-control" id="file_name" name="file_name" required>
        </div>
        <div class="form-group">
            <label for="labels">Labels:</label>
            <select class="form-control" id="labels" name="labels[]" multiple required>
                @foreach ($labels as $label)
                    <option value="{{ $label->id }}">{{ $label->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="pdf_file">Upload File PDF:</label>
            <input type="file" class="form-control-file" id="pdf_file" name="pdf_file" accept=".pdf" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
