<div>
     <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Filter Controls -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">
                <i class="fas fa-filter mr-2"></i> Filter Options
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="classRange">
                            <i class="fas fa-graduation-cap mr-1"></i> Class Range:
                        </label>
                        <select wire:model.live="classRange" class="form-control" id="classRange">
                            <option value="7-9">7-9</option>
                            <option value="10-12">10-12</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="totalClasses">
                            <i class="fas fa-calendar-check mr-1"></i> Total Classes:
                        </label>
                        <input type="number" wire:model.live="totalClasses" class="form-control" min="1" max="12" id="totalClasses">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="selectedPeriod">
                            <i class="fas fa-calendar-alt mr-1"></i> Periode:
                        </label>
                        <select wire:model.live="selectedPeriod" class="form-control" id="selectedPeriod">
                            @foreach($periods as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overall Statistics Cards -->
    <div class="row mb-4">
        <!-- Total Students Card -->
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $overallStats['total_students'] }}</h3>
                    <p>Total Students</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <!-- Average Journal Submission Card -->
        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ number_format($overallStats['avg_journal_submission_rate'], 1) }}%</h3>
                    <p>Avg Journal Submission</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
            </div>
        </div>

        <!-- Average Attendance Rate Card -->
        <div class="col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ number_format($overallStats['avg_attendance_percentage'], 1) }}%</h3>
                    <p>Avg Attendance Rate</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
        </div>

        <!-- Students with Appreciation Card -->
        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $overallStats['total_with_appreciation'] }}</h3>
                    <p>Students with Appreciation</p>
                </div>
                <div class="icon">
                    <i class="fas fa-award"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Statistics Table -->
    <div class="card">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">
                <i class="fas fa-table mr-2"></i> Detailed Student Statistics
            </h3>
            
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="exportDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-file-export mr-1"></i> Export Data
                </button>
                <div class="dropdown-menu dropdown-menu-right p-3" style="width: 300px;" aria-labelledby="exportDropdown">
                    <h6 class="dropdown-header text-primary"><i class="fas fa-file-excel mr-1"></i> Export Options</h6>
                    <div class="form-group mt-2">
                        <label for="exportStudentSelect" class="font-weight-bold">Select Student:</label>
                        <select wire:model.live="exportStudentId" id="exportStudentSelect" class="form-control">
                            <option value="">-- All Students --</option>
                            @foreach($studentsForDropdown as $student)
                                <option value="{{ $student['id'] }}">{{ $student['nama'] }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">
                            Choose a specific student or export data for all students in the current filter
                        </small>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.journals.download-all') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-book mr-1"></i> Journal Report
                        </a>
                        <button wire:click="exportAttendancePayment" class="btn btn-primary btn-sm">
                            <i class="fas fa-file-invoice-dollar mr-1"></i> SPP & Kehadiran
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="bg-light">
                            <th class="align-middle" style="width: 15%">Student Name</th>
                            <th class="align-middle" style="width: 5%">Class</th>
                            <th class="align-middle" style="width: 8%">SPP</th>
                            <th class="align-middle" style="width: 7%">Status</th>
                            <th class="align-middle" style="width: 15%">Pembayaran Final</th>
                            <th colspan="2" class="text-center bg-success text-white">Journal</th>
                            <th colspan="6" class="text-center bg-primary text-white">Attendance</th>
                            <th colspan="3" class="text-center bg-warning text-white">Permission</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <!-- Journal Headers -->
                            <th class="bg-success text-white" style="opacity: 0.9">Submitted</th>
                            <th class="bg-success text-white" style="opacity: 0.9">Rate</th>
                            <!-- Attendance Headers -->
                            <th class="bg-primary text-white" style="opacity: 0.9">Regular</th>
                            <th class="bg-primary text-white" style="opacity: 0.9">CSS</th>
                            <th class="bg-primary text-white" style="opacity: 0.9">CGG</th>
                            <th class="bg-primary text-white" style="opacity: 0.9">Total</th>
                            <th class="bg-primary text-white" style="opacity: 0.9">%</th>
                            <th class="bg-primary text-white" style="opacity: 0.9">SPR</th>
                            <!-- Permission Headers -->
                            <th class="bg-warning text-white" style="opacity: 0.9">Total</th>
                            <th class="bg-warning text-white" style="opacity: 0.9">Approved</th>
                            <th class="bg-warning text-white" style="opacity: 0.9">Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td class="font-weight-bold">{{ $student['nama'] }}</td>
                                <td class="text-center">{{ $student['kelas'] }}</td>
                                <td>{{ $student['spp'] }}</td>
                                <td class="text-center">
                                    @if($student['has_appreciation'])
                                        <span class="badge bg-success">Apresiasi</span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            @if($student['final_payment'] !== null)
                                                <span class="font-weight-bold">Rp {{ number_format($student['final_payment'], 0, ',', '.') }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </div>
                                        <div class="ml-2 d-flex">
                                            @if($student['payment_proof'])
                                                <a href="{{ asset('storage/' . $student['payment_proof']->file_path) }}" 
                                                target="_blank" 
                                                class="btn btn-sm btn-info mr-1" 
                                                title="View Payment Proof">
                                                    <i class="{{ $student['payment_proof']->file_type === 'pdf' ? 'fas fa-file-pdf' : 'fas fa-file-image' }}"></i>
                                                </a>
                                            @endif
                                            <button wire:click="openUploadModal({{ $student['id'] }})" 
                                                    class="btn btn-sm btn-primary mr-1" 
                                                    title="Upload Payment Proof">
                                                <i class="fas fa-upload"></i>
                                            </button>
                                            <button wire:click="exportStudentAttendancePayment({{ $student['id'] }})" 
                                                    class="btn btn-sm btn-success" 
                                                    title="Export SPP & Kehadiran">
                                                <i class="fas fa-file-excel"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <!-- Journal Data -->
                                <td class="text-center">{{ $student['submitted_journals'] }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $student['journal_submission_rate'] >= 100 ? 'bg-success' : 'bg-warning' }} p-2">
                                        {{ number_format($student['journal_submission_rate'], 1) }}%
                                    </span>
                                </td>
                                <!-- Attendance Data -->
                                <td class="text-center">{{ $student['regular_attendance'] }}</td>
                                <td class="text-center">{{ $student['css_attendance'] }}</td>
                                <td class="text-center">{{ $student['cgg_attendance'] }}</td>
                                <td class="text-center font-weight-bold">{{ $student['total_attendance'] }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $student['attendance_percentage'] >= 100 ? 'bg-success' : 'bg-warning' }} p-2">
                                        {{ number_format($student['attendance_percentage'], 1) }}%
                                    </span>
                                </td>
                                <td class="text-center font-weight-bold">{{ $student['total_spr_attendance'] }}</td>
                                <!-- Permission Data -->
                                <td class="text-center">{{ $student['total_permissions'] }}</td>
                                <td class="text-center">{{ $student['approved_permissions'] }}</td>
                                <td class="text-center">
                                    @if($student['total_permissions'] > 0)
                                        {{ number_format($student['permission_approval_rate'], 1) }}%
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
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
                    <div class="modal-header bg-primary text-white">
                        <h4 class="modal-title">
                            <i class="fas fa-upload mr-2"></i> Upload Payment Proof
                        </h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="paymentFile">
                                <i class="fas fa-file-alt mr-1"></i> Payment Proof File
                            </label>
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
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i> Accepted formats: JPG, JPEG, PNG, PDF (max 2MB)
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="notes">
                                <i class="fas fa-sticky-note mr-1"></i> Notes (Optional)
                            </label>
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
                            <i class="fas fa-times mr-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload mr-1"></i> Upload
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
</div>
