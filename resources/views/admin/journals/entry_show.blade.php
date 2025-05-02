@extends('admin.layout')

@section('title', 'View Journal Entry')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Journal Entry - {{ $journal->entry_date->format('d F Y') }}</h4>
                    <a href="{{ route('admin.journals.show', $journal->user_id) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Student Journals
                    </a>
                </div>
                <div class="card-body">
                    @include('journals._journal_detail', ['journal' => $journal])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
