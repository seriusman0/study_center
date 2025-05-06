<div>
     <!-- Overall Statistics Cards -->
     <div class="row mb-4">
    <!-- Total Students Card -->
    <div class="col-md-3">
        <div class="card bg-info">
            <div class="card-body text-white">
                <h5 class="card-title">Total Students</h5>
                <h2>{{ $overallStats['total_students'] }}</h2>
            </div>
        </div>
    </div>

    <!-- Average Journal Submission Card -->
    <div class="col-md-3">
        <div class="card bg-success">
            <div class="card-body text-white">
                <h5 class="card-title">Avg Journal Submission</h5>
                <h2>{{ number_format($overallStats['avg_journal_submission_rate'], 1) }}%</h2>
            </div>
        </div>
    </div>

    <!-- Average Attendance Rate Card -->
    <div class="col-md-3">
        <div class="card bg-primary">
            <div class="card-body text-white">
                <h5 class="card-title">Avg Attendance Rate</h5>
                <h2>{{ number_format($overallStats['avg_attendance_percentage'], 1) }}%</h2>
            </div>
        </div>
    </div>

    <!-- Students with Appreciation Card -->
    <div class="col-md-3">
        <div class="card bg-warning">
            <div class="card-body text-white">
                <h5 class="card-title">Students with Appreciation</h5>
                <h2>{{ $overallStats['total_with_appreciation'] }}</h2>
            </div>
        </div>
        </div>
    </div>

    <!-- Filter Controls -->
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Filter Options</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="classRange">Class Range:</label>
                        <select wire:model.live="classRange" class="form-control">
                            <option value="7-9">7-9</option>
                            <option value="10-12">10-12</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="totalClasses">Total Classes:</label>
                        <input type="number" wire:model.live="totalClasses" class="form-control" min="1" max="12">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="selectedPeriod">Periode:</label>
                        <select wire:model.live="selectedPeriod" class="form-control">
                            @foreach($periods as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

   

    <!-- Detailed Statistics Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Detailed Student Statistics</h3>
            <div>
                <a href="{{ route('admin.journals.download-all') }}" class="btn btn-success">
                    <i class="fas fa-download"></i> Export Report
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Class</th>
                            <th>SPP</th>
                            <th>Status</th>
                            <th>Pembayaran Final</th>
                            <th colspan="2" class="text-center bg-success text-white">Journal Statistics</th>
                            <th colspan="6" class="text-center bg-primary text-white">Attendance Statistics</th>
                            <th colspan="3" class="text-center bg-warning text-white">Permission Statistics</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <!-- Journal Headers -->
                            <th>Submitted</th>
                            <th>Rate</th>
                            <!-- Attendance Headers -->
                            <th>Regular</th>
                            <th>CSS</th>
                            <th>CGG</th>
                            <th>Total</th>
                            <th>Percentage</th>
                            <th>Total SPR</th>
                            <!-- Permission Headers -->
                            <th>Total</th>
                            <th>Approved</th>
                            <th>Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student['nama'] }}</td>
                                <td>{{ $student['kelas'] }}</td>
                                <td>{{ $student['spp'] }}</td>
                                <td>
                                    @if($student['has_appreciation'])
                                        <span class="badge bg-success">Apresiasi</span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>
                                <td class="d-flex align-items-center justify-content-between">
                                    <div>
                                        @if($student['final_payment'] !== null)
                                            {{ number_format($student['final_payment'], 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </div>
                                    <div class="ms-2">
                                        @if($student['payment_proof'])
                                            <a href="{{ asset('storage/' . $student['payment_proof']->file_path) }}" 
                                               target="_blank" 
                                               class="btn btn-sm btn-info" 
                                               title="View Payment Proof">
                                                <i class="{{ $student['payment_proof']->file_type === 'pdf' ? 'fas fa-file-pdf' : 'fas fa-file-image' }}"></i>
                                            </a>
                                        @endif
                                        <button wire:click="openUploadModal({{ $student['id'] }})" 
                                                class="btn btn-sm btn-primary" 
                                                title="Upload Payment Proof">
                                            <i class="fas fa-upload"></i>
                                        </button>
                                    </div>
                                </td>
                                <!-- Journal Data -->
                                <td>{{ $student['submitted_journals'] }}</td>
                                <td>{{ number_format($student['journal_submission_rate'], 1) }}%</td>
                                <!-- Attendance Data -->
                                <td>{{ $student['regular_attendance'] }}</td>
                                <td>{{ $student['css_attendance'] }}</td>
                                <td>{{ $student['cgg_attendance'] }}</td>
                                <td>{{ $student['total_attendance'] }}</td>
                                <td>{{ number_format($student['attendance_percentage'], 1) }}%</td>
                                <td>{{ $student['total_spr_attendance'] }}</td>
                                <!-- Permission Data -->
                                <td>{{ $student['total_permissions'] }}</td>
                                <td>{{ $student['approved_permissions'] }}</td>
                                <td>{{ number_format($student['permission_approval_rate'], 1) }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Upload Payment Proof Modal -->
    <div wire:ignore.self class="modal fade" id="uploadModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="uploadPaymentProof">
                    <div class="modal-header">
                        <h4 class="modal-title">Upload Payment Proof</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="paymentFile">Payment Proof File</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" 
                                           class="custom-file-input @error('paymentFile') is-invalid @enderror" 
                                           id="paymentFile"
                                           wire:model="paymentFile"
                                           accept=".jpg,.jpeg,.png,.pdf">
                                    <label class="custom-file-label" for="paymentFile">
                                        Choose file
                                    </label>
                                </div>
                            </div>
                            @error('paymentFile')
                                <span class="error invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted">Accepted formats: JPG, JPEG, PNG, PDF (max 2MB)</small>
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes (Optional)</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                    id="notes"
                                    wire:model.defer="notes" 
                                    rows="3"
                                    placeholder="Enter notes here..."></textarea>
                            @error('notes')
                                <span class="error invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(function () {
            // Initialize custom file input
            bsCustomFileInput.init();

            // Listen for open modal event
            window.Livewire.on('openModal', () => {
                $('#uploadModal').modal('show');
            });

            // Handle modal close events
            $('#uploadModal').on('hidden.bs.modal', function () {
                @this.closeUploadModal();
            });

            // Handle file selection
            $('#paymentFile').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName || 'Choose file');
            });
        });
    </script>
    @endpush

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
