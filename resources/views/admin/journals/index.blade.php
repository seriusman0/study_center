@extends('admin.layout')

@section('title', 'Journal Entries')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Journal Entries</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Students and Their Latest Journals</h3>
        </div>
        <div class="card-body">
            @if($students->count() > 0)
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                    <th>Student Name</th>
                    <th>Latest Journals</th>
                    <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student->nama }}</td>
                                <td>
                                    @if($student->journals->count() > 0)
                                        <ul>
                                            @foreach($student->journals as $journal)
                                                <li>
                                                    <a href="{{ route('admin.journals.show', $student->id) }}">
                                                        {{ $journal->entry_date->format('Y-m-d') ?? 'Date N/A' }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        No journals submitted
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.journals.show', $student->id) }}" class="btn btn-primary btn-sm">View Journals</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $students->links() }}
                </div>
            @else
                <p>No students found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
