<div class="card card-primary shadow-lg">
    <div class="card-header">
        <h3 class="card-title">Edit Warna</h3>

        <div class="card-tools">
            <button type="button" class="close" data-target="#edit{{$colour->id}}" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <form method="POST" action="{{url('admin/colours/'.$colour->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="inputName">Nama Warna</label>
                <input type="text" id="inputName" name="name" class="form-control" value="{{$colour->name}}">
            </div>
        </div>
        <div class="card-footer">
            <div class="col-12">
                <a href="#" class="btn btn-secondary" data-target="#edit{{$colour->id}}" data-dismiss="modal">Batal</a>
                <input type="submit" value="Edit" class="btn btn-success float-right">
            </div>
        </div>
    </form>
</div>
