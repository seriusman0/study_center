@extends('admin.layout')

@section('title', 'Dashboard Admin | Study Center')

@section('content')
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Siswa</span>
                    <span class="info-box-number">{{ $totalUsers }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-clipboard-list"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Permintaan Izin Menunggu</span>
                    <span class="info-box-number">{{ $pendingPermissions }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Jurnal Terkirim</span>
                    <span class="info-box-number">{{ $totalJournals }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- Permintaan Izin Terbaru -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Permintaan Izin Terbaru</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-sm btn-primary">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th>Tanggal</th>
                                    <th>Tipe Kelas</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentPermissions as $permission)
                                <tr>
                                    <td>{{ $permission->user->nama }}</td>
                                    <td>{{ $permission->date->format('d/m/Y') }}</td>
                                    <td><span class="text-uppercase">{{ $permission->class_type }}</span></td>
                                    <td>
                                        <span class="badge bg-{{ $permission->status_badge }}">
                                            {{ ucfirst($permission->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.permissions.show', $permission->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada permintaan izin terbaru</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jurnal Terbaru -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Jurnal Terbaru Terkirim</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.journals.index') }}" class="btn btn-sm btn-primary">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th>Tanggal Entri</th>
                                    <th>Tanggal Kirim</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentJournals as $journal)
                                <tr>
                                    <td>{{ $journal->user->nama }}</td>
                                    <td>{{ $journal->entry_date->format('d/m/Y') }}</td>
                                    <td>{{ $journal->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.journals.show', $journal->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada jurnal terbaru</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- Ringkasan Sistem -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Penting</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h5><i class="icon fas fa-info"></i> Selamat Datang di Dashboard Admin!</h5>
                        <p>Dari sini Anda dapat mengelola semua aspek Study Center. Gunakan menu di sidebar untuk navigasi ke berbagai fitur pengelolaan.</p>
                    </div>
                    
                    @if($pendingPermissions > 0)
                    <div class="alert alert-warning">
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Permintaan Izin Menunggu!</h5>
                        <p>Ada {{ $pendingPermissions }} permintaan izin yang menunggu persetujuan Anda. Silakan tinjau segera.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection