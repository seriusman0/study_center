@extends('admin.layout')

@section('title', 'View Journal Entry')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Journal Entry - {{ $journal->entry_date->format('d F Y') }}</h4>
                    <a href="{{ route('admin.journals.show', $journal->user_id) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Student Journals
                    </a>
                </div>
                <div class="card-body">
                    <!-- Status Badge -->
                    <div class="mb-4">
                        @if($journal->is_submitted)
                            <span class="badge bg-success">Submitted</span>
                        @else
                            <span class="badge bg-warning">Draft</span>
                        @endif
                    </div>

                    <!-- KEROHANIAN Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">KEROHANIAN</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Mengawali Hari dengan Berdoa</th>
                                    <td><span class="badge bg-{{ $journal->mengawali_hari_dengan_berdoa ? 'success' : 'danger' }}">
                                        {{ $journal->mengawali_hari_dengan_berdoa ? 'YA' : 'TIDAK' }}
                                    </span></td>
                                </tr>
                                <tr>
                                    <th>Baca Alkitab (Sesuai Jadwal PL)</th>
                                    <td><span class="badge bg-{{ $journal->baca_alkitab_pl ? 'success' : 'danger' }}">
                                        {{ $journal->baca_alkitab_pl ? 'YA' : 'TIDAK' }}
                                    </span></td>
                                </tr>
                                <tr>
                                    <th>Baca Alkitab (Sesuai Jadwal PB)</th>
                                    <td><span class="badge bg-{{ $journal->baca_alkitab_pb ? 'success' : 'danger' }}">
                                        {{ $journal->baca_alkitab_pb ? 'YA' : 'TIDAK' }}
                                    </span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- PENDIDIKAN Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">PENDIDIKAN</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Hadir Kelas SC</th>
                                    <td><span class="badge bg-{{ $journal->hadir_kelas_sc ? 'success' : 'danger' }}">
                                        {{ $journal->hadir_kelas_sc ? 'YA' : 'TIDAK' }}
                                    </span></td>
                                </tr>
                                <tr>
                                    <th>Hadir CSS</th>
                                    <td><span class="badge bg-{{ $journal->hadir_css ? 'success' : 'danger' }}">
                                        {{ $journal->hadir_css ? 'YA' : 'TIDAK' }}
                                    </span></td>
                                </tr>
                                <tr>
                                    <th>Hadir CGG</th>
                                    <td><span class="badge bg-{{ $journal->hadir_cgg ? 'success' : 'danger' }}">
                                        {{ $journal->hadir_cgg ? 'YA' : 'TIDAK' }}
                                    </span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- KARAKTER Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">KARAKTER</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Merapikan Tempat Tidur</th>
                                    <td><span class="badge bg-{{ $journal->merapikan_tempat_tidur ? 'success' : 'danger' }}">
                                        {{ $journal->merapikan_tempat_tidur ? 'YA' : 'TIDAK' }}
                                    </span></td>
                                </tr>
                                <tr>
                                    <th>Menyapa Orang Tua / Guru / Kakak</th>
                                    <td><span class="badge bg-{{ $journal->menyapa_orang_tua ? 'success' : 'danger' }}">
                                        {{ $journal->menyapa_orang_tua ? 'YA' : 'TIDAK' }}
                                    </span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Selfie Image -->
                    <div class="mb-4">
                        <h5>Selfie with Parents</h5>
                        <img src="{{ Storage::url($journal->selfie_image) }}" 
                             alt="Selfie with Parents" 
                             class="img-fluid rounded" 
                             style="max-width: 400px;">
                    </div>

                    <!-- Submission Details -->
                    <div class="mt-4 pt-4 border-top">
                        <small class="text-muted">
                            Submitted on: {{ $journal->created_at->format('d F Y, H:i') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
