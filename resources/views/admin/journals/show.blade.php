@extends('admin.layout')

@section('title', 'Student Journals')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Journals for {{ $user->nama }}</h1>

    <a href="{{ route('admin.journals.index') }}" class="btn btn-secondary mb-3">Back to Journal List</a>

    @if($journals->count() > 0)
        <div class="list-group">
            @foreach($journals as $journal)
                <div class="list-group-item mb-3">
                    <h5>Entry Date: {{ $journal->entry_date ? $journal->entry_date->format('Y-m-d') : 'N/A' }}</h5>
                    <p><strong>Submitted:</strong> {{ $journal->is_submitted ? 'Yes' : 'No' }}</p>
                    <p><strong>Selfie Image:</strong></p>
                    @if($journal->selfie_image)
                        <img src="{{ asset('storage/' . $journal->selfie_image) }}" alt="Selfie Image" class="img-thumbnail" style="max-width: 300px;">
                    @else
                        <p>No selfie image available.</p>
                    @endif
                    <hr>
                    <p><strong>KEROHANIAN</strong></p>
                    <ul>
                        <li>Mengawali Hari dengan Berdoa: {{ $journal->mengawali_hari_dengan_berdoa ? 'Ya' : 'Tidak' }}</li>
                        <li>Baca Alkitab PL: {{ $journal->baca_alkitab_pl ? 'Ya' : 'Tidak' }}</li>
                        <li>Baca Alkitab PB: {{ $journal->baca_alkitab_pb ? 'Ya' : 'Tidak' }}</li>
                    </ul>
                    <p><strong>PENDIDIKAN</strong></p>
                    <ul>
                        <li>Hadir Kelas SC: {{ $journal->hadir_kelas_sc ? 'Ya' : 'Tidak' }}</li>
                        <li>Hadir CSS: {{ $journal->hadir_css ? 'Ya' : 'Tidak' }}</li>
                        <li>Hadir CGG: {{ $journal->hadir_cgg ? 'Ya' : 'Tidak' }}</li>
                    </ul>
                    <p><strong>KARAKTER</strong></p>
                    <ul>
                        <li>Merapikan Tempat Tidur: {{ $journal->merapikan_tempat_tidur ? 'Ya' : 'Tidak' }}</li>
                        <li>Menyapa Orang Tua / Guru / Kakak: {{ $journal->menyapa_orang_tua ? 'Ya' : 'Tidak' }}</li>
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="mt-3">
            {{ $journals->links() }}
        </div>
    @else
        <p>No journal entries found for this student.</p>
    @endif
</div>
@endsection
