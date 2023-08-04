@extends('auth.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Upload dokumen PDF anda</h2>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('upload.pdf') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex-container">
                        <div class="drop-zone" id="dropZone">
                            <span class="drop-zone__prompt">
                                <div class="image-container">
                                    <img src="https://i.ibb.co/FW7n6tn/pdf.png" alt="Image" style="width: 150px;">
                                </div>
                                Unggah dokumen pdf
                            </span>
                            <input type="file" class="drop-zone__input" id="pdf_file" name="pdf_file">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Upload</button>
                </form>
                <div class="progress mt-3">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <style>
         body {
        background-color: #333;
    }
        /* Add your CSS styles here */
        .flex-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap; /* Allow containers to wrap to the next line if necessary */
        }

        .image-container {
            margin-right: 20px; /* Add spacing between the containers */
        }

        .drop-zone {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100px; /* Adjust the height as desired */
            width: 100%; /* Set the width to 100% to fill the container */
            border: 2px dashed #ccc;
            border-radius: 5px;
            padding: 20px;
            box-sizing: border-box;
            cursor: pointer;
        }

        .drop-zone__prompt {
            font-size: 24px;
            color: #aaa;
            text-align: center; /* Center the text horizontally */
            margin-bottom: 20px; /* Add some bottom margin to separate the text and the input */
            display: flex; /* Add flex to align the logo and text horizontally */
            align-items: center; /* Center the items horizontally */
        }

        .drop-zone__prompt img {
            vertical-align: middle; /* Adjust the alignment of the logo with text */
        }

        .drop-zone__input {
            display: none;
        }
    </style>

<script>
    // Add your JavaScript code here
    const dropZone = document.querySelector('.drop-zone');
    const input = document.getElementById('pdf_file');
    const progressBar = document.querySelector('.progress-bar');

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
        input.files = e.dataTransfer.files; // Assign the dropped file to the input
    });

    // Handle file upload using XMLHttpRequest
    input.addEventListener('change', () => {
        const file = input.files[0];
        if (file) {
            const formData = new FormData();
            formData.append('pdf_file', file);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('upload.pdf') }}', true);

            xhr.upload.onprogress = function(event) {
                const progress = (event.loaded / event.total) * 100;
                progressBar.style.width = `${progress}%`;
                progressBar.setAttribute('aria-valuenow', progress);
            };

            xhr.onload = function() {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert('File uploaded successfully.');
                } else {
                    alert('File upload failed.');
                }
            };

            xhr.onerror = function() {
                alert('An error occurred during file upload.');
            };

            xhr.send(formData);
        }
    });
</script>


@endsection
