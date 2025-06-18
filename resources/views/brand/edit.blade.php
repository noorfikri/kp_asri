<div class="card card-primary shadow-lg">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Edit Brand</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form method="POST" action="{{ route('brands.update', $brand->id) }}" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="inputName">Nama Brand</label>
                <input
                    type="text"
                    id="inputName"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $brand->name) }}"
                    required
                    autofocus
                >
                @error('name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Edit</button>
        </div>
    </form>
</div>
