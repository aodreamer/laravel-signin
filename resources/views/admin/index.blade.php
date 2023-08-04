@extends('auth.dashboard')

@section('content')
<style>
    /* Custom CSS for button width and margin */
    .btn-action {
        width: 120px;
        margin-bottom: 10px;
    }

    /* Custom CSS for status background colors */
    .status-pending {
        background-color: gray;
    }

    .status-progress {
        background-color: yellow;
    }

    .status-rejected {
        background-color: red;
    }

    .status-done {
        background-color: yellow;
    }
</style>

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
    <h2 class="mb-4">Daftar Permintaan Perubahan Sertifikat</h2>
    @if ($requests->isEmpty())
        <p class="alert alert-info">Tidak ada permintaan perubahan sertifikat.</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Requested</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>{{ $request->user->name }}</td>
                        <td>{{ $request->reason }}</td>
                        <td class="status-{{ strtolower($request->status) }}">{{ $request->status }}</td>
                        <td>{{ $request->created_at->format('Y-m-d') }}</td>
                        <td>{{ $request->updated_at->format('Y-m-d') }}</td>
                        <td>
                            @if ($request->status === 'pending')
                            <form action="{{ route('changeStatus.request', ['request' => $request->id, 'status' => 'Progress']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-action">Accept</button>
                            </form>
                            <form action="{{ route('changeStatus.request', ['request' => $request->id, 'status' => 'Rejected']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-action">Reject</button>
                            </form>
                            @elseif ($request->status === 'Progress')
                            <form action="{{ route('reupload.certificate.form', ['id' => $request->user->id]) }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-action">Upload</button>
                            </form>
                            <form action="{{ route('changeStatus.request', ['request' => $request->id, 'status' => 'Rejected']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-action">Reject</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>


<div class="container mt-4">
    <h2>Daftar File</h2>
    <div class="table-responsive">
        <table class="table table-hover">
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
                        <form action="{{ route('update.file.form', ['fileId' => $file->id]) }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-warning">Update File</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
