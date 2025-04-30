@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Manajemen Beasiswa SCGS</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- Add your content here -->
                    

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Beasiswa Siswa</h3>
                    <div class="card-tools">
                        <form action="{{ route('admin.scholarships.import') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                            @csrf
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="excelFile" name="file" accept=".xlsx,.xls">
                                    <label class="custom-file-label" for="excelFile">Pilih file Excel</label>
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('admin.scholarships.export') }}" class="btn btn-success ml-2">
                            <i class="fas fa-download"></i> Export
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Sekolah</th>
                                    <th>SPP</th>
                                    <th>Kehadiran</th>
                                    <th>Status SPR</th>
                                    <th>Beasiswa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->nip }}</td>
                                    <td>{{ $student->nama }}</td>
                                    <td>{{ $student->kelas }}</td>
                                    <td>{{ optional($student->studentDetail)->sekolah }}</td>
                                    <td>Rp {{ number_format(optional($student->studentDetail)->spp, 0, ',', '.') }}</td>
                                    <td>
                                        @if($student->attendanceRecord)
                                            {{ number_format($student->attendanceRecord->attendance_percentage, 1) }}%
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($student->scholarship)
                                            @php
                                                $sprCount = collect([
                                                    $student->scholarship->father_spr_submitted,
                                                    $student->scholarship->mother_spr_submitted,
                                                    $student->scholarship->sibling_spr_submitted
                                                ])->filter()->count();
                                            @endphp
                                            {{ $sprCount }}/3
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($student->scholarship)
                                            Rp {{ number_format($student->scholarship->scholarship_amount, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.scholarships.show', $student) }}" 
                                           class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </section>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize custom file input
        bsCustomFileInput.init();
    });
</script>
@endpush
