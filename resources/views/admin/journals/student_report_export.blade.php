<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Pembayaran SPP & Kehadiran - {{ $user->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 14px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header-text {
            flex: 1;
        }
        .logo {
            max-width: 120px;
            max-height: 80px;
        }
        h1, h2, h3 {
            margin: 0;
            padding: 0;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        h2 {
            font-size: 18px;
            color: #666;
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .bg-info {
            background-color: #17a2b8;
            color: white;
        }
        .bg-warning {
            background-color: #ffc107;
        }
        .bg-danger {
            background-color: #dc3545;
            color: white;
        }
        .bg-success {
            background-color: #28a745;
            color: white;
        }
        .note-box {
            border: 2px solid #e83e8c;
            padding: 15px;
            margin-bottom: 20px;
            min-height: 80px;
        }
        .note-header {
            background-color: #17a2b8;
            color: white;
            padding: 8px;
            margin-bottom: 0;
        }
        .student-info {
            margin-bottom: 20px;
        }
        .student-info div {
            margin-bottom: 5px;
        }
        .label {
            font-weight: bold;
            display: inline-block;
            width: 120px;
        }
        .value {
            display: inline-block;
        }
        @media print {
            body {
                padding: 0;
                margin: 15mm 15mm 15mm 15mm;
            }
            .no-print {
                display: none;
            }
            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print();" style="padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer;">
            Print Report
        </button>
        <button onclick="window.history.back();" style="padding: 10px 20px; background: #6c757d; color: white; border: none; cursor: pointer; margin-left: 10px;">
            Back
        </button>
    </div>

    <div class="header">
        <div class="header-text">
            <h1>Rekap Pembayaran SPP & Kehadiran Per Siswa</h1>
            <h2>Study Center Gunung Sahari</h2>
            <p>Jl. Gunung Sahari 4 No 6</p>
        </div>
        <div>
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="logo">
        </div>
    </div>

    <div class="student-info">
        <div>
            <span class="label">Nama</span>
            <span class="value">: {{ $user->nama }}</span>
        </div>
        <div>
            <span class="label">Kelas</span>
            <span class="value">: BATCH {{ $user->studentDetail->batch ?? 'N/A' }}</span>
        </div>
        <div>
            <span class="label">NIS</span>
            <span class="value">: {{ $user->nip ?? 'N/A' }}</span>
        </div>
        <div>
            <span class="label">Sekolah</span>
            <span class="value">: {{ $user->studentDetail->sekolah ?? 'N/A' }}</span>
        </div>
        <div style="text-align: right;">
            <span style="font-weight: bold;">Tanggal:</span> {{ now()->format('d-M-Y') }}
        </div>
    </div>

    <!-- Attendance Table -->
    <table>
        <thead>
            <tr>
                <th rowspan="2" class="text-center">Bulan</th>
                <th rowspan="2" class="text-center">BIn</th>
                <th rowspan="2" class="text-center">SPP</th>
                <th colspan="7" class="text-center bg-info">Kehadiran di bulan {{ $reportData['bulan'] }} {{ $reportData['tahun'] }}</th>
            </tr>
            <tr>
                <th class="text-center bg-info">Hadir Reg</th>
                <th class="text-center bg-info">Hadir CSS</th>
                <th class="text-center bg-info">Hadir CGG</th>
                <th class="text-center bg-info">%</th>
                <th class="text-center bg-warning">Total Kel. Mendampingi</th>
                <th class="text-center bg-danger">Isi Jurnal</th>
                <th class="text-center bg-success">Izin</th>
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

    <!-- Notes Section -->
    <h3 class="note-header">Catatan dari SCGS:</h3>
    <div class="note-box">
        {{ $reportData['catatan'] }}
    </div>

    <!-- Payment Summary -->
    <table>
        <tbody>
            <tr>
                <td style="font-weight: bold;">Tagihan dari Sekolah</td>
                <td class="text-right">{{ number_format($reportData['tagihan_sekolah'], 0, ',', '.') }}</td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Pembayaran dari SCGS</td>
                <td class="text-right">{{ number_format($reportData['pembayaran_scgs'], 0, ',', '.') }}</td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Sisa Pembayaran</td>
                <td class="text-right">{{ number_format($reportData['sisa_pembayaran'], 0, ',', '.') }}</td>
                <td colspan="2"></td>
            </tr>
            <tr class="bg-danger">
                <td colspan="4" class="text-center" style="font-weight: bold;">
                    SISA YANG HARUS DIBAYAR OLEH ORANG TUA
                </td>
            </tr>
            <tr>
                <td colspan="4" class="text-right" style="font-weight: bold;">
                    {{ number_format($reportData['sisa_pembayaran'], 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Payment Details -->
    <h3>Rincian Pembayaran</h3>
    <table>
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
</body>
</html>
