@extends('admin.layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Permission Request Details</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <!-- Permission Request Details -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Request Information</h3>
                            <div class="card-tools">
                                <span class="badge badge-{{ $permission->status_badge }} px-3 py-2">
                                    {{ ucfirst($permission->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th style="width: 150px">Student Name:</th>
                                            <td>{{ $permission->user->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>NIP:</th>
                                            <td>{{ $permission->user->nip }}</td>
                                        </tr>
                                        <tr>
                                            <th>School:</th>
                                            <td>{{ $permission->user->studentDetail->sekolah ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Class Level:</th>
                                            <td>{{ $permission->user->studentDetail->tingkat_kelas ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th style="width: 150px">Class Type:</th>
                                            <td class="text-uppercase">{{ $permission->class_type }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date:</th>
                                            <td>{{ $permission->date->format('l, d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Submitted:</th>
                                            <td>{{ $permission->created_at->format('d M Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5>Reason</h5>
                                <p>{{ $permission->reason }}</p>
                            </div>

                            @if($permission->attachment)
                                <div class="mt-4">
                                    <h5>Supporting Document</h5>
                                    <a href="{{ Storage::url($permission->attachment) }}" 
                                       class="btn btn-sm btn-primary" 
                                       target="_blank">
                                        <i class="fas fa-file-download"></i> View Document
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Update Status -->
                    @if($permission->status === 'pending')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Update Status</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="mt-2">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" 
                                                       id="status_approved" 
                                                       name="status" 
                                                       value="approved" 
                                                       class="custom-control-input"
                                                       required>
                                                <label class="custom-control-label" for="status_approved">
                                                    Approve
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" 
                                                       id="status_rejected" 
                                                       name="status" 
                                                       value="rejected" 
                                                       class="custom-control-input"
                                                       required>
                                                <label class="custom-control-label" for="status_rejected">
                                                    Reject
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="admin_notes">Notes</label>
                                        <textarea class="form-control" 
                                                  id="admin_notes" 
                                                  name="admin_notes" 
                                                  rows="3"
                                                  placeholder="Add any notes about your decision">{{ old('admin_notes') }}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        Update Status
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Admin Response</h3>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-{{ $permission->status_badge }}">
                                    Request was {{ $permission->status }} 
                                    on {{ $permission->updated_at->format('d M Y H:i') }}
                                </div>
                                @if($permission->admin_notes)
                                    <h5>Notes:</h5>
                                    <p>{{ $permission->admin_notes }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
