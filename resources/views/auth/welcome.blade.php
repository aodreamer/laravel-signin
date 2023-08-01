@extends('auth.dashboard')

@section('content')
<style>
    /* Add some basic styling to the table */
    table {
        border-collapse: collapse;
        width: 100%;
    }

    /* Remove borders and add box-shadow */
    th,
    td {
        padding: 12px;
        text-align: center;
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    /* Add cursor pointer on hover for clickable effect */
    td a {
        display: block;
        text-decoration: none;
        color: inherit;
        cursor: pointer;
        /* Remove underline */
        text-decoration: none;
    }

    /* Add shadow on cell hover */
    td:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Style for the text inside the table cells */
    .cell-text {
        font-size: 18px;
        font-weight: bold;
        margin-top: 10px;
    }

    /* Center the content in the cells horizontally and vertically using flexbox */
    .cell-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    /* Add spacing between the cells */
    .cell-container {
        margin-bottom: 20px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Hello, {{ auth()->user()->name }}!</h1>
            <p>Welcome to our website. We are glad to have you here.</p>
            <div class="cell-container">
                <table class="table">
                    <tr>
                        <td class="cell-content">
                            <a href="{{ route('p12.form') }}">
                                <img src="https://i.ibb.co/8NF8S13/signature.png" alt="signature" border="0" width="75" height="75">
                            </a>
                            <div class="cell-text">Upload p12</div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="cell-container">
                <table class="table">
                    <tr>
                        <td class="cell-content">
                            <a href="{{ route('upload.form') }}">
                                <img src="https://i.ibb.co/HN6Q0sj/download-2.png" alt="download-2" border="0" width="75" height="75">
                            </a>
                            <div class="cell-text">Upload PDF</div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="cell-container">
                <table class="table">
                    <tr>
                        <td class="cell-content">
                            <a href="{{ route('verify.upload.pdf') }}">
                                <img src="https://i.ibb.co/9nMznVP/verified.png" alt="verified" border="0" width="75" height="75">
                            </a>
                            <div class="cell-text">Verify</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <img src="https://i.postimg.cc/Ssbzm203/2807918.png" alt="Image" style="max-width: 500px;">
        </div>
    </div>
</div>
@endsection
