@extends('layouts.student')

@section('title', 'Buat Entri Jurnal | Study Center')

@section('content')
    <div class="row gx-4 gx-lg-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Buat Entri Jurnal</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('student.journals.store') }}" method="POST" enctype="multipart/form-data" id="journalForm">
                        @csrf
                        
                        <!-- KEROHANIAN Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">KEROHANIAN</h5>
                            </div>
                            <div class="card-body">
                                <!-- Mengawali Hari dengan Berdoa -->
                                <div class="mb-3">
                                    <label class="form-label d-block">MENGAWALI HARI DENGAN BERDOA *</label>
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="mengawali_hari_dengan_berdoa" id="berdoa_ya" value="1" {{ old('mengawali_hari_dengan_berdoa') == '1' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-primary" for="berdoa_ya">YA</label>
                                        <input type="radio" class="btn-check" name="mengawali_hari_dengan_berdoa" id="berdoa_tidak" value="0" {{ old('mengawali_hari_dengan_berdoa') == '0' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="berdoa_tidak">TIDAK</label>
                                    </div>
                                </div>

                                <!-- Baca Alkitab PL -->
                                <div class="mb-3">
                                    <label class="form-label d-block">BACA ALKITAB (SESUAI JADWAL PL) *</label>
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="baca_alkitab_pl" id="alkitab_pl_ya" value="1" {{ old('baca_alkitab_pl') == '1' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-primary" for="alkitab_pl_ya">YA</label>
                                        <input type="radio" class="btn-check" name="baca_alkitab_pl" id="alkitab_pl_tidak" value="0" {{ old('baca_alkitab_pl') == '0' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="alkitab_pl_tidak">TIDAK</label>
                                    </div>
                                </div>

                                <!-- Baca Alkitab PB -->
                                <div class="mb-3">
                                    <label class="form-label d-block">BACA ALKITAB (SESUAI JADWAL PB) *</label>
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="baca_alkitab_pb" id="alkitab_pb_ya" value="1" {{ old('baca_alkitab_pb') == '1' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-primary" for="alkitab_pb_ya">YA</label>
                                        <input type="radio" class="btn-check" name="baca_alkitab_pb" id="alkitab_pb_tidak" value="0" {{ old('baca_alkitab_pb') == '0' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="alkitab_pb_tidak">TIDAK</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PENDIDIKAN Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">PENDIDIKAN</h5>
                                <small class="text-muted">Klik dimana hari anda mengikuti kegiatan</small>
                            </div>
                            <div class="card-body">
                                <!-- Hadir Kelas SC -->
                                <div class="mb-3">
                                    <label class="form-label d-block">HADIR KELAS SC *</label>
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="hadir_kelas_sc" id="sc_ya" value="1" {{ old('hadir_kelas_sc') == '1' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-primary" for="sc_ya">YA</label>
                                        <input type="radio" class="btn-check" name="hadir_kelas_sc" id="sc_tidak" value="0" {{ old('hadir_kelas_sc') == '0' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="sc_tidak">TIDAK</label>
                                    </div>
                                </div>

                                <!-- Hadir CSS -->
                                <div class="mb-3">
                                    <label class="form-label d-block">HADIR CSS *</label>
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="hadir_css" id="css_ya" value="1" {{ old('hadir_css') == '1' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-primary" for="css_ya">YA</label>
                                        <input type="radio" class="btn-check" name="hadir_css" id="css_tidak" value="0" {{ old('hadir_css') == '0' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="css_tidak">TIDAK</label>
                                    </div>
                                </div>

                                <!-- Hadir CGG -->
                                <div class="mb-3">
                                    <label class="form-label d-block">HADIR CGG *</label>
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="hadir_cgg" id="cgg_ya" value="1" {{ old('hadir_cgg') == '1' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-primary" for="cgg_ya">YA</label>
                                        <input type="radio" class="btn-check" name="hadir_cgg" id="cgg_tidak" value="0" {{ old('hadir_cgg') == '0' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="cgg_tidak">TIDAK</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- KARAKTER Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">KARAKTER</h5>
                            </div>
                            <div class="card-body">
                                <!-- Merapikan Tempat Tidur -->
                                <div class="mb-3">
                                    <label class="form-label d-block">MERAPIKAN TEMPAT TIDUR *</label>
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="merapikan_tempat_tidur" id="rapikan_ya" value="1" {{ old('merapikan_tempat_tidur') == '1' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-primary" for="rapikan_ya">YA</label>
                                        <input type="radio" class="btn-check" name="merapikan_tempat_tidur" id="rapikan_tidak" value="0" {{ old('merapikan_tempat_tidur') == '0' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="rapikan_tidak">TIDAK</label>
                                    </div>
                                </div>

                                <!-- Menyapa Orang Tua -->
                                <div class="mb-3">
                                    <label class="form-label d-block">MENYAPA ORANG TUA / GURU / KAKAK *</label>
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="menyapa_orang_tua" id="sapa_ya" value="1" {{ old('menyapa_orang_tua') == '1' ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-primary" for="sapa_ya">YA</label>
                                        <input type="radio" class="btn-check" name="menyapa_orang_tua" id="sapa_tidak" value="0" {{ old('menyapa_orang_tua') == '0' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary" for="sapa_tidak">TIDAK</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Parent Signature -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Tanda Tangan Orang Tua *</h5>
                                <small class="text-muted">Silakan tanda tangan pada area di bawah ini</small>
                            </div>
                            <div class="card-body">
                                <!-- Signature Pad -->
                                <div class="signature-container mb-3">
                                    <canvas id="signature-pad" class="signature-pad"></canvas>
                                </div>
                                
                                <!-- Signature Controls -->
                                <div class="d-flex gap-2 mb-3">
                                    <button type="button" class="btn btn-secondary btn-sm" id="clear-signature">
                                        <i class="fas fa-eraser"></i> Hapus
                                    </button>
                                    <button type="button" class="btn btn-info btn-sm" id="undo-signature">
                                        <i class="fas fa-undo"></i> Undo
                                    </button>
                                </div>
                                
                                <!-- Hidden input untuk signature data -->
                                <input type="hidden" name="parent_signature" id="parent_signature" required>
                                
                                <!-- Validation error -->
                                @error('parent_signature')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                
                                <!-- Status indicator -->
                                <div id="signature-status" class="text-muted">
                                    <i class="fas fa-info-circle"></i> Belum ada tanda tangan
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Kirim Jurnal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .signature-container {
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        background-color: #f8f9fa;
        padding: 20px;
        text-align: center;
        position: relative;
    }
    
    .signature-pad {
        border: 1px solid #ced4da;
        border-radius: 6px;
        background-color: white;
        cursor: crosshair;
        display: block;
        margin: 0 auto;
        width: 100%;
        max-width: 600px;
        height: 200px;
    }
    
    .signature-container:hover {
        border-color: #007bff;
        background-color: #e7f1ff;
    }
    
    .signature-container::before {
        content: "Area Tanda Tangan";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #6c757d;
        font-size: 14px;
        pointer-events: none;
        z-index: 1;
    }
    
    .signature-pad.signed + .signature-container::before {
        display: none;
    }
    
    #signature-status.signed {
        color: #28a745;
    }
    
    #signature-status.empty {
        color: #6c757d;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('signature-pad');
    const ctx = canvas.getContext('2d');
    const clearBtn = document.getElementById('clear-signature');
    const undoBtn = document.getElementById('undo-signature');
    const hiddenInput = document.getElementById('parent_signature');
    const statusEl = document.getElementById('signature-status');
    const form = document.getElementById('journalForm');
    
    let isDrawing = false;
    let lastX = 0;
    let lastY = 0;
    let strokes = []; // Array to store strokes for undo functionality
    let currentStroke = [];
    
    // Set canvas size
    function resizeCanvas() {
        const rect = canvas.getBoundingClientRect();
        canvas.width = rect.width;
        canvas.height = rect.height;
        
        // Set drawing styles
        ctx.strokeStyle = '#000';
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
    }
    
    // Initialize canvas
    resizeCanvas();
    
    // Resize canvas on window resize
    window.addEventListener('resize', resizeCanvas);
    
    function startDrawing(e) {
        isDrawing = true;
        currentStroke = [];
        [lastX, lastY] = getCoordinates(e);
        currentStroke.push({x: lastX, y: lastY});
    }
    
    function draw(e) {
        if (!isDrawing) return;
        
        const [currentX, currentY] = getCoordinates(e);
        
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(currentX, currentY);
        ctx.stroke();
        
        currentStroke.push({x: currentX, y: currentY});
        [lastX, lastY] = [currentX, currentY];
    }
    
    function stopDrawing() {
        if (!isDrawing) return;
        isDrawing = false;
        
        // Save current stroke
        if (currentStroke.length > 1) {
            strokes.push([...currentStroke]);
            updateSignatureData();
            updateStatus();
        }
    }
    
    function getCoordinates(e) {
        const rect = canvas.getBoundingClientRect();
        const clientX = e.type.includes('touch') ? e.touches[0].clientX : e.clientX;
        const clientY = e.type.includes('touch') ? e.touches[0].clientY : e.clientY;
        
        return [
            clientX - rect.left,
            clientY - rect.top
        ];
    }
    
    function clearSignature() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        strokes = [];
        hiddenInput.value = '';
        updateStatus();
    }
    
    function undoStroke() {
        if (strokes.length > 0) {
            strokes.pop();
            redrawCanvas();
            updateSignatureData();
            updateStatus();
        }
    }
    
    function redrawCanvas() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        strokes.forEach(stroke => {
            if (stroke.length > 1) {
                ctx.beginPath();
                ctx.moveTo(stroke[0].x, stroke[0].y);
                
                for (let i = 1; i < stroke.length; i++) {
                    ctx.lineTo(stroke[i].x, stroke[i].y);
                }
                ctx.stroke();
            }
        });
    }
    
    function updateSignatureData() {
        if (strokes.length > 0) {
            const dataURL = canvas.toDataURL('image/png');
            hiddenInput.value = dataURL;
        } else {
            hiddenInput.value = '';
        }
    }
    
    function updateStatus() {
        if (strokes.length > 0) {
            statusEl.innerHTML = '<i class="fas fa-check-circle"></i> Tanda tangan tersimpan';
            statusEl.className = 'text-success';
            canvas.classList.add('signed');
        } else {
            statusEl.innerHTML = '<i class="fas fa-info-circle"></i> Belum ada tanda tangan';
            statusEl.className = 'text-muted';
            canvas.classList.remove('signed');
        }
    }
    
    // Mouse events
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);
    
    // Touch events for mobile
    canvas.addEventListener('touchstart', function(e) {
        e.preventDefault();
        startDrawing(e);
    });
    
    canvas.addEventListener('touchmove', function(e) {
        e.preventDefault();
        draw(e);
    });
    
    canvas.addEventListener('touchend', function(e) {
        e.preventDefault();
        stopDrawing();
    });
    
    // Button events
    clearBtn.addEventListener('click', clearSignature);
    undoBtn.addEventListener('click', undoStroke);
    
    // Form validation
    form.addEventListener('submit', function(e) {
        if (!hiddenInput.value) {
            e.preventDefault();
            alert('Silakan buat tanda tangan orang tua terlebih dahulu!');
            canvas.focus();
            return false;
        }
    });
    
    // Initialize status
    updateStatus();
});
</script>
@endpush
