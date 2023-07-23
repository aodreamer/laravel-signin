@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Verifikasi dokumen PDF anda</h2>
        </div>
        <div class="card-body">

            <!-- Flex container to place both containers in the same row -->
            <div class="flex-container">
                <div class="image-container">
                    <img src="https://verifikasipdf.rootca.id/assets/img/maskot.png" alt="Image" style="width: 150px;">
                </div>
                <div class="drop-zone" style="width: 400px;"> <!-- Adjust the width as desired -->
                    <span class="drop-zone__prompt">
                        <a href="https://imgbb.com/"><img src="https://i.ibb.co/nMNbPNw/Upload-Icon-Logo-PNG-Photos.png" alt="Upload-Icon-Logo-PNG-Photos" style="height: 50px; margin-right: 10px;" border="0"></a>
                        Unggah dokumen pdf
                    </span>
                    <input type="file" class="drop-zone__input" id="pdf_file" name="pdf_file">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-2" id="checkBtn">Check</button>
        </div>
    </div>
</div>

<style>
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
    const checkBtn = document.getElementById('checkBtn');

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

    // Handle the form submission when the Check button is clicked
    checkBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const form = e.target.closest('form');
        form.submit();
    });
</script>
@endsection
