
@extends('auth.dashboard')

@section('content')
<div class="container mt-5">
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
        <h2>Sertifikat</h2>
        @if ($certificate)
            <a>{{$certificate->p12_name}}</a><br/>
            <a href="{{ route('cert.download') }}" class="btn btn-primary">Download Sertifikat</a>
        @else
            <p>Anda tidak memiliki sertifikat.</p>
        @endif
</div>
@endsection
