@extends('auth.dashboard')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Upload P12 File</h2>
        </div>
        <div class="card-body">
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
            <form method="POST" action="{{ route('upload.p12') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="user_id">User</label>
                    <select class="form-control" id="user_id" name="user_id">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="p12_file">P12 File</label>
                    <div class="drop-zone" id="dropZone">
                        <span class="drop-zone__prompt">
                            <div class="image-container">
                                <img src="https://i.ibb.co/8NF8S13/signature.png" alt="signature" width="75" height="75">
                            </div>
                            Drag and drop your P12 file here or click to select.
                        </span>
                        <input type="file" class="drop-zone__input" id="p12_file" name="p12_file">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="pass">Password</label>
                    <input type="password" class="form-control" id="pass" name="pass">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Upload</button>
            </form>
        </div>
    </div>
</div>

<style>
    /* Add your CSS styles here */
    .drop-zone {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100px;
        width: 100%;
        border: 2px dashed #ccc;
        border-radius: 5px;
        padding: 20px;
        box-sizing: border-box;
        cursor: pointer;
    }

    .drop-zone__prompt {
        font-size: 18px;
        color: #aaa;
        text-align: center;
        margin-bottom: 20px;
    }

    .image-container {
        margin-right: 20px;
    }

    .drop-zone__prompt img {
        vertical-align: middle;
    }

    .drop-zone__input {
        display: none;
    }
</style>

<script>
    // Add your JavaScript code here
    const dropZone = document.getElementById('dropZone');
    const input = document.getElementById('p12_file');

    dropZone.addEventListener('click', () => {
        input.click();
    });

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('drop-zone--over');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('drop-zone--over');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('drop-zone--over');
        const file = e.dataTransfer.files[0];
        input.files = e.dataTransfer.files;
    });

    input.addEventListener('change', () => {
        const file = input.files[0];
        // Handle file selection or display the selected file name if needed
    });
</script>
@endsection
