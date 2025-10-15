<div class="card modal-body card-outline card-primary shadow-lg p-0">
    <div class="card-header d-flex justify-content-between align-items-center my-0 py-0 border-0">
        <div class="bg-primary py-2 px-3 my-0 rounded-bottom rounded-3">
        <h3 class="card-title"><i class="fas fa-info"> </i> Detail || {{$data->name}}</h3>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="text-center mb-3">
            <img class="img-fluid img-circle rounded shadow-sm" src="{{ asset($data->profile_picture) }}" alt="Photo">
        </div>
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <th>Nama</th>
                    <td>{{$data->name}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{$data->email}}</td>
                </tr>
                <tr>
                    <th>Kontak</th>
                    <td>{{$data->contact_number}}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{$data->address}}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{$data->category}}</td>
                </tr>
                <tr>
                    <th>Tanggal Bergabung</th>
                    <td>{{\Carbon\Carbon::parse($data->created_at)->format('d M Y')}}</td>
                </tr>
            </tbody>
        </table>
        <div class="pt-3 mt-3 pr-1 mr-1">
            <a href="#" class="btn btn-outline-danger rounded-pill float-right" data-target="#show{{$data->id}}" data-dismiss="modal"> <i class="fa-solid fa-xmark"></i> Tutup</a>
        </div>
    </div>
    <!-- /.card-body -->
</div>
