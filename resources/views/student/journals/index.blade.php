@extends('layouts.student')

@section('title', 'Jurnal Saya | Study Center')

@section('content')
    <!-- Pesan Sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <!-- Pesan Error -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <div class="row gx-4 gx-lg-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Entri Jurnal Saya</h4>
                    <a href="{{ route('student.journals.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Entri Baru
                    </a>
                </div>
                <div class="card-body">
                    @if($journals->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-3">Anda belum membuat entri jurnal apapun.</p>
                            <a href="{{ route('student.journals.create') }}" class="btn btn-primary">
                                Buat Entri Pertama Anda
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kegiatan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($journals as $journal)
                                        <tr>
                                            <td>{{ $journal->entry_date->format('d M Y') }}</td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <span class="badge bg-{{ $journal->mengawali_hari_dengan_berdoa ? 'success' : 'danger' }}" title="Berdoa">
                                                        <i class="fas fa-pray"></i>
                                                    </span>
                                                    <span class="badge bg-{{ $journal->baca_alkitab_pl && $journal->baca_alkitab_pb ? 'success' : 'danger' }}" title="Baca Alkitab">
                                                        <i class="fas fa-book"></i>
                                                    </span>
                                                    <span class="badge bg-{{ $journal->hadir_kelas_sc ? 'success' : 'danger' }}" title="SC">
                                                        SC
                                                    </span>
                                                    <span class="badge bg-{{ $journal->hadir_css ? 'success' : 'danger' }}" title="CSS">
                                                        CSS
                                                    </span>
                                                    <span class="badge bg-{{ $journal->hadir_cgg ? 'success' : 'danger' }}" title="CGG">
                                                        CGG
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                @if($journal->is_submitted)
                                                    <span class="badge bg-success">Dikirim</span>
                                                @else
                                                    <span class="badge bg-warning">Draf</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('student.journals.show', $journal) }}" 
                                                   class="btn btn-sm btn-info" title="Lihat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('student.journals.edit', $journal) }}" 
                                                   class="btn btn-sm btn-warning" title="Ubah">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('student.journals.destroy', $journal) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus entri jurnal ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $journals->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
