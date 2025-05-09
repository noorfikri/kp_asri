<div class="card card-primary shadow-lg">
    <div class="card-header">
      <h3 class="card-title">Buat Supplier</h3>

      <div class="card-tools">
        <button type="button" class="close" data-target="#showcreatemodal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
    </div>
    <form method="POST" action="{{route('suppliers.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <img class="img-fluid pad" id="create-preview-image" src="{{asset('assets/img/Placeholder_Image.png') }}" alt="Foto">
            <div class="form-group">
                <label for="inputImage">Gambar</label>
                <input type="file" id="inputImageCreate" name="picture" class="form-control" value="Masukkan Gambar" onchange="createPreviewImage(event)">
              </div>
        <div class="form-group">
            <label for="inputName">Nama Supplier</label>
            <input type="text" id="inputName" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label for="inputAddress">Alamat</label>
            <textarea id="inputAddress" name="address" class="form-control" rows="4"></textarea>
          </div>
          <div class="form-group">
            <label for="inputTelephone">Nomor Telepon</label>
            <input type="text" id="inputTelephone" name="telephone" class="form-control">
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
