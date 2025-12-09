@extends('layouts.guest.app')
@section('title', 'Tambah Pengguna')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Tambah Pengguna Baru</h2>

    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <!-- TAMBAHKAN FORM UPLOAD FOTO PROFIL -->
        <div class="mb-3">
            <label for="profile_picture" class="form-label">Foto Profil</label>
            <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*">
            <div class="form-text">Format: JPG, PNG, GIF. Maksimal: 2MB</div>
            @error('profile_picture') <div class="text-danger">{{ $message }}</div> @enderror

            <!-- Preview Image -->
            <div id="imagePreview" class="mt-2 d-none">
                <img id="previewImage" class="img-thumbnail" width="150">
            </div>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
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
.img-thumbnail {
    border: 2px solid #dee2e6;
    border-radius: 8px;
    padding: 4px;
    background-color: #f8f9fa;
}
</style>
@endsection
