@extends('auth.dashboard')

@section('content')
<div class="container mt-5">
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <h2>Sertifikat</h2>
    @if ($certificate)
        <p>Nama Sertifikat: {{$certificate->p12_name}}</p>
        <a href="{{ route('cert.download') }}" class="btn btn-primary">Download Sertifikat</a>
    @else
        <p>Anda tidak memiliki sertifikat.</p>
    @endif
</div>

@if ($certificate)
<div class="container mt-5">
    <h2>Show P12 Password</h2>
    @if(session('password'))
    <div class="alert alert-success">
        Pass Sertifikat: {{ session('password') }}
    </div>
    @endif
    <form method="POST" action="{{ route('showP12Password') }}">
        @csrf
        <div class="mb-3">
            <label for="password" class="form-label">Password Akun</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Lihat Password P12</button>
    </form>
</div>

<div class="container mt-5">
    <h2>Pengajuan Perubahan Sertifikat</h2>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form method="POST" action="{{ route('cert.request') }}">
        @csrf
        <div class="form-group">
            <label for="reason">Alasan Pengajuan</label>
            <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ajukan Perubahan</button>
    </form>
</div>

<div class="container mt-5">
    <h2>History Pengajuan</h2>
    @if($requests->isEmpty())
        <p>Anda belum melakukan pengajuan perubahan sertifikat.</p>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <th>Alasan Pengajuan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr>
                            <td>{{ $request->created_at }}</td>
                            <td>{{ $request->reason }}</td>
                            <td>{{ $request->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endif
@endsection
