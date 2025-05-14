<div class="card card-primary shadow-lg">
    <div class="card-header">
      <h3 class="card-title">Edit Barang</h3>

      <div class="card-tools">
        <button type="button" class="close" data-target="#edit{{$item->id}}" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
    </div>
    <form method="POST" action="{{url('admin/items/'.$item->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
        <img class="img-fluid pad" id="edit-preview-image" src="{{asset($item->image) }}" alt="Foto">
        <div class="form-group">
            <label for="inputImage">Gambar</label>
            <input type="file" id="inputImageEdit" name="image" class="form-control" value="Masukkan Gambar">
          </div>
        <div class="form-group">
            <label for="inputName">Nama Barang</label>
            <input type="text" id="inputName" name="name" class="form-control" value="{{$item->name}}">

        </div>
        <div class="form-group">
            <label for="inputCategory">Kategori</label>
            <select id="inputCategory" name="category_id" class="form-control custom-select">
                @foreach ($category as $cat)
                @if ($cat->id == $item->category_id)

                    <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                @else

                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endif
                @endforeach
              </select>
        </div>
        <div class="form-group">
            <label for="inputSize">Ukuran</label>
            <div class="d-flex flex-wrap">
                @foreach ($size as $index => $s)
                    @if ($index % 2 == 0 && $index != 0)
                        </div><div class="d-flex flex-wrap">
                    @endif
                    <div class="form-check mr-3 mb-2">
                        <input class="form-check-input" type="checkbox" name="size_id[]" value="{{$s->id}}" id="size{{$s->id}}" @if($item->size->contains($s->id)) checked @endif>
                        <label class="form-check-label" for="size{{$s->id}}">
                            {{$s->name}}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label for="inputColour">Warna</label>
            <div class="d-flex flex-wrap">
                @foreach ($colour as $index => $co)
                    @if ($index % 3 == 0 && $index != 0)
                        </div><div class="d-flex flex-wrap">
                    @endif
                    <div class="form-check mr-3 mb-2">
                        <input class="form-check-input" type="checkbox" name="colour_id[]" value="{{$co->id}}" id="colour{{$co->id}}" @if($item->colour->contains($co->id)) checked @endif>
                        <label class="form-check-label" for="colour{{$co->id}}">
                            {{$co->name}}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
          <div class="form-group">
            <label for="inputBrand">Merek</label>
            <select id="inputBrand" name="brand_id" class="form-control custom-select">
              @foreach ($brand as $b)
              @if ($b->id == $item->brand_id)
                    <option value="{{$b->id}}" selected>{{$b->name}}</option>
                @else
                    <option value="{{$b->id}}">{{$b->name}}</option>
              @endif
              @endforeach
              <option>...</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputPrice">Harga Barang</label>
            <input type="text" id="inputPrice" name="price" class="form-control" value="{{$item->price}}">
          </div>
          <div class="form-group">
            <label for="inputStock">Stok Barang</label>
            <input type="text" id="inputStock" name="stock" class="form-control" value="{{$item->stock}}">
          </div>
          <div class="form-group">
            <label for="inputDescription">Description</label>
            <textarea id="inputDescription" name="description" class="form-control" rows="4" value="{{$item->description}}">{{ $item->description }}</textarea>
          </div>
          <div class="form-group">
            <label for="inputNote">Catatan</label>
            <textarea id="inputNote" name="note" class="form-control" rows="4">{{ $item->note }}</textarea>
          </div>
        </div>
        <div class="card-footer">
            <div class="col-12">
                <a href="#" class="btn btn-secondary" data-target="#edit{{$item->id}}" data-dismiss="modal">Batal</a>
                <input type="submit" value="Edit" class="btn btn-success float-right">
            </div>
        </div>
    </form>
    <!-- /.card-body -->
  </div>
