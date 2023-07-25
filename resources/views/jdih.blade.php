@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar File</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Pengunggah</th>
                    <th>Unduh</th>
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
