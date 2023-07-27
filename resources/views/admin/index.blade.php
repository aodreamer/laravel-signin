@extends('auth.dashboard')

@section('content')
<div class="container">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-info">
            {{ session('success') }}
        </div>
    @endif
    <h2>Daftar Permintaan Perubahan Sertifikat</h2>
    @if ($requests->isEmpty())
        <p>Tidak ada permintaan perubahan sertifikat.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Date Requested</th>
                    <th>Date Updated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->reason }}</td>
                    <td>{{ $request->status }}</td>
                    <td>{{ $request->created_at }}</td>
                    <td>{{ $request->updated_at }}</td>
                    <td>
                        @if ($request->status === 'pending')
                        <form action="{{ route('changeStatus.request', ['request' => $request->id, 'status' => 'Progress'])}}" method="POST">
                            @csrf
                            <input type="submit" value="Accept" class="btn btn-success"/>
                        </form>
                        <form action=" {{route('changeStatus.request', ['request' => $request->id, 'status' => 'Rejected'])}}" method="POST">
                            @csrf
                            <input type="submit" value="Reject" class="btn btn-danger"/>
                        </form>
                        @elseif ($request->status === 'Progress')
                        <form action=" {{route('reupload.certificate.form', ['id' => $request->user->id])}}" method="GET">
                            @csrf
                            <input type="submit" value="Upload Sertifikat" class="btn btn-primary"/>
                        </form>
                        <form action=" {{route('changeStatus.request', ['request' => $request->id, 'status' => 'Rejected'])}}" method="POST">
                            @csrf
                            <input type="submit" value="Reject" class="btn btn-danger"/>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>


<div class="container">
    <h2>Daftar File</h2>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Pengunggah</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $file)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $file->filename }}</td>
                    <td>{{ $file->author->name }}</td>
                    <td>
                        <a href="{{ route('jdih.download', $file->id) }}" class="btn btn-primary">Unduh</a>
                        <form action="{{ route('delete.file', ['fileId' => $file->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus File</button>
                        </form>                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
