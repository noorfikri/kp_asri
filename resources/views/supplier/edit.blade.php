<div class="card card-primary shadow-lg">
    <div class="card-header">
        <h3 class="card-title">Edit Supplier</h3>
        <div class="card-tools">
            <button type="button" class="close" data-target="#edit{{ $supplier->id }}" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <form method="POST" action="{{ route('suppliers.update', $supplier) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <img class="img-fluid pad" id="edit-preview-image" src="{{ asset($supplier->picture) }}" alt="Foto">
            <div class="form-group">
                <label for="inputImageEdit">Gambar</label>
                <input type="file" id="inputImageEdit" name="picture" class="form-control">
            </div>
            <div class="form-group">
                <label for="inputName">Nama Supplier</label>
                <input type="text" id="inputName" name="name" class="form-control" value="{{ old('name', $supplier->name) }}">
            </div>
            <div class="form-group">
                <label for="inputAddress">Alamat</label>
                <textarea id="inputAddress" name="address" class="form-control" rows="3">{{ old('address', $supplier->address) }}</textarea>
            </div>
            <div class="form-group">
                <label for="inputTelephone">Nomor Telepon</label>
                <input type="text" id="inputTelephone" name="telephone" class="form-control" value="{{ old('telephone', $supplier->telephone) }}">
            </div>
        </div>
        <div class="card-footer">
            <div class="col-12">
                <button type="button" class="btn btn-secondary" data-target="#edit{{ $supplier->id }}" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success float-right">Edit</button>
            </div>
        </div>
    </form>
</div>
