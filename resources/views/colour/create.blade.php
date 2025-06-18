<div class="card card-primary shadow-lg">
    <div class="card-header">
        <h3 class="card-title">Buat Warna</h3>
        <div class="card-tools">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success float-right">Buat</button>
            </div>
        </div>
    </form>
</div>
