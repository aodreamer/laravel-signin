<!-- resources/views/certificate/choose_user.blade.php -->

@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h2>Pilih Pengguna dengan P12</h2>
        @if(session()->has('password'))
            <div class="alert alert-info">
                Password: {{ session('password') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('showP12Password.form') }}">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">Pilih Pengguna</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    <option value="">Pilih Pengguna</option>
                    @foreach($usersWithP12 as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tampilkan Password</button>
        </form>
    </div>
@endsection
