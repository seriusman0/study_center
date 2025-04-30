@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Bulk Import Students</h3>
                </div>
                <div class="card-body">
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

                    @if(session('import_errors'))
                        <div class="alert alert-warning">
                            <h5>Import Errors:</h5>
                            <ul>
                                @foreach(session('import_errors') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <a href="{{ route('admin.students.bulk-import.template') }}" class="btn btn-primary">
                                <i class="fas fa-download"></i> Download Template
                            </a>
                        </div>
                    </div>

                    <form action="{{ route('admin.students.bulk-import.process') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Select Excel File</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file" required accept=".xlsx,.xls">
                                <label class="custom-file-label" for="file">Choose file</label>
                            </div>
                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-upload"></i> Import Students
                            </button>
                        </div>
                    </form>

                    <div class="mt-4">
                        <h5>Instructions:</h5>
                        <ol>
                            <li>Download the template using the button above</li>
                            <li>Fill in the required information in the Excel file</li>
                            <li>Required fields are marked with an asterisk (*)</li>
                            <li>Make sure Batch ID and Class ID are valid in the system</li>
                            <li>Upload the filled template using the form above</li>
                            <li>Review any errors or warnings after upload</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Update file input label with selected filename
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endpush
@endsection
