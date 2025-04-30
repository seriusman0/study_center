<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Journal Entry | Study Center</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/styles.css') }}">
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="#">Study Center</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('student.dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('student.journals.index') }}">My Journals</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content-->
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create Journal Entry</h4>
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

                            <!-- Selfie with Parents -->
                            <div class="mb-4">
                                <label class="form-label">Selfie with Parents *</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- File Upload -->
                                        <div class="mb-3">
                                            <input type="file" name="selfie_image" id="selfie_image" class="form-control @error('selfie_image') is-invalid @enderror" accept="image/*" capture="user">
                                            @error('selfie_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Camera Capture -->
                                        <button type="button" class="btn btn-secondary" id="openCamera">
                                            <i class="fas fa-camera"></i> Take Photo
                                        </button>
                                    </div>
                                </div>
                                <!-- Preview -->
                                <div id="imagePreview" class="mt-3" style="display: none;">
                                    <img id="preview" src="#" alt="Preview" style="max-width: 300px; max-height: 300px;" class="img-thumbnail">
                                </div>
                            </div>

                            <!-- Camera Modal -->
                            <div class="modal fade" id="cameraModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Take Photo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <video id="video" width="100%" autoplay></video>
                                            <canvas id="canvas" style="display:none;"></canvas>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="capture">Capture</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit Journal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer-->
    <footer class="py-5 bg-dark mt-5">
        <div class="container px-4 px-lg-5">
            <p class="m-0 text-center text-white">Copyright &copy; Study Center {{ date('Y') }}</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('assets/user/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            let video = document.getElementById('video');
            let canvas = document.getElementById('canvas');
            let context = canvas.getContext('2d');
            let imageInput = document.getElementById('selfie_image');
            let preview = document.getElementById('preview');
            let imagePreview = document.getElementById('imagePreview');
            let stream = null;

            // File input change handler
            imageInput.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Open camera modal
            $('#openCamera').click(function() {
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(function(mediaStream) {
                        stream = mediaStream;
                        video.srcObject = mediaStream;
                        $('#cameraModal').modal('show');
                    })
                    .catch(function(err) {
                        console.log("Error accessing camera: " + err);
                        alert("Error accessing camera. Please ensure you have granted camera permissions.");
                    });
            });

            // Close camera when modal is closed
            $('#cameraModal').on('hidden.bs.modal', function() {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }
            });

            // Capture photo
            $('#capture').click(function() {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                
                // Convert to base64
                let imageData = canvas.toDataURL('image/png');
                
                // Send to server
                $.ajax({
                    url: '{{ route("student.journals.store-image") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        image: imageData
                    },
                    success: function(response) {
                        // Create a file input with the image
                        let blob = dataURItoBlob(imageData);
                        let file = new File([blob], "camera_capture.png", { type: "image/png" });
                        let container = new DataTransfer();
                        container.items.add(file);
                        imageInput.files = container.files;
                        
                        // Show preview
                        preview.src = imageData;
                        imagePreview.style.display = 'block';
                        
                        // Close modal
                        $('#cameraModal').modal('hide');
                    },
                    error: function() {
                        alert('Error saving image. Please try again.');
                    }
                });
            });

            // Helper function to convert base64 to blob
            function dataURItoBlob(dataURI) {
                let byteString = atob(dataURI.split(',')[1]);
                let mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
                let ab = new ArrayBuffer(byteString.length);
                let ia = new Uint8Array(ab);
                for (let i = 0; i < byteString.length; i++) {
                    ia[i] = byteString.charCodeAt(i);
                }
                return new Blob([ab], {type: mimeString});
            }
        });
    </script>
</body>
</html>
