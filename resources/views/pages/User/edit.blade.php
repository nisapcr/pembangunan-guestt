@extends('layouts.guest.app')
@section('title', 'Edit Data Pengguna')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i>Edit Pengguna</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control"
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control"
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                                    <select name="role" id="role" class="form-select" required>
                                        @foreach($roles as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ old('role', $user->role) == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password Baru</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    <div class="form-text">Kosongkan jika tidak ingin mengubah</div>
                                    @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Foto Profil Saat Ini -->
                        <div class="mb-3">
                            <label class="form-label">Foto Profil Saat Ini</label>
                            <div class="border rounded p-3 text-center">
                                @if($user->profile_picture)
                                    <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}"
                                         alt="Foto Profil" class="img-thumbnail rounded-circle mb-2"
                                         width="150" height="150" style="object-fit: cover;">
                                    <div>
                                        <a href="{{ route('users.remove-picture', $user->id) }}"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Hapus foto profil?')">
                                            <i class="fas fa-trash me-1"></i> Hapus Foto
                                        </a>
                                    </div>
                                @else
                                    <!-- Placeholder Image dari placeholder.com (compressed) -->
                                    <img src="https://via.placeholder.com/150x150/0d6efd/FFFFFF?text={{ urlencode(strtoupper(substr($user->name, 0, 1))) }}"
                                         alt="Foto Profil Placeholder"
                                         class="img-thumbnail rounded-circle mb-2"
                                         width="150" height="150" style="object-fit: cover;">
                                    <div class="text-muted">
                                        <small>Menggunakan foto placeholder</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Ganti Foto Profil -->
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Ganti Foto Profil</label>
                            <input type="file" name="profile_picture" id="profile_picture"
                                   class="form-control" accept="image/*">
                            <div class="form-text small">
                                Biarkan kosong jika tidak ingin mengubah<br>
                                <small class="text-muted">Format: JPG, PNG | Maks: 2MB</small>
                            </div>
                            @error('profile_picture') <div class="text-danger small">{{ $message }}</div> @enderror

                            <!-- Preview Image -->
                            <div id="imagePreview" class="mt-2 d-none text-center">
                                <img id="previewImage" class="img-thumbnail rounded-circle" width="100" height="100" style="object-fit: cover;">
                                <small class="d-block text-muted mt-1">Preview foto baru</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Perbarui
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profilePictureInput = document.getElementById('profile_picture');
    const imagePreview = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');

    profilePictureInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            // Validasi ukuran file (maks 2MB)
            if (this.files[0].size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB');
                this.value = '';
                imagePreview.classList.add('d-none');
                return;
            }

            // Validasi tipe file
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!validTypes.includes(this.files[0].type)) {
                alert('Format file harus JPG atau PNG');
                this.value = '';
                imagePreview.classList.add('d-none');
                return;
            }

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
    border: 3px solid #dee2e6;
    transition: all 0.3s ease;
}
.img-thumbnail:hover {
    border-color: #0d6efd;
    transform: scale(1.02);
}
</style>
@endsection
