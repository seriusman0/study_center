@extends('admin.layout')

@section('title', 'Preview Journal Report')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h1>Journal Report Preview - {{ $user->nama }}</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.journals.download', $user->id) }}" class="btn btn-success">
                <i class="fas fa-download"></i> Download Excel
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if($journals->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Konten</th>
                            <th>Status</th>
                            <th>Dibuat Pada</th>
                            <th>Diperbarui Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($journals as $journal)
                            <tr>
                                <td>{{ $journal->entry_date->format('Y-m-d') }}</td>
                                <td>{{ $journal->content }}</td>
                                <td>{{ $journal->is_submitted ? 'Submitted' : 'Draft' }}</td>
                                <td>{{ $journal->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $journal->updated_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No journal entries found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
