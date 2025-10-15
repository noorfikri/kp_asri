<div class="card card-outline card-info shadow-lg p-0">
    <div class="card-header d-flex justify-content-between align-items-center my-0 py-0 border-0">
        <div class="bg-info py-2 px-3 my-0 rounded-bottom rounded-3">
        <h3 class="card-title"><i class="fa-solid fa-pen-to-square"></i> Ubah Warna</h3>
        </div>
    </div>
    <form method="POST" action="{{ route('colours.update', $colour->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="inputName">Nama Warna</label>
                <input type="text" id="inputName" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $colour->name) }}">
                @error('name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <div class="col-12">
                <button type="button" class="btn btn-outline-danger rounded-pill" data-dismiss="modal"> <i class="fa-solid fa-xmark"></i> Batal</button>
                <button type="submit" class="btn btn-success float-right rounded-pill"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Warna </button>
            </div>
        </div>
    </form>
</div>
