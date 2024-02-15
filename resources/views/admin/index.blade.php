@extends('auth.dashboard')

@section('content')
<style>
    /* Custom CSS for button width and margin */
    .btn-action {
        width: 80px;
        margin-right: 10px;
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
                            <div class="btn-group" role="group">
                                <form action="{{ route('changeStatus.request', ['request' => $request->id, 'status' => 'Progress']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-action">Accept</button>
                                </form>
                                <form action="{{ route('changeStatus.request', ['request' => $request->id, 'status' => 'Rejected']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-action">Reject</button>
                                </form>
                            </div>
                            @elseif ($request->status === 'Progress')
                            <div class="btn-group" role="group">
                                <form action="{{ route('reupload.certificate.form', ['id' => $request->user->id]) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-action">Upload</button>
                                </form>
                                <form action="{{ route('changeStatus.request', ['request' => $request->id, 'status' => 'Rejected']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-action">Reject</button>
                                </form>
                            </div>
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
                    <td><a href="{{ route('jdih.download', $file->id) }}">{{ $file->filename }}</a></td>
                    <td>{{ $file->author->name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('delete.file', ['fileId' => $file->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-action">Hapus</button>
                            </form>
                            <form action="{{ route('update.file.form', ['fileId' => $file->id]) }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-action">Update</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="container mt-4">
    <h2>Daftar Label Document</h2>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Label</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($labels as $label)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$label->name}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('delete.label', ['document_label' => $label->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-action">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('create.label') }}" method="POST">
            @csrf
            <i>Tambah Label</i>
            <input type="text" class="input-group-text" name="name">
            <button type="submit" class="btn btn-success btn-action">Tambah</button>
        </form>
    </div>
</div>
@endsection
