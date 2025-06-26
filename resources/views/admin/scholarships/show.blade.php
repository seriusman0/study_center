@extends('admin.layout')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Beasiswa Siswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.scholarships.index') }}">Beasiswa</a>
                        </li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Card -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center">{{ $user->nama }}</h3>
                            <p class="text-muted text-center">{{ $user->nip }}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Kelas</b> <a class="float-right">{{ $user->kelas }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Sekolah</b> <a class="float-right">{{ optional($user->studentDetail)->sekolah }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>No. Rekening</b> <a class="float-right">{{ optional($user->studentDetail)->no_rekening }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Family Members Card -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Keluarga</h3>
                        </div>
                        <div class="card-body">
                            @foreach($user->familyMembers as $member)
                                <strong>{{ ucfirst($member->member_type) }}</strong>
                                <p class="text-muted">{{ $member->nama }}</p>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- Attendance Card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Kehadiran</h3>
                        </div>
                        <div class="card-body">
                            @if($user->attendanceRecord)
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Regular</span>
                                                <span class="info-box-number">{{ $user->attendanceRecord->regular_attendance }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <div class="info-box-content">
                                                <span class="info-box-text">CSS</span>
                                                <span class="info-box-number">{{ $user->attendanceRecord->css_attendance }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <div class="info-box-content">
                                                <span class="info-box-text">CGG</span>
                                                <span class="info-box-number">{{ $user->attendanceRecord->cgg_attendance }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress-group">
                                    <span class="progress-text">Persentase Kehadiran</span>
                                    <span class="float-right">{{ number_format($user->attendanceRecord->attendance_percentage, 1) }}%</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" 
                                             style="width: {{ $user->attendanceRecord->attendance_percentage }}%">
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p class="text-muted">Belum ada data kehadiran</p>
                            @endif
                        </div>
                    </div>

                    <!-- Scholarship Card -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Beasiswa</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.scholarships.update', $user) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="form-group">
                                    <label>Nominal SPP</label>
                                    <input type="number" name="spp_amount" class="form-control" 
                                           value="{{ old('spp_amount', optional($user->scholarship)->spp_amount) }}"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label>Status SPR</label>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="fatherSpr" 
                                               name="father_spr_submitted" value="1"
                                               {{ optional($user->scholarship)->father_spr_submitted ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="fatherSpr">CGG Ayah</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="motherSpr" 
                                               name="mother_spr_submitted" value="1"
                                               {{ optional($user->scholarship)->mother_spr_submitted ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="motherSpr">CGG Ibu</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="siblingSpr" 
                                               name="sibling_spr_submitted" value="1"
                                               {{ optional($user->scholarship)->sibling_spr_submitted ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="siblingSpr">CGG Saudara</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Catatan Khusus</label>
                                    <textarea name="special_notes" class="form-control" rows="3">{{ optional($user->scholarship)->special_notes }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Nominal Beasiswa</label>
                                    <input type="text" class="form-control" 
                                           value="Rp {{ number_format(optional($user->scholarship)->scholarship_amount, 0, ',', '.') }}"
                                           readonly>
                                </div>

                                <div class="form-group">
                                    <label>Pembayaran Final</label>
                                    <input type="text" class="form-control" 
                                           value="Rp {{ number_format(optional($user->scholarship)->final_payment, 0, ',', '.') }}"
                                           readonly>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>

                    <!-- Journal Card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Jurnal</h3>
                        </div>
                        <div class="card-body">
                            @if($user->journals->isNotEmpty())
                                <div class="timeline">
                                    @foreach($user->journals as $journal)
                                        <div>
                                            <i class="fas fa-journal-whills bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time">
                                                    <i class="fas fa-clock"></i> 
                                                    {{ $journal->created_at->format('d/m/Y H:i') }}
                                                </span>
                                                <h3 class="timeline-header">
                                                    {{ $journal->entry_date->format('d F Y') }}
                                                </h3>
                                                <div class="timeline-body">
                                                    {{ $journal->content }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">Belum ada entri jurnal</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
