@extends('admin.layout')

@section('title', 'Import Attendance')


@section('content')
<div class="container-fluid">
    <!-- Header buttons -->
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Import Attendance</h1>
        </div>
        <div class="col-sm-6">
            <div class="float-sm-right">
                <a href="{{ route('admin.attendance.template') }}" class="btn btn-success">
                    <i class="fas fa-download"></i> Download Template
                </a>
                <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Upload Attendance Data</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Success!</h5>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('import_errors'))
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Import Errors</h5>
                            <ul class="mb-0">
                                @foreach(session('import_errors') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.attendance.import.process') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Excel File</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('file') is-invalid @enderror" id="file" name="file" accept=".xlsx,.xls">
                                    <label class="custom-file-label" for="file">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-upload"></i> Upload and Process
                                    </button>
                                </div>
                            </div>
                            @error('file')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>

                    <div class="mt-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Import Instructions</h3>
                            </div>
                            <div class="card-body">
                                <h5>Steps to Import:</h5>
                                <ol>
                                    <li>Download the template file using the button above</li>
                                    <li>Fill in the attendance data following the template format</li>
                                    <li>Make sure all required fields are filled correctly</li>
                                    <li>Save the file and upload it using the form above</li>
                                    <li>The system will process the data and show the results</li>
                                </ol>

                                <h5 class="mt-4">Field Descriptions:</h5>
                                <ul class="mb-0">
                                    <li>Regular Attendance: Number of regular class attendances</li>
                                    <li>CSS Attendance: Number of CSS class attendances</li>
                                    <li>CGG Attendance: Number of CGG class attendances</li>
                                    <li>Journal Entry: Numeric value for journal entries</li>
                                    <li>Permission: Numeric value for permissions</li>
                                    <li>CGG Father/Mother/Sibling: Numeric values for SPR attendance</li>
                                </ul>

                                <div class="alert alert-info mt-4">
                                    <h5><i class="icon fas fa-info"></i> Important Notes:</h5>
                                    <ul class="mb-0">
                                        <li>All fields must contain numeric values</li>
                                        <li>Student ID must match with existing records</li>
                                        <li>Use 0 for no attendance/entry</li>
                                        <li>Maximum file size: 2MB</li>
                                        <li>Supported formats: .xlsx, .xls</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@endsection

@section('js')
<script>
$(function () {
    bsCustomFileInput.init();
});
</script>
@endsection
