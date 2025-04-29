<div class="card mb-4">
    <div class="card-header">
        <h4>Siblings Information</h4>
    </div>
    <div class="card-body">
        <!-- Existing Siblings List -->
        @if(count($siblings) > 0)
            @foreach($siblings as $sibling)
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Nama Saudara</label>
                            <input type="text" class="form-control" value="{{ $sibling['nama'] }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>ID Saudara</label>
                            <input type="text" class="form-control" value="{{ $sibling['member_id'] }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger mb-3" wire:click="removeSibling({{ $sibling['id'] }})">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-muted">No siblings added yet.</p>
        @endif

        <!-- Add New Sibling Form -->
        <div class="row mt-4">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="newSibling.nama">Nama Saudara</label>
                    <input type="text" class="form-control @error('newSibling.nama') is-invalid @enderror" 
                        wire:model="newSibling.nama">
                    @error('newSibling.nama')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="newSibling.member_id">ID Saudara</label>
                    <input type="text" class="form-control @error('newSibling.member_id') is-invalid @enderror" 
                        wire:model="newSibling.member_id">
                    @error('newSibling.member_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-success mb-3" wire:click="addSibling">
                    <i class="fas fa-plus"></i> Add
                </button>
            </div>
        </div>
    </div>
</div>
