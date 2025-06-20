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
                <img class="img-fluid rounded shadow-sm" src="{{ asset($data->image) }}" alt="Photo">
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
                        <th>Merek</th>
                        <td>{{$data->brand->name}}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{$data->category->name}}</td>
                    </tr>
                    <tr>
                        <th>Stok Per Warna dan Ukuran</th>
                        <td>
                            <table class="table table-sm table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>Ukuran</th>
                                        <th>Warna</th>
                                        <th>Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->stocks as $stock)
                                    <tr>
                                        <td>{{ $stock->size->name }}</td>
                                        <td>{{ $stock->colour->name }}</td>
                                        <td>{{ $stock->stock }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>@toIDR($data->price)</td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>{{$data->stock}}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{$data->description}}</td>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <td>{{$data->note}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
