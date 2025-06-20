<div class="card card-primary shadow-lg">
    <div class="card-header">
      <h3 class="card-title">Edit Barang</h3>
      <div class="card-tools">
        <button type="button" class="close" data-target="#edit{{$item->id}}" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
    <form method="POST" action="{{ url('admin/items/'.$item->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <img class="img-fluid pad" id="edit-preview-image" src="{{ asset($item->image) }}" alt="Foto">
            <div class="form-group">
                <label for="inputImage">Gambar</label>
                <input type="file" id="inputImageEdit" name="image" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputName">Nama Barang</label>
                <input type="text" id="inputName" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $item->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputCategory">Kategori</label>
                <select id="inputCategory" name="category_id" class="form-control custom-select @error('category_id') is-invalid @enderror">
                    @foreach ($category as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $item->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
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
                        @foreach ($item->stocks as $idx => $stock)
                        <tr>
                            <td>
                                <select name="stocks[{{ $idx }}][size_id]" class="form-control @error('stocks.'.$idx.'.size_id') is-invalid @enderror" required>
                                    <option value="">Pilih Ukuran</option>
                                    @foreach ($size as $sz)
                                        <option value="{{ $sz->id }}" {{ $stock->size_id == $sz->id ? 'selected' : '' }}>{{ $sz->name }}</option>
                                    @endforeach
                                </select>
                                @error('stocks.'.$idx.'.size_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <select name="stocks[{{ $idx }}][colour_id]" class="form-control @error('stocks.'.$idx.'.colour_id') is-invalid @enderror" required>
                                    <option value="">Pilih Warna</option>
                                    @foreach ($colour as $co)
                                        <option value="{{ $co->id }}" {{ $stock->colour_id == $co->id ? 'selected' : '' }}>{{ $co->name }}</option>
                                    @endforeach
                                </select>
                                @error('stocks.'.$idx.'.colour_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="number" name="stocks[{{ $idx }}][stock]" class="form-control @error('stocks.'.$idx.'.stock') is-invalid @enderror" min="0" value="{{ $stock->stock }}" required>
                                @error('stocks.'.$idx.'.stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger remove-row">Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="button" class="btn btn-success" id="addRow">Tambah Kombinasi</button>
                @error('stocks')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputBrand">Merek</label>
                <select id="inputBrand" name="brand_id" class="form-control custom-select @error('brand_id') is-invalid @enderror">
                    @foreach ($brand as $b)
                        <option value="{{ $b->id }}" {{ old('brand_id', $item->brand_id) == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                    @endforeach
                    <option>...</option>
                </select>
                @error('brand_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputPrice">Harga Barang</label>
                <input type="text" id="inputPrice" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $item->price) }}">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputDescription">Description</label>
                <textarea id="inputDescription" name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $item->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputNote">Catatan</label>
                <textarea id="inputNote" name="note" class="form-control @error('note') is-invalid @enderror" rows="4">{{ old('note', $item->note) }}</textarea>
                @error('note')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <div class="col-12">
                <a href="#" class="btn btn-secondary" data-target="#edit{{$item->id}}" data-dismiss="modal">Batal</a>
                <input type="submit" value="Edit" class="btn btn-success float-right">
            </div>
        </div>
    </form>
</div>
