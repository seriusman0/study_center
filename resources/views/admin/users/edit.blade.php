@extends('admin.layout')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit User</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Basic Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Basic Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $user->nama) }}" required>
                                    @error('nama')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip', $user->nip) }}" required>
                                    @error('nip')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->username) }}" required>
                                    @error('username')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                    <small class="text-muted">Leave blank to keep current password</small>
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="batch_id">Batch</label>
                                    <select class="form-control @error('batch_id') is-invalid @enderror" name="batch_id" required>
                                        <option value="">Select Batch</option>
                                        @foreach($batches as $batch)
                                            <option value="{{ $batch->id }}" {{ old('batch_id', $user->batch_id) == $batch->id ? 'selected' : '' }}>
                                                {{ $batch->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('batch_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="L" {{ old('gender', $user->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('gender', $user->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="class_id">Kelas</label>
                                    <select class="form-control @error('class_id') is-invalid @enderror" name="class_id">
                                        <option value="">Select Kelas</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}" {{ old('class_id', $user->class_id) == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }} ({{ $class->level }}{{ $class->section }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('class_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Student Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sekolah">Sekolah</label>
                                    <input type="text" class="form-control @error('sekolah') is-invalid @enderror" name="sekolah" value="{{ old('sekolah', $user->studentDetail->sekolah ?? '') }}" required>
                                    @error('sekolah')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="spp">SPP</label>
                                    <input type="number" step="0.01" class="form-control @error('spp') is-invalid @enderror" name="spp" value="{{ old('spp', $user->studentDetail->spp ?? '') }}" required>
                                    @error('spp')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tingkat_kelas">Tingkat Kelas</label>
                                    <input type="text" class="form-control @error('tingkat_kelas') is-invalid @enderror" name="tingkat_kelas" value="{{ old('tingkat_kelas', $user->studentDetail->tingkat_kelas ?? '') }}" required>
                                    @error('tingkat_kelas')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tahun_ajaran">Tahun Ajaran</label>
                                    <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" name="tahun_ajaran" value="{{ old('tahun_ajaran', $user->studentDetail->tahun_ajaran ?? '') }}" required>
                                    @error('tahun_ajaran')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nominal_spp_default">Nominal SPP Default</label>
                                    <input type="number" step="0.01" class="form-control @error('nominal_spp_default') is-invalid @enderror" name="nominal_spp_default" value="{{ old('nominal_spp_default', $user->studentDetail->nominal_spp_default ?? '') }}" required>
                                    @error('nominal_spp_default')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bank Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Bank Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_rekening">Nomor Rekening</label>
                                    <input type="text" class="form-control @error('no_rekening') is-invalid @enderror" name="no_rekening" value="{{ old('no_rekening', $user->studentDetail->no_rekening ?? '') }}" required>
                                    @error('no_rekening')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_bank">Nama Bank</label>
                                    <input type="text" class="form-control @error('nama_bank') is-invalid @enderror" name="nama_bank" value="{{ old('nama_bank', $user->studentDetail->nama_bank ?? '') }}" required>
                                    @error('nama_bank')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cabang_bank">Cabang Bank</label>
                                    <input type="text" class="form-control @error('cabang_bank') is-invalid @enderror" name="cabang_bank" value="{{ old('cabang_bank', $user->studentDetail->cabang_bank ?? '') }}" required>
                                    @error('cabang_bank')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pemilik_rekening">Pemilik Rekening</label>
                                    <input type="text" class="form-control @error('pemilik_rekening') is-invalid @enderror" name="pemilik_rekening" value="{{ old('pemilik_rekening', $user->studentDetail->pemilik_rekening ?? '') }}" required>
                                    @error('pemilik_rekening')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Family Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Family Information</h4>
                    </div>
                    <div class="card-body">
                        <!-- Father -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="father_name">Nama Ayah</label>
                                    <input type="text" class="form-control @error('father_name') is-invalid @enderror" name="father_name" 
                                        value="{{ old('father_name', $user->familyMembers->where('member_type', 'Father')->first()->nama ?? '') }}" required>
                                    @error('father_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="father_id">ID Ayah</label>
                                    <input type="text" class="form-control @error('father_id') is-invalid @enderror" name="father_id" 
                                        value="{{ old('father_id', $user->familyMembers->where('member_type', 'Father')->first()->member_id ?? '') }}">
                                    @error('father_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Mother -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mother_name">Nama Ibu</label>
                                    <input type="text" class="form-control @error('mother_name') is-invalid @enderror" name="mother_name" 
                                        value="{{ old('mother_name', $user->familyMembers->where('member_type', 'Mother')->first()->nama ?? '') }}" required>
                                    @error('mother_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mother_id">ID Ibu</label>
                                    <input type="text" class="form-control @error('mother_id') is-invalid @enderror" name="mother_id" 
                                        value="{{ old('mother_id', $user->familyMembers->where('member_type', 'Mother')->first()->member_id ?? '') }}">
                                    @error('mother_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Siblings (Livewire Component) -->
                        @livewire('user-siblings', ['user' => $user])
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update User</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const siblingsContainer = document.querySelector('.siblings-container');
    const addSiblingBtn = document.querySelector('#add-sibling');

    // Add new sibling row
    addSiblingBtn.addEventListener('click', function() {
        const siblingRows = document.querySelectorAll('.sibling-row');
        const newIndex = siblingRows.length;
        
        const newRow = document.createElement('div');
        newRow.className = 'row sibling-row';
        newRow.innerHTML = `
            <div class="col-md-5">
                <div class="form-group">
                    <label for="sibling_names[${newIndex}]">Nama Saudara</label>
                    <input type="text" class="form-control" name="sibling_names[]">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="sibling_ids[${newIndex}]">ID Saudara</label>
                    <input type="text" class="form-control" name="sibling_ids[]">
                </div>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger mb-3 remove-sibling">Remove</button>
            </div>
        `;
        
        siblingsContainer.insertBefore(newRow, addSiblingBtn);
    });

    // Remove sibling row
    siblingsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-sibling')) {
            e.target.closest('.sibling-row').remove();
        }
    });
});
</script>
@endpush
@endsection
