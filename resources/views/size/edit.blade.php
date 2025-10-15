<div class="card card-outline card-info shadow-lg p-0">
    <div class="card-header d-flex justify-content-between align-items-center my-0 py-0 border-0">
        <div class="bg-info py-2 px-3 my-0 rounded-bottom rounded-3">
        <h3 class="card-title"><i class="fa-solid fa-pen-to-square"></i> Ubah Ukuran</h3>
        </div>
    </div>
    <form method="POST" action="{{url('admin/sizes/'.$size->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="inputName">Nama Ukuran</label>
                <input type="text" id="inputName" name="name" class="form-control" value="{{$size->name}}">
            </div>
        </div>
        <div class="card-footer">
            <div class="col-12">
                <a href="#" class="btn btn-outline-danger rounded-pill" data-target="#edit{{$size->id}}" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Batal</a>
                <button type="submit" class="btn btn-success float-right rounded-pill"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Ukuran</button>
            </div>
        </div>
    </form>
</div>
