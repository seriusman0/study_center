@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Journal Entry</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('student.journals.update', $journal->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-check">
            <input type="hidden" name="mengawali_hari_dengan_berdoa" value="0">
            <input class="form-check-input" type="checkbox" name="mengawali_hari_dengan_berdoa" id="mengawali_hari_dengan_berdoa" value="1" {{ $journal->mengawali_hari_dengan_berdoa ? 'checked' : '' }}>
            <label class="form-check-label" for="mengawali_hari_dengan_berdoa">Mengawali Hari dengan Berdoa</label>
        </div>

        <div class="form-check">
            <input type="hidden" name="baca_alkitab_pl" value="0">
            <input class="form-check-input" type="checkbox" name="baca_alkitab_pl" id="baca_alkitab_pl" value="1" {{ $journal->baca_alkitab_pl ? 'checked' : '' }}>
            <label class="form-check-label" for="baca_alkitab_pl">Baca Alkitab PL</label>
        </div>

        <div class="form-check">
            <input type="hidden" name="baca_alkitab_pb" value="0">
            <input class="form-check-input" type="checkbox" name="baca_alkitab_pb" id="baca_alkitab_pb" value="1" {{ $journal->baca_alkitab_pb ? 'checked' : '' }}>
            <label class="form-check-label" for="baca_alkitab_pb">Baca Alkitab PB</label>
        </div>

        <div class="form-check">
            <input type="hidden" name="hadir_kelas_sc" value="0">
            <input class="form-check-input" type="checkbox" name="hadir_kelas_sc" id="hadir_kelas_sc" value="1" {{ $journal->hadir_kelas_sc ? 'checked' : '' }}>
            <label class="form-check-label" for="hadir_kelas_sc">Hadir Kelas SC</label>
        </div>

        <div class="form-check">
            <input type="hidden" name="hadir_css" value="0">
            <input class="form-check-input" type="checkbox" name="hadir_css" id="hadir_css" value="1" {{ $journal->hadir_css ? 'checked' : '' }}>
            <label class="form-check-label" for="hadir_css">Hadir CSS</label>
        </div>

        <div class="form-check">
            <input type="hidden" name="hadir_cgg" value="0">
            <input class="form-check-input" type="checkbox" name="hadir_cgg" id="hadir_cgg" value="1" {{ $journal->hadir_cgg ? 'checked' : '' }}>
            <label class="form-check-label" for="hadir_cgg">Hadir CGG</label>
        </div>

        <div class="form-check">
            <input type="hidden" name="merapikan_tempat_tidur" value="0">
            <input class="form-check-input" type="checkbox" name="merapikan_tempat_tidur" id="merapikan_tempat_tidur" value="1" {{ $journal->merapikan_tempat_tidur ? 'checked' : '' }}>
            <label class="form-check-label" for="merapikan_tempat_tidur">Merapikan Tempat Tidur</label>
        </div>

        <div class="form-check">
            <input type="hidden" name="menyapa_orang_tua" value="0">
            <input class="form-check-input" type="checkbox" name="menyapa_orang_tua" id="menyapa_orang_tua" value="1" {{ $journal->menyapa_orang_tua ? 'checked' : '' }}>
            <label class="form-check-label" for="menyapa_orang_tua">Menyapa Orang Tua</label>
        </div>

        <div class="mb-3">
            <label for="selfie_image" class="form-label">Selfie Image</label>
            <input class="form-control" type="file" id="selfie_image" name="selfie_image" accept="image/*">
            @if ($journal->selfie_image)
                <img src="{{ asset('storage/' . $journal->selfie_image) }}" alt="Selfie Image" class="img-thumbnail mt-2" style="max-width: 200px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Journal</button>
        <a href="{{ route('student.journals.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
