

<div class="card card-primary shadow-lg">
    <div class="card-header">
      <h3 class="card-title">Buat Barang</h3>

      <div class="card-tools">
        <button type="button" class="close" data-target="#showcreatemodal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
    </div>
    <form method="POST" action="{{route('items.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <img class="img-fluid pad" id="create-preview-image" src="{{asset('assets/img/Placeholder_Image.png') }}" alt="Foto">
            <div class="form-group">
                <label for="inputImage">Gambar</label>
                <input type="file" id="inputImageCreate" name="image" class="form-control" value="Masukkan Gambar" onchange="createPreviewImage(event)">
              </div>
        <div class="form-group">
            <label for="inputName">Nama Barang</label>
            <input type="text" id="inputName" name="name" class="form-control">
          </div>
            <div class="form-group">
            <label for="inputCategory">Kategori</label>
            <select id="inputCategory" name="category_id" class="form-control custom-select">
                <option selected="" disabled="">Pilih salah satu</option>
                @foreach ($category as $cat)
                <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
              <option>...</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputSize">Ukuran</label>
            <select id="inputSize" name="size_id" class="form-control custom-select">
              <option selected="" disabled="">Pilih salah satu</option>
              @foreach ($size as $s)
              <option value="{{$s->id}}">{{$s->name}}</option>
              @endforeach
              <option>...</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputSize">Ukuran</label>
            <select id="inputSize" name="size_id" class="form-control custom-select">
              <option selected="" disabled="">Pilih salah satu</option>
              @foreach ($size as $s)
              <option value="{{$s->id}}">{{$s->name}}</option>
              @endforeach
              <option>...</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputColour">Warna</label>
            <select id="inputColour" name="colour_id" class="form-control custom-select">
              <option selected="" disabled="">Pilih salah satu</option>
              @foreach ($colour as $co)
              <option value="{{$co->id}}">{{$co->name}}</option>
              @endforeach
              <option>...</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputBrand">Merek</label>
            <select id="inputBrand" name="brand_id" class="form-control custom-select">
              <option selected="" disabled="">Pilih salah satu</option>
              @foreach ($brand as $b)
              <option value="{{$b->id}}">{{$b->name}}</option>
              @endforeach
              <option>...</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputPrice">Harga Barang</label>
            <p>RP. </p><input type="text" id="inputPrice" name="price" class="form-control">
          </div>
          <div class="form-group">
            <label for="inputStock">Stok Barang</label>
            <input type="text" id="inputStock" name="stock" class="form-control">
          </div>
          <div class="form-group">
            <label for="inputNote">Catatan</label>
            <textarea id="inputNote" name="note" class="form-control" rows="4"></textarea>
          </div>
        </div>
        <div class="card-footer">
            <div class="col-12">
                <a href="#" class="btn btn-secondary" data-target="#showcreatemodal" data-dismiss="modal">Batal</a>
                <input type="submit" value="Buat" class="btn btn-success float-right">
            </div>
        </div>
    </form>
    <!-- /.card-body -->
  </div>
