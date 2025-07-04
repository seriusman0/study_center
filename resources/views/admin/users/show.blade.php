@extends('admin.layout')

@section('title', 'User Details')

@section('page-title', 'User Details')

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Basic Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ $user->nama }}</p>
                            <p><strong>NIP:</strong> {{ $user->nip }}</p>
                            <p><strong>Username:</strong> {{ $user->username }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Created At:</strong> {{ $user->created_at->format('d M Y H:i') }}</p>
                            <p><strong>Updated At:</strong> {{ $user->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Address:</strong> {{ $user->studentDetail->address ?? '-' }}</p>
                            <p><strong>Phone:</strong> {{ $user->studentDetail->phone ?? '-' }}</p>
                            <p><strong>Birth Date:</strong> {{ $user->studentDetail->birth_date ? date('d M Y', strtotime($user->studentDetail->birth_date)) : '-' }}</p>
                            <p><strong>Birth Place:</strong> {{ $user->studentDetail->birth_place ?? '-' }}</p>
                            <p><strong>Gender:</strong> {{ ucfirst($user->studentDetail->gender ?? '-') }}</p>
                            <p><strong>Status:</strong> {{ $user->studentDetail->is_active ? 'Active' : 'Inactive' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>School:</strong> {{ $user->studentDetail->sekolah ?? '-' }}</p>
                            <p><strong>Grade Level:</strong> {{ $user->studentDetail->tingkat_kelas ?? '-' }}</p>
                            <p><strong>Academic Year:</strong> {{ $user->studentDetail->tahun_ajaran ?? '-' }}</p>
                            <p><strong>SPP:</strong> {{ $user->studentDetail->spp ?? '-' }}</p>
                            <p><strong>Default SPP Amount:</strong> {{ $user->studentDetail->nominal_spp_default ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Bank Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Account Number:</strong> {{ $user->studentDetail->no_rekening ?? '-' }}</p>
                            <p><strong>Bank Name:</strong> {{ $user->studentDetail->nama_bank ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Bank Branch:</strong> {{ $user->studentDetail->cabang_bank ?? '-' }}</p>
                            <p><strong>Account Owner:</strong> {{ $user->studentDetail->pemilik_rekening ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Attendance Record</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Regular Attendance:</strong> {{ $user->attendanceRecord->regular_attendance ?? 0 }}</p>
                            <p><strong>CSS Attendance:</strong> {{ $user->attendanceRecord->css_attendance ?? 0 }}</p>
                            <p><strong>CGG Attendance:</strong> {{ $user->attendanceRecord->cgg_attendance ?? 0 }}</p>
                            <p><strong>Journal Entries:</strong> {{ $user->attendanceRecord->journal_entry ?? 0 }}</p>
                            <p><strong>Permission:</strong> {{ $user->attendanceRecord->permission ?? 0 }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>CGG Father:</strong> {{ $user->attendanceRecord->spr_father ?? 0 }}</p>
                            <p><strong>CGG Mother:</strong> {{ $user->attendanceRecord->spr_mother ?? 0 }}</p>
                            <p><strong>SPR Sibling:</strong> {{ $user->attendanceRecord->spr_sibling ?? 0 }}</p>
                            <p><strong>Record Date:</strong> {{ $user->attendanceRecord ? ($user->attendanceRecord->record_date ? date('d M Y', strtotime($user->attendanceRecord->record_date)) : '-') : '-' }}</p>
                            <p><strong>Notes:</strong> {{ $user->attendanceRecord->notes ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 mb-4">
        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit User</a>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to List</a>
        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</button>
        </form>
    </div>
</div>
@endsection
