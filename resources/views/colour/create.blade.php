<div class="card card-primary shadow-lg">
    <div class="card-header">
        <h3 class="card-title">Buat Warna</h3>

        <div class="card-tools">
            <button type="button" class="close" data-target="#showcreatemodal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <form method="POST" action="{{ route('colours.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="inputName">Nama Warna</label>
                <input type="text" id="inputName" name="name" class="form-control" placeholder="Masukkan nama warna">
            </div>
        </div>
        <div class="card-footer">
            <div class="col-12">
                <a href="#" class="btn btn-secondary" data-target="#showcreatemodal" data-dismiss="modal">Batal</a>
                <input type="submit" value="Buat" class="btn btn-success float-right">
            </div>
        </div>
    </form>
</div>
