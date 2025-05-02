@extends('admin.layout')

@section('title', 'Edit User')

@section('page-title', 'Edit User')

@section('content')
<div class="container-fluid">
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Basic Information</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" name="nama" value="{{ old('nama', $user->nama) }}" required>
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP:</label>
                            <input type="text" class="form-control" name="nip" value="{{ old('nip', $user->nip) }}" required>
                            @error('nip')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}" required>
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">New Password (leave blank to keep current):</label>
                            <input type="password" class="form-control" name="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password:</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Student Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" name="address" value="{{ old('address', $user->studentDetail->address ?? '') }}" required>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone', $user->studentDetail->phone ?? '') }}" required>
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="birth_date">Birth Date:</label>
                            <input type="date" class="form-control" name="birth_date" value="{{ old('birth_date', $user->studentDetail->birth_date ?? '') }}" required>
                            @error('birth_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="birth_place">Birth Place:</label>
                            <input type="text" class="form-control" name="birth_place" value="{{ old('birth_place', $user->studentDetail->birth_place ?? '') }}" required>
                            @error('birth_place')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select class="form-control" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male" {{ (old('gender', $user->studentDetail->gender ?? '') == 'male') ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ (old('gender', $user->studentDetail->gender ?? '') == 'female') ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sekolah">School:</label>
                            <input type="text" class="form-control" name="sekolah" value="{{ old('sekolah', $user->studentDetail->sekolah ?? '') }}">
                            @error('sekolah')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tingkat_kelas">Grade Level:</label>
                            <input type="text" class="form-control" name="tingkat_kelas" value="{{ old('tingkat_kelas', $user->studentDetail->tingkat_kelas ?? '') }}">
                            @error('tingkat_kelas')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tahun_ajaran">Academic Year:</label>
                            <input type="text" class="form-control" name="tahun_ajaran" value="{{ old('tahun_ajaran', $user->studentDetail->tahun_ajaran ?? '') }}">
                            @error('tahun_ajaran')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Payment Information</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="spp">SPP:</label>
                            <input type="text" class="form-control" name="spp" value="{{ old('spp', $user->studentDetail->spp ?? '') }}">
                            @error('spp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nominal_spp_default">Default SPP Amount:</label>
                            <input type="text" class="form-control" name="nominal_spp_default" value="{{ old('nominal_spp_default', $user->studentDetail->nominal_spp_default ?? '') }}">
                            @error('nominal_spp_default')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_rekening">Account Number:</label>
                            <input type="text" class="form-control" name="no_rekening" value="{{ old('no_rekening', $user->studentDetail->no_rekening ?? '') }}">
                            @error('no_rekening')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_bank">Bank Name:</label>
                            <input type="text" class="form-control" name="nama_bank" value="{{ old('nama_bank', $user->studentDetail->nama_bank ?? '') }}">
                            @error('nama_bank')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cabang_bank">Bank Branch:</label>
                            <input type="text" class="form-control" name="cabang_bank" value="{{ old('cabang_bank', $user->studentDetail->cabang_bank ?? '') }}">
                            @error('cabang_bank')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pemilik_rekening">Account Owner:</label>
                            <input type="text" class="form-control" name="pemilik_rekening" value="{{ old('pemilik_rekening', $user->studentDetail->pemilik_rekening ?? '') }}">
                            @error('pemilik_rekening')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 mb-4">
            <button type="submit" class="btn btn-primary">Update User</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
