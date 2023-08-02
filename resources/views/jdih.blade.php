@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="white-text">Daftar File</h2>
        <div class="row">
            @foreach ($files as $file)
                <div class="col-md-4">
                    <div class="card mb-4 clickable-card" onclick="window.location='{{ route('jdih.download', $file->id) }}'">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div style="height: 100px;">
                                <a href="{{ route('jdih.download', $file->id) }}" class="card-title no-underline font-weight-bold" style="margin-bottom: 8px;">{{ $file->filename }}</a>
                            </div>
                            <hr style="border-top: 1px solid #ccc; margin: 5px 0;">
                            <p class="card-text mt-auto">Pengunggah: {{ $file->author->name }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<style>
    /* Add your CSS styles here */
    .clickable-card {
        height: 200px !important; /* Set the fixed height to 400px */
        overflow: hidden; /* Hide any content that exceeds the fixed height */
        cursor: pointer; /* Change the cursor to a pointer when hovering over the card to indicate it's clickable */
        border-radius: 20px; /* Increase the border-radius to make the card more rounded */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.10); /* Increase the shadow intensity to make it more noticeable */
        transition: all 0.3s ease-in-out; /* Add a smooth transition effect on hover */
    }

    /* Apply the shadow and transform the card slightly on hover */
    .clickable-card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Increase the shadow intensity on hover */
        transform: scale(1.05); /* Slightly scale up the card on hover */
    }

    /* Remove underline from the card title link */
    .no-underline {
        text-decoration: none;
    }

    /* Add bold font-weight to the card title */
    .font-weight-bold {
        font-weight: bold;

    }
    body {
        margin:0;
        padding:0;
        font-family: sans-serif;
        background: linear-gradient(#333, #333);
    }
    .white-text {
  color: white;
  font-size: 24px; /* Optional: You can adjust the font size as per your requirement */
}

</style>
