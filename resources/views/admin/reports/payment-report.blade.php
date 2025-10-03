@extends('adminlte::page')

@section('title', 'Payment Report')

@section('content_header')
    <h1>Rekap Pembayaran SPP & Kehadiran Per Siswa</h1>
@stop

@section('content')
    <div class="container-fluid">
        <!-- Student Selection Form -->
        <div class="card mb-3">
            <div class="card-header bg-primary">
                <h3 class="card-title">Pilih Siswa</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.reports.payment.show') }}" method="GET" class="form-inline">
                    <div class="form-group mr-3">
                        <label for="student_id" class="mr-2">Siswa:</label>
                        <select name="student_id" id="student_id" class="form-control select2">
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ $selectedStudentId == $student->id ? 'selected' : '' }}>
                                    {{ $student->nama }} (BATCH {{ $student->studentDetail->batch ?? 'N/A' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mr-3">
                        <label for="period" class="mr-2">Periode:</label>
                        <select name="period" id="period" class="form-control">
                            @foreach($periods as $value => $label)
                                <option value="{{ $value }}" {{ $selectedPeriod == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                    @if($selectedStudentId)
                        <a href="{{ route('admin.reports.payment.export', ['student_id' => $selectedStudentId, 'period' => $selectedPeriod]) }}" 
                           class="btn btn-success ml-2">
                            <i class="fas fa-file-excel mr-1"></i> Download Excel
                        </a>
                    @endif
                </form>
            </div>
        </div>

        @if($selectedStudentId && $reportData)
        <!-- Excel-like Report -->
        <div class="card">
            <div class="card-body p-0">
                <div class="excel-report">
                    <!-- Report Header -->
                    <div class="report-header">
                        <h2>Rekap Pembayaran SPP & Kehadiran Per Siswa</h2>
                        <h3>Study Center Gunung Sahari</h3>
                        <p>Jl. Gunung Sahari 4 No 6</p>
                    </div>
                    
                    <!-- Student Info -->
                    <table class="student-info">
                        <tr>
                            <td width="100">Nama</td>
                            <td width="10">:</td>
                            <td>{{ $reportData['student']->nama }}</td>
                            <td width="100" class="text-right">Tanggal :</td>
                            <td width="150" class="text-right">{{ now()->format('d-M-Y') }}</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>:</td>
                            <td>BATCH {{ $reportData['student']->studentDetail->batch ?? 'N/A' }}</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>NIS</td>
                            <td>:</td>
                            <td>{{ $reportData['student']->nip ?? 'N/A' }}</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Sekolah</td>
                            <td>:</td>
                            <td>{{ $reportData['student']->studentDetail->sekolah ?? 'N/A' }}</td>
                            <td colspan="2"></td>
                        </tr>
                    </table>

                    <!-- Attendance Table -->
                    <table class="attendance-table">
                        <thead>
                            <tr>
                                <th class="bln">Bln</th>
                                <th class="bin">Bin</th>
                                <th class="spp">SPP</th>
                                <th class="tagihan">Tagihan dari Sekolah</th>
                                <th class="hadir-reg">Hadir Reg</th>
                                <th class="hadir-css">Hadir CSS</th>
                                <th class="hadir-cgg">Hadir CGG</th>
                                <th class="percent">%</th>
                                <th class="empty"></th>
                                <th class="total-kel">Total Kel. Mendampingi</th>
                                <th class="isi-jurnal">Isi Jurnal</th>
                                <th class="izin">Izin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $reportData['month'] }}</td>
                                <td>BATCH {{ $reportData['student']->studentDetail->batch ?? 'N/A' }}</td>
                                <td class="text-right">{{ number_format($reportData['spp'], 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($reportData['tagihan'], 0, ',', '.') }}</td>
                                <td class="text-center">{{ $reportData['attendance']['regular'] }}</td>
                                <td class="text-center">{{ $reportData['attendance']['css'] }}</td>
                                <td class="text-center">{{ $reportData['attendance']['cgg'] }}</td>
                                <td class="text-center">{{ number_format($reportData['attendance_percentage'], 2) }}%</td>
                                <td></td>
                                <td class="text-center">{{ $reportData['spr_attendance'] }}</td>
                                <td class="text-center">{{ $reportData['journal_count'] }}</td>
                                <td class="text-center">{{ $reportData['permission_count'] }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Notes Section -->
                    <div class="notes-section">
                        <div class="notes-header">Catatan dari SCGS:</div>
                        <div class="notes-content">
                            {{ $reportData['notes'] ?? '' }}
                        </div>
                    </div>

                    <!-- Payment Summary -->
                    <table class="payment-summary">
                        <tr>
                            <td width="200">Tagihan dari Sekolah</td>
                            <td width="150" class="text-right">{{ number_format($reportData['tagihan'], 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Pembayaran dari SCGS</td>
                            <td class="text-right">{{ number_format($reportData['spp'], 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Sisa Pembayaran</td>
                            <td class="text-right">{{ number_format($reportData['sisa'], 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                        <tr class="payment-status">
                            <td>Total Sisa Pembayaran (Rp)</td>
                            <td class="text-right">{{ number_format($reportData['sisa'], 0, ',', '.') }}</td>
                            <td class="status-cell">
                                @if($reportData['sisa'] <= 0)
                                    <span class="status-lunas">LUNAS</span>
                                @else
                                    <span class="status-sisa">SISA YANG HARUS DIBAYAR OLEH ORANG TUA</span>
                                @endif
                            </td>
                        </tr>
                    </table>

                    <!-- Payment Details -->
                    <h4 class="payment-details-title">Rincian Pembayaran</h4>
                    <table class="payment-details">
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
                                <td>{{ \Carbon\Carbon::now()->format('d-M-Y') }}</td>
                                <td class="text-right">{{ number_format($reportData['spp'], 0, ',', '.') }}</td>
                                <td>SPP</td>
                                <td>{{ $reportData['payment_note'] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
@stop

@section('css')
<style>
    /* Excel-like styling */
    .excel-report {
        background-color: white;
        padding: 20px;
        font-family: 'Calibri', 'Arial', sans-serif;
        color: #333;
    }
    
    .report-header {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .report-header h2, .report-header h3 {
        margin: 5px 0;
    }
    
    .report-header p {
        margin: 5px 0;
        font-size: 14px;
    }
    
    .student-info {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }
    
    .student-info td {
        padding: 5px;
        font-size: 14px;
    }
    
    .attendance-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    
    .attendance-table th, .attendance-table td {
        border: 1px solid #ddd;
        padding: 8px;
        font-size: 14px;
    }
    
    .attendance-table thead th {
        text-align: center;
        background-color: #f2f2f2;
        font-weight: bold;
    }
    
    /* Column color styling */
    .bln, .bin { background-color: #f2f2f2; }
    .spp, .tagihan { background-color: #f2f2f2; }
    .hadir-reg { background-color: #a7ffa7; }
    .hadir-css { background-color: #7aff7a; }
    .hadir-cgg { background-color: #93e9be; }
    .percent { background-color: #9bd1fa; }
    .total-kel { background-color: #fffd9b; }
    .isi-jurnal { background-color: #ff9999; }
    .izin { background-color: #ff7373; }
    
    .notes-section {
        margin-bottom: 20px;
    }
    
    .notes-header {
        padding: 5px;
        background-color: #00ffff;
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    .notes-content {
        min-height: 80px;
        border: 2px solid #ff00ff;
        padding: 10px;
    }
    
    .payment-summary {
        width: 100%;
        margin-bottom: 20px;
    }
    
    .payment-summary td {
        padding: 5px;
        font-size: 14px;
    }
    
    .payment-status .status-cell {
        padding: 5px;
    }
    
    .status-lunas {
        display: block;
        background-color: #4CAF50;
        color: white;
        padding: 5px 10px;
        text-align: center;
        font-weight: bold;
    }
    
    .status-sisa {
        display: block;
        background-color: #ff9999;
        padding: 5px 10px;
        text-align: center;
        font-weight: bold;
    }
    
    .payment-details-title {
        font-weight: bold;
        margin-top: 15px;
        margin-bottom: 10px;
    }
    
    .payment-details {
        width: 50%;
        border-collapse: collapse;
    }
    
    .payment-details th, .payment-details td {
        border: 1px solid #ddd;
        padding: 8px;
        font-size: 14px;
    }
    
    .payment-details th {
        background-color: #f2f2f2;
        font-weight: bold;
        text-align: center;
    }
    
    .text-right {
        text-align: right;
    }
    
    .text-center {
        text-align: center;
    }
    
    /* Select2 styling */
    .select2-container {
        min-width: 250px;
    }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2();
    });
</script>
@stop
