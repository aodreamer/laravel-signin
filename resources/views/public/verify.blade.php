@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Upload PDF</h2>
            </div>
            <div class="card-body">
                @if(session()->has('message'))
                    <div class="alert alert-info">
                        {{ session('message') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('verify.upload.pdf') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="pdf_file">Select PDF File</label>
                        <input type="file" class="form-control" id="pdf_file" name="pdf_file">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Check</button>
                </form>
            </div>
        </div>
    </div>
@endsection
