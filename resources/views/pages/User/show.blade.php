@extends('layouts.guest.app')
@section('title', 'Detail Pengguna')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Detail Pengguna</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if ($user->profile_picture)
                            <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}"
                                alt="{{ $user->name }}" class="img-thumbnail rounded-circle mb-3"
                                style="width: 200px; height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                style="width: 200px; height: 200px;">
                                <span class="text-white display-4">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                        @endif

                        <!-- Di bagian role colors -->
                        @php
                            $roleColors = [
                                'admin' => 'bg-danger',
                                'petugas' => 'bg-warning text-dark',
                                'user' => 'bg-primary',
                            ];
                            $roleColor = $roleColors[$user->role] ?? 'bg-secondary';
                        @endphp

                        <span class="badge {{ $roleColor }} px-3 py-2 fs-6 mb-2">
                            <i class="fas fa-user-tag me-1"></i>
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>

                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">ID Pengguna</th>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Role</th>
                                    <td>
                                        <span class="badge {{ $roleColor }}">{{ ucfirst($user->role) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Bergabung</th>
                                    <td>{{ $user->created_at->format('d F Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Terakhir Diperbarui</th>
                                    <td>{{ $user->updated_at->format('d F Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table th {
            background-color: #f8f9fa;
        }
    </style>
@endsection
