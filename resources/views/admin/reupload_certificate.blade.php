<!-- resources/views/upload_p12.blade.php -->
@extends('auth.dashboard')

@section('content')
    <div class="container mt-5">
        <h2>Upload P12 File</h2>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('reupload.certificate') }}" enctype="multipart/form-data">
            @csrf
            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $user->id }}" hidden>
            <div class="form-group">
                <label for="user_id">User</label>
                <input type="text" class="form-control" id="user_name" name="user_name" value="{{ $user->name }}" disabled>
            </div>
            <div class="form-group">
                <label for="p12_file">P12 File</label>
                <input type="file" class="form-control" id="p12_file" name="p12_file">
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" id="pass" name="pass">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
@endsection
