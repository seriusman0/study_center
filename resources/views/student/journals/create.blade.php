@extends('layouts.student')

@section('title', 'Buat Entri Jurnal | Pusat Studi')

@section('content')
    <div class="row gx-4 gx-lg-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Buat Entri Jurnal</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('student.journals.store') }}" method="POST" enctype="multipart/form-data" id="journalForm">
                        @csrf
                        
                        <!-- KEROHANIAN Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">KEROHANIAN</h5>
                            </div>
                            <div class="card-body">
                                <!-- Mengawali Hari dengan Berdoa -->
                                <div class="mb-3">
                                    <label class="form-label d-block">MENGAWALI HARI DENGAN BERDOA *</label>
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="mengawali_hari_dengan_berdoa" id="berdoa_ya" value="1" {{ old('mengawali_hari_dengan_berdoa') == '1' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-primary" for="berdoa_ya">YA</label>
                                        <input type="radio" class="btn-check" name="mengawali_hari_dengan_berdoa" id="berdoa_tidak" value="0" {{ old('mengawali_hari_dengan_berdoa') == '0' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="berdoa_tidak">TIDAK</label>
                                    </div>
                                </div>

                                <!-- Baca Alkitab PL -->
                                <div class="mb-3">
                                    <label class="form-label d-block">BACA ALKITAB (SESUAI JADWAL PL) *</label>
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="baca_alkitab_pl" id="alkitab_pl_ya" value="1" {{ old('baca_alkitab_pl') == '1' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-primary" for="alkitab_pl_ya">YA</label>
                                        <input type="radio" class="btn-check" name="baca_alkitab_pl" id="alkitab_pl_tidak" value="0" {{ old('baca_alkitab_pl') == '0' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="alkitab_pl_tidak">TIDAK</label>
                                    </div>
                                </div>

                                <!-- Baca Alkitab PB -->
                                <div class="mb-3">
                                    <label class="form-label d-block">BACA ALKITAB (SESUAI JADWAL PB) *</label>
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="baca_alkitab_pb" id="alkitab_pb_ya" value="1" {{ old('baca_alkitab_pb') == '1' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-primary" for="alkitab_pb_ya">YA</label>
                                        <input type="radio" class="btn-check" name="baca_alkitab_pb" id="alkitab_pb_tidak" value="0" {{ old('baca_alkitab_pb') == '0' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="alkitab_pb_tidak">TIDAK</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PENDIDIKAN Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">PENDIDIKAN</h5>
                                <small class="text-muted">Klik dimana hari anda mengikuti kegiatan</small>
                            </div>
                            <div class="card-body">
                                <!-- Hadir Kelas SC -->
                                <div class="mb-3">
                                    <label class="form-label d-block">HADIR KELAS SC *</label>
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="hadir_kelas_sc" id="sc_ya" value="1" {{ old('hadir_kelas_sc') == '1' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-primary" for="sc_ya">YA</label>
                                        <input type="radio" class="btn-check" name="hadir_kelas_sc" id="sc_tidak" value="0" {{ old('hadir_kelas_sc') == '0' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="sc_tidak">TIDAK</label>
                                    </div>
                                </div>

                                <!-- Hadir CSS -->
                                <div class="mb-3">
                                    <label class="form-label d-block">HADIR CSS *</label>
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="hadir_css" id="css_ya" value="1" {{ old('hadir_css') == '1' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-primary" for="css_ya">YA</label>
                                        <input type="radio" class="btn-check" name="hadir_css" id="css_tidak" value="0" {{ old('hadir_css') == '0' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="css_tidak">TIDAK</label>
                                    </div>
                                </div>

                                <!-- Hadir CGG -->
                                <div class="mb-3">
                                    <label class="form-label d-block">HADIR CGG *</label>
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="hadir_cgg" id="cgg_ya" value="1" {{ old('hadir_cgg') == '1' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-primary" for="cgg_ya">YA</label>
                                        <input type="radio" class="btn-check" name="hadir_cgg" id="cgg_tidak" value="0" {{ old('hadir_cgg') == '0' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="cgg_tidak">TIDAK</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- KARAKTER Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">KARAKTER</h5>
                            </div>
                            <div class="card-body">
                                <!-- Merapikan Tempat Tidur -->
                                <div class="mb-3">
                                    <label class="form-label d-block">MERAPIKAN TEMPAT TIDUR *</label>
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="merapikan_tempat_tidur" id="rapikan_ya" value="1" {{ old('merapikan_tempat_tidur') == '1' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-primary" for="rapikan_ya">YA</label>
                                        <input type="radio" class="btn-check" name="merapikan_tempat_tidur" id="rapikan_tidak" value="0" {{ old('merapikan_tempat_tidur') == '0' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="rapikan_tidak">TIDAK</label>
                                    </div>
                                </div>

                                <!-- Menyapa Orang Tua -->
                                <div class="mb-3">
                                    <label class="form-label d-block">MENYAPA ORANG TUA / GURU / KAKAK *</label>
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="menyapa_orang_tua" id="sapa_ya" value="1" {{ old('menyapa_orang_tua') == '1' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-primary" for="sapa_ya">YA</label>
                                        <input type="radio" class="btn-check" name="menyapa_orang_tua" id="sapa_tidak" value="0" {{ old('menyapa_orang_tua') == '0' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="sapa_tidak">TIDAK</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Selfie with Parents -->
                        <div class="mb-4">
                            <label class="form-label">Selfie dengan Orang Tua *</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- File Upload -->
                                    <div class="mb-3">
                                        <input type="file" name="selfie_image" id="selfie_image" class="form-control @error('selfie_image') is-invalid @enderror" accept="image/*" capture="user">
                                        @error('selfie_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Camera Capture -->
                                    <button type="button" class="btn btn-secondary" id="openCamera">
                                        <i class="fas fa-camera"></i> Ambil Foto
                                    </button>
                                </div>
                            </div>
                            <!-- Preview -->
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <img id="preview" src="#" alt="Preview" style="max-width: 300px; max-height: 300px;" class="img-thumbnail">
                            </div>
                        </div>

                        <!-- Camera Modal -->
                        <div class="modal fade" id="cameraModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Ambil Foto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <video id="video" width="100%" autoplay></video>
                                        <canvas id="canvas" style="display:none;"></canvas>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="button" class="btn btn-primary" id="capture">Ambil</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Kirim Jurnal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
