@extends('adminlte::page')

@section('title', 'Rekap Pembayaran SPP & Kehadiran Per Siswa')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-file-invoice mr-2"></i> Rekap Pembayaran SPP & Kehadiran Per Siswa
        </h1>
        <a href="{{ route('admin.journals.statistics') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Back to Statistics
        </a>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-search mr-2"></i> Select Student & Period
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.journals.student-report') }}" method="GET" class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="student">Student</label>
                            <select name="id" id="student" class="form-control select2" required>
                                <option value="">-- Select Student --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $selectedUser && $selectedUser->id == $user->id ? 'selected' : '' }}>
                                        {{ $user->nama }} ({{ $user->studentDetail->class ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="monthYear">Period (Month & Year)</label>
                            <input type="month" name="monthYear" id="monthYear" class="form-control" 
                                value="{{ $monthYear }}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="d-block">&nbsp;</label>
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-search mr-1"></i> Generate Report
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if($selectedUser && $reportData)
            <div class="card">
                <div class="card-header bg-success">
                    <h3 class="card-title">
                        <i class="fas fa-file-alt mr-2"></i> Report Preview
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.journals.export-student-report', ['id' => $selectedUser->id, 'monthYear' => $monthYear]) }}" 
                           class="btn btn-sm btn-light" target="_blank">
                            <i class="fas fa-print mr-1"></i> Print/Export
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="container-fluid p-4">
                        <!-- Report Header -->
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <h1 class="text-dark">Rekap Pembayaran SPP & Kehadiran Per Siswa</h1>
                                <h4 class="text-muted">Study Center Gunung Sahari</h4>
                                <p class="mb-0">Jl. Gunung Sahari 4 No 6</p>
                            </div>
                            <div class="col-md-4 text-right">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="img-fluid" style="max-height: 100px;">
                            </div>
                        </div>

                        <!-- Student Information -->
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <strong>Nama</strong>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" readonly value="{{ $selectedUser->nama }}">
                                </div>
                            </div>
                            <div class="col-md-3 offset-md-3 text-right">
                                <strong>Tanggal:</strong> {{ now()->format('d-M-Y') }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <strong>Kelas</strong>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" readonly value="BATCH {{ $selectedUser->studentDetail->batch ?? 'N/A' }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <strong>NIS</strong>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" readonly value="{{ $selectedUser->nip ?? 'N/A' }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <strong>Sekolah</strong>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" readonly value="{{ $selectedUser->studentDetail->sekolah ?? 'N/A' }}">
                            </div>
                        </div>

                        <!-- Attendance Table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="bg-light">
                                                <th rowspan="2" class="align-middle text-center">Bulan</th>
                                                <th rowspan="2" class="align-middle text-center">BIn</th>
                                                <th rowspan="2" class="align-middle text-center">SPP</th>
                                                <th colspan="6" class="text-center bg-info text-white">Kehadiran di bulan {{ $reportData['bulan'] }} {{ $reportData['tahun'] }}</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center bg-info text-white">Hadir Reg</th>
                                                <th class="text-center bg-info text-white">Hadir CSS</th>
                                                <th class="text-center bg-info text-white">Hadir CGG</th>
                                                <th class="text-center bg-info text-white">%</th>
                                                <th class="text-center bg-warning text-dark">Total Kel. Mendampingi</th>
                                                <th class="text-center bg-danger text-white">Isi Jurnal</th>
                                                <th class="text-center bg-success text-white">Izin</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $reportData['bulan'] }}</td>
                                                <td class="text-center">{{ $reportData['bin'] }}</td>
                                                <td class="text-right">{{ number_format($reportData['spp'], 0, ',', '.') }}</td>
                                                <td class="text-center">{{ $reportData['hadir_reg'] }}</td>
                                                <td class="text-center">{{ $reportData['hadir_css'] }}</td>
                                                <td class="text-center">{{ $reportData['hadir_cgg'] }}</td>
                                                <td class="text-center">{{ number_format($reportData['percentage'], 2) }}%</td>
                                                <td class="text-center">{{ $reportData['total_kehadiran'] }}</td>
                                                <td class="text-center">{{ $reportData['isi_jurnal'] }}</td>
                                                <td class="text-center">{{ $reportData['izin'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Notes Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-info text-white">
                                        Catatan dari SCGS:
                                    </div>
                                    <div class="card-body" style="min-height: 100px; border: 1px solid #e83e8c;">
                                        {{ $reportData['catatan'] }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Summary -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr class="bg-light">
                                                <td class="font-weight-bold">Tagihan dari Sekolah</td>
                                                <td class="text-right">{{ number_format($reportData['tagihan_sekolah'], 0, ',', '.') }}</td>
                                                <td colspan="2"></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Pembayaran dari SCGS</td>
                                                <td class="text-right">{{ number_format($reportData['pembayaran_scgs'], 0, ',', '.') }}</td>
                                                <td colspan="2"></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Sisa Pembayaran</td>
                                                <td class="text-right">{{ number_format($reportData['sisa_pembayaran'], 0, ',', '.') }}</td>
                                                <td colspan="2"></td>
                                            </tr>
                                            <tr class="bg-danger text-white">
                                                <td colspan="4" class="text-center font-weight-bold">
                                                    SISA YANG HARUS DIBAYAR OLEH ORANG TUA
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-right font-weight-bold">
                                                    {{ number_format($reportData['sisa_pembayaran'], 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5>Rincian Pembayaran</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Jumlah (Rp)</th>
                                                <th>Kode Bayar</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($reportData['payment_details'] as $payment)
                                                <tr>
                                                    <td>{{ $payment['tanggal'] }}</td>
                                                    <td class="text-right">{{ number_format($payment['jumlah'], 0, ',', '.') }}</td>
                                                    <td>{{ $payment['kode'] }}</td>
                                                    <td>{{ $payment['keterangan'] }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No payment records found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop

@section('js')
<script>
    $(function() {
        $('.select2').select2();
    });
</script>
@stop
