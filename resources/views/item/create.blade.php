<div class="card card-primary shadow-lg">
    <div class="card-header">
        <h3 class="card-title">Buat Barang</h3>
        <div class="card-tools">
            <button type="button" class="close" data-target="#showcreatemodal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <img class="img-fluid pad mb-3" id="create-preview-image" src="{{ asset('assets/img/Placeholder_Image.png') }}" alt="Foto">
            <div class="form-group">
                <label for="inputImageCreate">Gambar</label>
                <input type="file" id="inputImageCreate" name="image" class="form-control @error('image') is-invalid @enderror" onchange="createPreviewImage(event)">
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputName">Nama Barang</label>
                <input type="text" id="inputName" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputCategory">Kategori</label>
                <select id="inputCategory" name="category_id" class="form-control custom-select @error('category_id') is-invalid @enderror">
                    <option selected disabled>Pilih salah satu</option>
                    @foreach ($category as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Ukuran</label>
                <div class="d-flex flex-wrap">
                    @foreach ($size as $s)
                        <div class="form-check mr-3 mb-2">
                            <input class="form-check-input" type="checkbox" name="size_id[]" value="{{ $s->id }}" id="size{{ $s->id }}" {{ (is_array(old('size_id')) && in_array($s->id, old('size_id'))) ? 'checked' : '' }}>
                            <label class="form-check-label" for="size{{ $s->id }}">
                                {{ $s->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('size_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Warna</label>
                <div class="d-flex flex-wrap">
                    @foreach ($colour as $co)
                        <div class="form-check mr-3 mb-2">
                            <input class="form-check-input" type="checkbox" name="colour_id[]" value="{{ $co->id }}" id="colour{{ $co->id }}" {{ (is_array(old('colour_id')) && in_array($co->id, old('colour_id'))) ? 'checked' : '' }}>
                            <label class="form-check-label" for="colour{{ $co->id }}">
                                {{ $co->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('colour_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputBrand">Merek</label>
                <select id="inputBrand" name="brand_id" class="form-control custom-select @error('brand_id') is-invalid @enderror">
                    <option selected disabled>Pilih salah satu</option>
                    @foreach ($brand as $b)
                        <option value="{{ $b->id }}" {{ old('brand_id') == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                    @endforeach
                </select>
                @error('brand_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputPrice">Harga Barang</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">RP.</span>
                    </div>
                    <input type="text" id="inputPrice" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                </div>
                @error('price')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputStock">Stok Barang</label>
                <input type="text" id="inputStock" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}">
                @error('stock')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputDescription">Deskripsi</label>
                <textarea id="inputDescription" name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputNote">Catatan</label>
                <textarea id="inputNote" name="note" class="form-control @error('note') is-invalid @enderror" rows="4">{{ old('note') }}</textarea>
                @error('note')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <div class="col-12">
                <a href="#" class="btn btn-secondary" data-target="#showcreatemodal" data-dismiss="modal">Batal</a>
                <button type="submit" class="btn btn-success float-right">Buat</button>
            </div>
        </div>
    </form>
</div>
