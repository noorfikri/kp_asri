<div class="card card-primary card-outline shadow-lg p-0">
    <div class="card-header d-flex justify-content-between align-items-center my-0 py-0 border-0">
        <div class="bg-primary py-2 px-3 my-0 rounded-bottom rounded-3">
        <h3 class="card-title"><i class="fa-solid fa-square-plus"></i> Buat Warna Baru</h3>
        </div>
    </div>
    <form method="POST" action="{{ route('colours.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Nama Warna</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Masukkan nama warna"
                    value="{{ old('name') }}"
                    required
                    autofocus
                >
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <div class="col-12">
                <button type="button" class="btn btn-outline-danger rounded-pill" data-dismiss="modal"> <i class="fa-solid fa-xmark"></i> Batal</button>
                <button type="submit" class="btn btn-success float-right rounded-pill"> <i class="fa-solid fa-floppy-disk"></i> Simpan Warna Baru</button>
            </div>
        </div>
    </form>
</div>
