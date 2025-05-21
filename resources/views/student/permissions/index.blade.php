@extends('layouts.student')

@section('title', 'Permintaan Izin Saya | Study Center')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Permintaan Izin Saya</h4>
            <a href="{{ route('student.permissions.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Permintaan Baru
            </a>
        </div>
        <div class="card-body">
            @if($requests->isEmpty())
                <div class="text-center py-4">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Tidak ada permintaan izin ditemukan.</p>
                    <a href="{{ route('student.permissions.create') }}" class="btn btn-primary">
                        Buat Permintaan Baru
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jenis Kelas</th>
                                <th>Alasan</th>
                                <th>Status</th>
                                <th>Dikirim</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                                <tr>
                                    <td>{{ $request->date->format('d M Y') }}</td>
                                    <td>
                                        <span class="text-uppercase">{{ $request->class_type }}</span>
                                    </td>
                                    <td>{{ Str::limit($request->reason, 50) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $request->status_badge }}">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $request->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('student.permissions.show', $request) }}" 
                                           class="btn btn-sm btn-info" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($request->status === 'pending')
                                            <form action="{{ route('student.permissions.destroy', $request) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin membatalkan permintaan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Batalkan">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $requests->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
