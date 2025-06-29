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
                <label>Stok per Warna dan Ukuran</label>
                <table class="table table-bordered" id="stockTable">
                    <thead>
                        <tr>
                            <th>Ukuran</th>
                            <th>Warna</th>
                            <th>Stok</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="stocks[0][size_id]" class="form-control @error('stocks.0.size_id') is-invalid @enderror" required>
                                    <option value="">Pilih Ukuran</option>
                                    @foreach ($size as $sz)
                                        <option value="{{ $sz->id }}">{{ $sz->name }}</option>
                                    @endforeach
                                </select>
                                @error('stocks.0.size_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <select name="stocks[0][colour_id]" class="form-control @error('stocks.0.colour_id') is-invalid @enderror" required>
                                    <option value="">Pilih Warna</option>
                                    @foreach ($colour as $co)
                                        <option value="{{ $co->id }}">{{ $co->name }}</option>
                                    @endforeach
                                </select>
                                @error('stocks.0.colour_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="number" name="stocks[0][stock]" class="form-control @error('stocks.0.stock') is-invalid @enderror" min="0" required>
                                @error('stocks.0.stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger remove-row">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-success" id="addRow">Tambahkan</button>
                @error('stocks')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
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
