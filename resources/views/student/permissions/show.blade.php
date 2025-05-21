@extends('layouts.student')

@section('title', 'Detail Permintaan Izin | Study Center')

@section('content')
    <div class="detail-container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Detail Permintaan Izin</h4>
                    <span class="badge bg-{{ $permission->status_badge }} status-badge">
                        {{ ucfirst($permission->status) }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Informasi Permintaan</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 150px">Jenis Kelas:</th>
                                <td class="text-uppercase">{{ $permission->class_type }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal:</th>
                                <td>{{ $permission->date->format('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Dikirim:</th>
                                <td>{{ $permission->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Informasi Siswa</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 150px">Nama:</th>
                                <td>{{ $permission->user->nama }}</td>
                            </tr>
                            <tr>
                                <th>NIP:</th>
                                <td>{{ $permission->user->nip }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mb-4">
                    <h5>Alasan</h5>
                    <p class="mb-0">{{ $permission->reason }}</p>
                </div>

                @if($permission->attachment)
                    <div class="mb-4">
                        <h5>Dokumen Pendukung</h5>
                        <a href="{{ Storage::url($permission->attachment) }}" 
                           class="btn btn-sm btn-primary" 
                           target="_blank">
                            <i class="fas fa-file-download"></i> Lihat Dokumen
                        </a>
                    </div>
                @endif

                @if($permission->admin_notes)
                    <div class="mb-4">
                        <h5>Catatan Admin</h5>
                        <p class="mb-0">{{ $permission->admin_notes }}</p>
                    </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('student.permissions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                    </a>
                    @if($permission->status === 'pending')
                        <form action="{{ route('student.permissions.destroy', $permission) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Apakah Anda yakin ingin membatalkan permintaan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-times"></i> Batalkan Permintaan
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
