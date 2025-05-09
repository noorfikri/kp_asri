<div class="card modal-body card-primary shadow-lg p-0">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title"><i class="fas fa-info-circle"></i> Detail || {{$data->name}}</h3>
        <button type="button" class="close ml-auto" data-dismiss="modal" data-target="show{{$data->id}}" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="text-center mb-3">
            <img class="img-fluid rounded shadow-sm" src="{{ asset($data->picture) }}" alt="Photo">
        </div>
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <th>Nama</th>
                    <td>{{$data->name}}</td>
                </tr>
                <tr>
                    <th>Id</th>
                    <td>{{$data->id}}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{$data->address}}</td>
                </tr>
                <tr>
                    <th>Nomor Telepon</th>
                    <td>{{$data->telephone}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
