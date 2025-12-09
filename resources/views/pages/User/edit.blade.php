@extends('layouts.guest.app')
@section('title', 'Edit Data Pengguna')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Edit Pengguna</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Current Profile Picture -->
        <div class="mb-3">
            <label class="form-label">Foto Profil Saat Ini</label>
            <div class="d-flex align-items-center">
                @if($user->profile_picture)
                    <div class="me-3">
                        <img src="{{ Storage::url($user->profile_picture) }}"
                             alt="Foto Profil" class="img-thumbnail rounded-circle" width="100" height="100">
                    </div>
                    <div>
                        <a href="{{ route('users.remove-picture', $user->id) }}"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Hapus foto profil?')">
                            <i class="fas fa-trash me-1"></i> Hapus Foto
                        </a>
                    </div>
                @else
                    <div class="me-3">
                        <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                             style="width: 100px; height: 100px;">
                            <span class="text-white fs-4">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                    </div>
                    <div class="text-muted">
                        <small>Belum ada foto profil</small>
                    </div>
                @endif
            </div>
        </div>

        <!-- New Profile Picture -->
        <div class="mb-3">
            <label for="profile_picture" class="form-label">Ganti Foto Profil</label>
            <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*">
            <div class="form-text">Biarkan kosong jika tidak ingin mengubah. Format: JPG, PNG, GIF. Maksimal: 2MB</div>
            @error('profile_picture') <div class="text-danger">{{ $message }}</div> @enderror

            <!-- Preview Image -->
            <div id="imagePreview" class="mt-2 d-none">
                <img id="previewImage" class="img-thumbnail" width="150">
                <small class="d-block text-muted mt-1">Preview foto baru</small>
            </div>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi Baru (Opsional)</label>
            <input type="password" name="password" id="password" class="form-control">
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profilePictureInput = document.getElementById('profile_picture');
    const imagePreview = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');

    profilePictureInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                imagePreview.classList.remove('d-none');
            }

            reader.readAsDataURL(this.files[0]);
        } else {
            imagePreview.classList.add('d-none');
        }
    });
});
</script>

<style>
.card {
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.card-header {
    border-radius: 10px 10px 0 0 !important;
}

.form-label {
    font-weight: 600;
    color: #495057;
}

.btn {
    border-radius: 6px;
    font-weight: 500;
}

.bg-light {
    background-color: #f8f9fa !important;
}

.img-thumbnail {
    border: 2px solid #dee2e6;
    border-radius: 8px;
    padding: 4px;
    background-color: #f8f9fa;
}
</style>
@endsection
