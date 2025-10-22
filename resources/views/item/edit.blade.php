<div class="card card-outline card-info shadow-lg p-0">
    <div class="card-header d-flex justify-content-between my-0 py-0 border-0">
    <div class="bg-info py-2 px-3 my-0 rounded-bottom rounded-3">
      <h3 class="card-title"><i class="fa-solid fa-pen-to-square"></i> Ubah Barang</h3>
    </div>
    </div>
    <form method="POST" action="{{ url('admin/items/'.$item->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <img class="img-fluid pad" id="edit-preview-image" src="{{ asset($item->image) }}" alt="Foto">
        <div class="form-group">
            <label for="inputImageEdit">Gambar</label>
            <div class="input-group">
                      <div class="custom-file">
                        <input  type="file" id="inputImageEdit" name="image" class="form-control @error('image') is-invalid @enderror" onchange="editPreviewImage(event)">
                        <label class="custom-file-label" for="inputImageEdit">Masukkan Gambar Barang</label>
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
            @enderror
                      </div>
            </div>
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
                                <select name="stocks[{{ $idx }}][size_id]" class="form-control @error('stocks.'.$idx.'.size_id') is-invalid @enderror" required @cannot('updateStock', App\Models\Item::class) disabled @endcannot>
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
                                <select name="stocks[{{ $idx }}][colour_id]" class="form-control @error('stocks.'.$idx.'.colour_id') is-invalid @enderror" required @cannot('updateStock', App\Models\Item::class) disabled @endcannot>
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
                                <input type="number" name="stocks[{{ $idx }}][stock]" class="form-control @error('stocks.'.$idx.'.stock') is-invalid @enderror" min="0" value="{{ $stock->stock }}" required @cannot('updateStock', App\Models\Item::class) readonly @endcannot>
                                @error('stocks.'.$idx.'.stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-danger remove-row rounded-pill" @cannot('updateStock', App\Models\Item::class) disabled @endcannot><i class="fas fa-trash"></i> Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><button type="button" class="btn btn-success rounded-pill" id="addRow"><i class="fas fa-plus"></i> Tambah </button></td>
                        </tr>
                    </tfoot>
                </table>
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
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">RP.</span>
                    </div>
                    <input type="number" id="inputPrice" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $item->price) }}">
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                    @error('price')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="inputDescription">Deskripsi</label>
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
            <div class="col-12">
                <a href="#" class="btn btn-outline-danger rounded-pill" data-target="#edit{{$item->id}}" data-dismiss="modal"> <i class="fa-solid fa-xmark"></i> Batal</a>
                <button type="submit" class="btn btn-success float-right rounded-pill"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Barang</button>
            </div>
        </div>
    </form>
</div>
