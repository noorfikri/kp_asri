<div class="card modal-body card-primary shadow-lg p-0">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title"><i class="fas fa-info-circle"></i> Detail || {{$data->name}}</h3>
        <button type="button" class="close ml-auto" data-dismiss="modal" data-target="show{{$data->id}}" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <th>Nama</th>
                    <td>{{$data->name}}</td>
                </tr>
                <tr>
                    <th>Kontak</th>
                    <td>{{$data->contact}}</td>
                </tr>
                <tr>
                    <th>Subjek</th>
                    <td>{{$data->subject}}</td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>{{$data->category}}</td>
                </tr>
                <tr>
                    <th>Waktu Kirim</th>
                    <td>{{$data->post_time}}</td>
                </tr>
                <tr>
                    <th>Pesan</th>
                    <td><pre style="white-space: pre-wrap;">{{$data->message}}</pre></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
