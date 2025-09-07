@extends('admin.layout')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">All Permission Requests</h3>
                    <div>
                        <a href="{{ route('admin.permissions.export.previous') }}" class="btn btn-info mr-2">
                            <i class="fas fa-file-excel mr-1"></i> Download Laporan Bulan Lalu
                        </a>
                        <a href="{{ route('admin.permissions.export') }}" class="btn btn-success mr-2">
                            <i class="fas fa-file-excel mr-1"></i> Download Laporan Bulan Ini
                        </a>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#customMonthModal">
                            <i class="fas fa-calendar-alt mr-1"></i> Pilih Bulan Lain
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Student Name</th>
                                    <th>NIP</th>
                                    <th>Class Type</th>
                                    <th>Status</th>
                                    <th>Submitted</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($requests as $request)
                                    <tr>
                                        <td>{{ $request->date->format('d M Y') }}</td>
                                        <td>{{ $request->user->nama }}</td>
                                        <td>{{ $request->user->nip }}</td>
                                        <td><span class="text-uppercase">{{ $request->class_type }}</span></td>
                                        <td>
                                            <span class="badge badge-{{ $request->status_badge }}">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $request->created_at->format('d M Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('admin.permissions.show', $request) }}" 
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No permission requests found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $requests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
</div>

<!-- Custom Month Modal -->
<div class="modal fade" id="customMonthModal" tabindex="-1" role="dialog" aria-labelledby="customMonthModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customMonthModalLabel">Pilih Bulan dan Tahun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.permissions.export.custom') }}" method="GET">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="month">Bulan</label>
                        <select class="form-control" id="month" name="month" required>
                            @php
                                $currentMonth = now()->month;
                            @endphp
                            <option value="1" {{ $currentMonth == 1 ? 'selected' : '' }}>Januari</option>
                            <option value="2" {{ $currentMonth == 2 ? 'selected' : '' }}>Februari</option>
                            <option value="3" {{ $currentMonth == 3 ? 'selected' : '' }}>Maret</option>
                            <option value="4" {{ $currentMonth == 4 ? 'selected' : '' }}>April</option>
                            <option value="5" {{ $currentMonth == 5 ? 'selected' : '' }}>Mei</option>
                            <option value="6" {{ $currentMonth == 6 ? 'selected' : '' }}>Juni</option>
                            <option value="7" {{ $currentMonth == 7 ? 'selected' : '' }}>Juli</option>
                            <option value="8" {{ $currentMonth == 8 ? 'selected' : '' }}>Agustus</option>
                            <option value="9" {{ $currentMonth == 9 ? 'selected' : '' }}>September</option>
                            <option value="10" {{ $currentMonth == 10 ? 'selected' : '' }}>Oktober</option>
                            <option value="11" {{ $currentMonth == 11 ? 'selected' : '' }}>November</option>
                            <option value="12" {{ $currentMonth == 12 ? 'selected' : '' }}>Desember</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year">Tahun</label>
                        <select class="form-control" id="year" name="year" required>
                            @php
                                $currentYear = now()->year;
                                $startYear = 2023; // Adjust this to your needs
                            @endphp
                            @for ($year = $currentYear; $year >= $startYear; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-download mr-1"></i> Download Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
