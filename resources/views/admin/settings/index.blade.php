@extends('admin.layout')

@section('title', 'Pengaturan')

@section('page-title', 'Pengaturan')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Profil Admin</h3>
            </div>
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="card-body">
                    <div class="row">
                        <!-- Avatar Section -->
                        <div class="col-md-12 text-center mb-4">
                            <div class="img-circle-container mx-auto" style="width: 150px; height: 150px; overflow: hidden; border-radius: 50%;">
                                <img id="avatar-preview" src="{{ $admin->avatar ? asset('storage/avatars/'.$admin->avatar) : asset('assets/public/logo/user_profile.jpg') }}" 
                                     class="img-fluid" alt="Admin Avatar" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <div class="mt-3">
                                <input type="file" name="avatar" id="avatar" class="d-none" accept="image/jpeg,image/png,image/jpg">
                                <button type="button" class="btn btn-primary" onclick="document.getElementById('avatar').click()">
                                    <i class="fas fa-upload"></i> Upload Foto
                                </button>
                                <div class="mt-2 text-muted small">
                                    <p class="mb-1"><i class="fas fa-info-circle"></i> Persyaratan foto:</p>
                                    <ul class="pl-4">
                                        <li>Format: JPG, JPEG, atau PNG</li>
                                        <li>Ukuran maksimal: 1MB (1024KB)</li>
                                        <li>Dimensi maksimal: 2048 x 2048 pixel</li>
                                    </ul>
                                </div>
                            </div>
                            @error('avatar')
                                <div class="alert alert-danger mt-2">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Admin Information -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $admin->name) }}">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" 
                                       id="username" name="username" value="{{ old('username', $admin->username) }}">
                                @error('username')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password Baru</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('avatar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Check file size (1MB = 1024 * 1024 bytes)
        if (file.size > 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal ukuran file adalah 1MB.');
            this.value = ''; // Clear the file input
            return;
        }

        // Check file type
        if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
            alert('Format file tidak didukung. Gunakan format JPG, JPEG, atau PNG.');
            this.value = ''; // Clear the file input
            return;
        }

        // Preview image if validation passes
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatar-preview').src = e.target.result;
        }
        reader.readAsDataURL(file);

        // Create image object to check dimensions
        const img = new Image();
        img.onload = function() {
            if (this.width > 2048 || this.height > 2048) {
                alert('Dimensi gambar terlalu besar. Maksimal dimensi adalah 2048x2048 pixel.');
                document.getElementById('avatar').value = ''; // Clear the file input
                document.getElementById('avatar-preview').src = '{{ $admin->avatar ? asset('storage/avatars/'.$admin->avatar) : asset('assets/public/logo/user_profile.jpg') }}';
            }
        }
        img.src = URL.createObjectURL(file);
    }
});
</script>
@endpush
@endsection
