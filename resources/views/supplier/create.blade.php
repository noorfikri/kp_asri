<div class="card card-primary shadow-lg">
    <div class="card-header">
        <h3 class="card-title">Buat Supplier</h3>
        <div class="card-tools">
            <button type="button" class="close" data-target="#showcreatemodal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <form method="POST" action="{{ route('suppliers.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <img class="img-fluid pad mb-3" id="create-preview-image" src="{{ asset('assets/img/Placeholder_Image.png') }}" alt="Foto">
            <div class="form-group">
                <label for="inputImageCreate">Gambar</label>
                <input type="file" id="inputImageCreate" name="picture" class="form-control @error('picture') is-invalid @enderror" onchange="createPreviewImage(event)">
                @error('picture')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
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
        </div>
        <div class="card-footer">
            <div class="col-12">
                <button type="button" class="btn btn-secondary" data-target="#showcreatemodal" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success float-right">Buat</button>
            </div>
        </div>
    </form>
</div>
