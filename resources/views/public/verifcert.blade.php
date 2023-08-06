@extends('auth.dashboard')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Verifikasi sertifikat anda</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('verify.cert') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex-container">
                        <div class="drop-zone" id="dropZone">
                            <span class="drop-zone__prompt">
                                <div class="image-container">
                                    <img src="https://play-lh.googleusercontent.com/BkRfMfIRPR9hUnmIYGDgHHKjow-g18-ouP6B2ko__VnyUHSi1spcc78UtZ4sVUtBH4g" alt="Image" style="width: 150px;">
                                </div>
                                Unggah dokumen pdf
                            </span>
                            <input type="file" class="drop-zone__input" id="pdf_file" name="pdf_file">
                        </div>
                    </div>
                    <button type="submit">Upload</button>
                </form>
                <div class="progress" style="width: 100%; height: 10px; margin-top: 10px; background-color: #f1f1f1; border-radius: 5px; overflow: hidden; display: none;">
                    <div class="progress-bar" role="progressbar" style="height: 100%; background-color: #007bff; width: 0; transition: width 0.3s ease;"></div>
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

    .progress {
        width: 100%;
        height: 10px;
        margin-top: 10px;
        background-color: #f1f1f1;
        border-radius: 5px;
        overflow: hidden;
        display: block;
    }

    .progress-bar {
        height: 100%;
        background-color: #007bff;
        width: 0;
        transition: width 0.3s ease;
    }
</style>

<script>
    // Add your JavaScript code here
    const dropZone = document.querySelector('.drop-zone');
    const input = document.getElementById('pdf_file');
    const progressBar = document.querySelector('.progress-bar');
    const progressContainer = document.querySelector('.progress'); // Added this line

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

    input.addEventListener('change', () => {
        const file = input.files[0];
        if (file) {
            uploadFile(file);
        }
    });

    function uploadFile(file) {
        const formData = new FormData();
        formData.append('pdf_file', file);

        const xhr = new XMLHttpRequest();

        xhr.upload.addEventListener('progress', (e) => {
            const percent = (e.loaded / e.total) * 100;
            progressBar.style.width = `${percent}%`;
            progressBar.setAttribute('aria-valuenow', percent);
        });

        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                // Handle response from the server after upload is complete
            }
        };

        xhr.open('POST', '{{ route("verify.cert") }}');
        xhr.send(formData);

        // Show the progress bar
        progressContainer.style.display = 'block';
    }
</script>
@endsection