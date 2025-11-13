@extends('layouts.guest.app')
@section('title', 'Detail Pengguna')

@section('content')

    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Dibuat pada:</strong> {{ $user->created_at->format('d M Y H:i') }}</p>
            <p><strong>Terakhir diperbarui:</strong> {{ $user->updated_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
