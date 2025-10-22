<div class="card card-outline card-primary shadow-lg p-0">
    <div class="card-header d-flex justify-content-between align-items-center my-0 py-0 border-0">
        <div class="bg-primary py-2 px-3 my-0 rounded-bottom rounded-3">
        <h3 class="card-title"><i class="fa-solid fa-square-plus"></i> Buat Supplier Baru</h3>
        </div>
    </div>
    <form method="POST" action="{{ route('suppliers.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <img class="img-fluid pad mb-3" id="create-preview-image" src="{{ asset('assets/img/Placeholder_Image.png') }}" alt="Foto">
            <div class="form-group">
            <label for="inputImageCreate">Gambar</label>
            <div class="input-group">
                      <div class="custom-file">
                        <input type="file" id="inputImageCreate" name="picture" class="form-control @error('image') is-invalid @enderror" onchange="createPreviewImage(event)">
                        <label class="custom-file-label" for="inputImageCreate">Masukkan Gambar Atau Foto Supplier</label>
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                      </div>
            </div>
            </div>
            <div class="form-group">
                <label for="inputName">Nama Supplier</label>
                <input type="text" id="inputName" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputAddress">Alamat</label>
                <textarea id="inputAddress" name="address" class="form-control @error('address') is-invalid @enderror" rows="4">{{ old('address') }}</textarea>
                @error('address')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputTelephone">Nomor Telepon</label>
                <input type="text" id="inputTelephone" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone') }}">
                @error('telephone')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-12">
                <button type="button" class="btn btn-outline-danger rounded-pill" data-target="#showcreatemodal" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Batal</button>
                <button type="submit" class="btn btn-success float-right rounded-pill"><i class="fa-solid fa-floppy-disk"></i> Simpan Supplier Baru</button>
            </div>
        </div>
    </form>
</div>
