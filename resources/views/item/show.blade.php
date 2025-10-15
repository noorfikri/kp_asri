    <div class="card modal-body card-outline card-primary shadow-lg p-0">
        <div class="card-header d-flex justify-content-between my-0 py-0 border-0">
            <div class="bg-primary py-2 px-3 my-0 rounded-bottom rounded-3">
                <h3 class="card-title"><i class="fas fa-info"></i> Detail || {{$data->name}}</h3>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body border-0">
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
            <div class="pt-3 mt-3 pr-1 mr-1">
                <a href="#" class="btn btn-outline-danger rounded-pill float-right" data-target="#show{{$data->id}}" data-dismiss="modal"> <i class="fa-solid fa-xmark"></i> Tutup</a>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
