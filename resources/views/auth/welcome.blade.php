@extends('auth.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 text-center"> <!-- Use col-md-6 to split the column in half -->
            <h1>Hello, {{ auth()->user()->name }}!</h1>
            <p>Welcome to our website. We are glad to have you here.</p>
        </div>
        <div class="col-md-6 text-center"> <!-- Use col-md-6 to split the column in half -->
            <img src="https://i.postimg.cc/Ssbzm203/2807918.png" alt="Image" style="max-width: 500px;">
        </div>
    </div>
</div>
@endsection
