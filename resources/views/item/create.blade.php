<div class="card card-outline card-primary shadow-lg p-0">
    <div class="card-header d-flex justify-content-between my-0 py-0 border-0">
        <div class="bg-primary py-2 px-3 my-0 rounded-bottom rounded-3">
        <h3 class="card-title"><i class="fa-solid fa-square-plus"></i> Buat Barang Baru</h3>
        </div>
    </div>
    <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <img class="img-fluid pad mb-3" id="create-preview-image" src="{{ asset('assets/img/Placeholder_Image.png') }}" alt="Foto">
        <div class="form-group">
            <label for="inputImageCreate">Gambar</label>
            <div class="input-group">
                      <div class="custom-file">
                        <input type="file" id="inputImageCreate" name="image" class="form-control @error('image') is-invalid @enderror" onchange="createPreviewImage(event)">
                        <label class="custom-file-label" for="inputImageCreate">Masukkan Gambar Barang</label>
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                      </div>
            </div>
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
            @can('updateStock', App\Models\Item::class)
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
                                <button type="button" class="btn btn-outline-danger rounded-pill remove-row"> <i class="fas fa-trash"></i> Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><button type="button" class="btn btn-success rounded-pill" id="addRow"><i class="fas fa-plus"></i> Tambah</button></td>
                        </tr>
                    </tfoot>
                </table>
                @error('stocks')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            @endcan
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
                    <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                  </div>
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
            <div class="col-12">
                <a href="#" class="btn btn-outline-danger rounded-pill" data-target="#showcreatemodal" data-dismiss="modal"> <i class="fa-solid fa-xmark"></i> Batal</a>
                <button type="submit" class="btn btn-success float-right rounded-pill"><i class="fa-solid fa-floppy-disk"></i> Simpan Barang Baru</button>
            </div>
        </div>
    </form>
</div>
