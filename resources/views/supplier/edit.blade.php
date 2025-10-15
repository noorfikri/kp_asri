<div class="card card-outline card-info shadow-lg p-0">
    <div class="card-header d-flex justify-content-between align-items-center my-0 py-0 border-0">
        <div class="bg-info py-2 px-3 my-0 rounded-bottom rounded-3">
        <h3 class="card-title"><i class="fa-solid fa-pen-to-square"></i> Ubah Supplier</h3>
        </div>
    </div>
    <form method="POST" action="{{ route('suppliers.update', $supplier) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <img class="img-fluid pad" id="edit-preview-image" src="{{ asset($supplier->picture) }}" alt="Foto">
            <div class="form-group">
            <label for="inputImageEdit">Gambar</label>
            <div class="input-group">
                      <div class="custom-file">
                        <input  type="file" id="inputImageEdit" name="picture" class="form-control @error('image') is-invalid @enderror" onchange="editPreviewImage(event)">
                        <label class="custom-file-label" for="inputImageEdit">Masukkan Gambar Barang</label>
                @error('picture')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                      </div>
            </div>
            </div>
            <div class="form-group">
                <label for="inputName">Nama Supplier</label>
                <input type="text" id="inputName" name="name" class="form-control" value="{{ old('name', $supplier->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputAddress">Alamat</label>
                <textarea id="inputAddress" name="address" class="form-control" rows="3">{{ old('address', $supplier->address) }}</textarea>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputTelephone">Nomor Telepon</label>
                <input type="text" id="inputTelephone" name="telephone" class="form-control" value="{{ old('telephone', $supplier->telephone) }}">
                @error('telephone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <div class="col-12">
                <button type="button" class="btn btn-outline-danger rounded-pill" data-target="#edit{{ $supplier->id }}" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Batal</button>
                <button type="submit" class="btn btn-success rounded-pill float-right"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Supplier </button>
            </div>
        </div>
    </form>
</div>
