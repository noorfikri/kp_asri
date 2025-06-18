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
                <label for="inputSize">Ukuran</label>
                <div class="d-flex flex-wrap">
                    @foreach ($size as $index => $s)
                        @if ($index % 2 == 0 && $index != 0)
                            </div><div class="d-flex flex-wrap">
                        @endif
                        <div class="form-check mr-3 mb-2">
                            <input class="form-check-input" type="checkbox" name="size_id[]" value="{{ $s->id }}" id="size{{ $s->id }}"
                                {{ in_array($s->id, old('size_id', $item->size->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <label class="form-check-label" for="size{{ $s->id }}">
                                {{ $s->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('size_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputColour">Warna</label>
                <div class="d-flex flex-wrap">
                    @foreach ($colour as $index => $co)
                        @if ($index % 3 == 0 && $index != 0)
                            </div><div class="d-flex flex-wrap">
                        @endif
                        <div class="form-check mr-3 mb-2">
                            <input class="form-check-input" type="checkbox" name="colour_id[]" value="{{ $co->id }}" id="colour{{ $co->id }}"
                                {{ in_array($co->id, old('colour_id', $item->colour->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <label class="form-check-label" for="colour{{ $co->id }}">
                                {{ $co->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('colour_id')
                    <div class="text-danger">{{ $message }}</div>
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
                <label for="inputStock">Stok Barang</label>
                <input type="text" id="inputStock" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $item->stock) }}">
                @error('stock')
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
