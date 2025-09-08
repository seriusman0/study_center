@extends('adminlte::page')

@section('title', 'Rekap Pembayaran SPP & Kehadiran Per Siswa')

@section('content_header')
    <h1 class="m-0 text-dark">
        <i class="fas fa-file-invoice-dollar mr-2"></i> Rekap Pembayaran SPP & Kehadiran Per Siswa
    </h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-search mr-1"></i> Pilih Siswa
                </h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.journals.payment-attendance-report') }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="student">Siswa</label>
                                <select class="form-control select2" id="student" name="id" required onchange="this.form.submit()">
                                    <option value="">-- Pilih Siswa --</option>
                                    @foreach ($students as $s)
                                        <option value="{{ $s->id }}" {{ $student && $student->id == $s->id ? 'selected' : '' }}>
                                            {{ $s->nama }} ({{ $s->studentDetail->class ?? 'N/A' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if($student)
                                <div class="form-group">
                                    <label for="period">Periode</label>
                                    <select class="form-control" id="period" name="period" onchange="this.form.submit()">
                                        @foreach ($periods as $value => $label)
                                            <option value="{{ $value }}" {{ $currentPeriod == $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if($student)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-file-invoice mr-2"></i> Rekap Pembayaran SPP & Kehadiran
                    </h3>
                    <div class="card-tools">
                        <button class="btn btn-tool" onclick="window.print()">
                            <i class="fas fa-print"></i> Print
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="p-3">
                        <div class="row mb-4">
                            <div class="col-12">
                                <h2 class="text-center mb-3">Rekap Pembayaran SPP & Kehadiran Per Siswa</h2>
                                <h4 class="text-center">Study Center Gunung Sahari</h4>
                                <p class="text-center">Jl. Gunung Sahari 4 No 6</p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td style="width: 150px"><strong>Nama</strong></td>
                                        <td>: {{ $student->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kelas</strong></td>
                                        <td>: BATCH {{ $student->studentDetail->class ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>NIS</strong></td>
                                        <td>: {{ $student->nip }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Sekolah</strong></td>
                                        <td>: {{ $student->studentDetail->sekolah ?? 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6 text-right">
                                <table class="table table-borderless ml-auto">
                                    <tr>
                                        <td style="width: 150px"><strong>Tanggal</strong></td>
                                        <td>: {{ \Carbon\Carbon::now()->format('d-M-Y') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        @php
                            $periodStart = \Carbon\Carbon::createFromFormat('Y-m', $currentPeriod)->startOfMonth();
                            $periodName = $periodStart->format('F Y');
                            $periodMonth = $periodStart->format('m');
                            $periodYear = $periodStart->format('Y');
                            
                            // Calculate attendance stats
                            $regularAttendance = $student->attendanceRecords->sum('regular_attendance');
                            $cssAttendance = $student->attendanceRecords->sum('css_attendance');
                            $cggAttendance = $student->attendanceRecords->sum('cgg_attendance');
                            $totalAttendance = $regularAttendance + $cssAttendance + $cggAttendance;
                            
                            // Journals
                            $submittedJournals = $student->journals->where('is_submitted', true)->count();
                            
                            // Permissions
                            $approvedPermissions = $student->permissionRequests->where('status', 'approved')->count();
                            
                            // Payment calculation - similar to JournalStatistics component
                            $spp = $student->studentDetail->spp ?? 0;
                            $nominalSppDefault = $student->studentDetail->nominal_spp_default ?? 0;
                            $maxSpp = 700000;
                            
                            // Check if payment exists
                            $paymentProof = $student->paymentProofs->first();
                            
                            // Calculate if attendance percentage is at least 75%
                            $totalClasses = 5; // You can adjust this or make it dynamic
                            $attendancePercentage = $totalClasses > 0 ? ($totalAttendance / $totalClasses) * 100 : 0;
                            
                            // Calculate appreciation status
                            $hasAppreciation = $submittedJournals >= 25 && $attendancePercentage >= 100;
                            
                            // Calculate final payment
                            $finalPayment = null;
                            if ($attendancePercentage >= 75) {
                                if ($hasAppreciation) {
                                    $finalPayment = min((int)$nominalSppDefault, $maxSpp);
                                } else {
                                    $finalPayment = (int)$spp;
                                }
                            }
                            
                            // Calculate payment details
                            $tagihan = $spp;
                            $pembayaran = $finalPayment ?? 0;
                            $sisa = $tagihan - $pembayaran;
                        @endphp

                        <div class="row mt-4">
                            <div class="col-12">
                                <h5 class="text-center mb-3">Kehadiran di bulan {{ $periodName }}</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>Bulan</th>
                                                <th>Bln</th>
                                                <th>SPP</th>
                                                <th>Hadir Reg</th>
                                                <th>Hadir CSS</th>
                                                <th>Hadir CGG</th>
                                                <th>%</th>
                                                <th>Total Kel. Mendampingi</th>
                                                <th>Isi Jurnal</th>
                                                <th>Izin</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ substr($periodName, 0, 3) }}</td>
                                                <td>{{ $periodMonth }}</td>
                                                <td>{{ number_format($spp, 0, ',', '.') }}</td>
                                                <td class="text-center">{{ $regularAttendance }}</td>
                                                <td class="text-center">{{ $cssAttendance }}</td>
                                                <td class="text-center">{{ $cggAttendance }}</td>
                                                <td class="text-center">{{ number_format($attendancePercentage, 2) }}%</td>
                                                <td class="text-center">{{ $student->attendanceRecords->sum('spr_father') + $student->attendanceRecords->sum('spr_mother') + $student->attendanceRecords->sum('spr_sibling') }}</td>
                                                <td class="text-center">{{ $submittedJournals }}</td>
                                                <td class="text-center">{{ $approvedPermissions }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Tagihan dari Sekolah</td>
                                                <td>{{ number_format($tagihan, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pembayaran dari SCGS</td>
                                                <td>{{ number_format($pembayaran, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Sisa Pembayaran</td>
                                                <td>{{ number_format($sisa, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="font-weight-bold bg-light">Total Sisa Pembayaran (Rp)</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-center">
                                                    <h4>{{ number_format($sisa, 0, ',', '.') }}</h4>
                                                    <div class="bg-danger text-white p-2">
                                                        <strong>SISA YANG HARUS DIBAYAR OLEH ORANG TUA</strong>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        @if($paymentProof)
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
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($paymentProof->created_at)->format('d-M-Y') }}</td>
                                                <td>{{ number_format($pembayaran, 0, ',', '.') }}</td>
                                                <td>SPP</td>
                                                <td>{{ $paymentProof->notes ?? '-' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="row mt-5">
                            <div class="col-12">
                                <h5>Catatan dari SCGS:</h5>
                                <div class="border p-3 mb-4" style="min-height: 100px;">
                                    <!-- Catatan akan diisi disini -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    @media print {
        .no-print, .main-sidebar, .main-header, .content-header, .card-header, .card-tools, .card {
            display: none !important;
        }
        .content {
            margin: 0 !important;
            padding: 0 !important;
        }
        .card-body {
            padding: 0 !important;
        }
        body {
            background-color: white !important;
        }
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@stop
