@extends('layouts.student')

@section('title', 'Permintaan Izin | Study Center')

@section('content')
    <div class="form-container">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Formulir Permintaan Izin</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('student.permissions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="class_type" class="form-label required">Jenis Kelas</label>
                        <select class="form-select @error('class_type') is-invalid @enderror" 
                                id="class_type" name="class_type" required>
                            <option value="">Pilih Jenis Kelas</option>
                            <option value="regular" {{ old('class_type') == 'regular' ? 'selected' : '' }}>Kelas Reguler</option>
                            <option value="css" {{ old('class_type') == 'css' ? 'selected' : '' }}>Kelas CSS</option>
                            <option value="cgg" {{ old('class_type') == 'cgg' ? 'selected' : '' }}>Kelas CGG</option>
                        </select>
                        @error('class_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label required">Tanggal</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" 
                               id="date" name="date" value="{{ old('date') }}" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="reason" class="form-label required">Alasan</label>
                        <textarea class="form-control @error('reason') is-invalid @enderror" 
                                  id="reason" name="reason" rows="3" required>{{ old('reason') }}</textarea>
                        @error('reason')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Harap berikan alasan yang jelas dan spesifik untuk ketidakhadiran Anda.</small>
                    </div>

                    <div class="mb-3">
                        <label for="attachment" class="form-label">Dokumen Pendukung</label>
                        <input type="file" class="form-control @error('attachment') is-invalid @enderror" 
                               id="attachment" name="attachment">
                        @error('attachment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Format yang diterima: PDF, JPG, JPEG, PNG (maks 2MB)</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('student.permissions.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
