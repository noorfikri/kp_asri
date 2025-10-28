@extends('layouts.adminlte3')

@section('javascript')
<script>
function showDetails(message_id){
    $.ajax({
        type:'POST',
        url:'{{route("messages.showDetail")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
            'id':message_id
        },
        success: function(data){
            $('#messagedetail'+message_id).html(data.msg)
        }
    });
}
</script>
@endsection

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Daftar Pesan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Beranda</a></li>
                    <li class="breadcrumb-item active">Daftar Pesan</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="alert alert-primary">
        <h5 class="color"><strong><i class="fa-solid fa-circle-info"></i> Bantuan</strong></h5>
        Halaman ini adalah halaman <strong>Pesan</strong>. Anda dapat memanajemen <strong>Daftar Pesan</strong> yang dikirim oleh pengunjung.<br>
        <br> <strong>Cara penggunaan :</strong>
        <ul>
            <li>
                <p class="my-0 py-0">
                    <i class="fas fa-folder"></i> <strong>Lihat</strong> : Untuk melihat <strong>Rincian Pesan</strong> yang terdapat didalam sistem.
                </p>
            </li>
            <li>
                <p class="my-0 py-0">
                    <i class="fas fa-trash"></i> <strong> Hapus </strong>: Untuk melakukan <strong>Penghapusan Data Pesan</strong> yang terdapat didalam sistem.
                </p>
            </li>
        </ul>
    </div>
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <div class="card-tools input-group">
                <div class="flex-grow-1"></div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover projects">
                <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th style="width: 10%">Nama</th>
                        <th style="width: 10%">Kontak</th>
                        <th style="width: 20%">Subjek</th>
                        <th style="width: 10%">Kategori</th>
                        <th style="width: 25%">Pesan</th>
                        <th style="width: 10%">Waktu Kirim</th>
                        <th style="width: 25%"></th>
                        <th style="width: 1%"></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->isEmpty())
                    <tr>
                        <td colspan="9" class="text-center">
                            Tidak ada data yang tersedia dalam daftar pesan.
                        </td>
                    </tr>
                    @else
                    @foreach ($data as $message)
                    <tr id="tr{{ $message->id }}">
                        <td>{{ $message->id }}</td>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->contact }}</td>
                        <td>{{ $message->subject }}</td>
                        <td>{{ $message->category }}</td>
                        <td>
                            <div style="max-height: 100px; overflow-y: auto;">
                                {{ Str::words($message->message, 10, '...') }}
                            </div>
                        </td>
                        <td>{{ $message->post_time }}</td>
                        <td class="project-actions text-right">
                            <a class="btn btn-outline-primary rounded-pill btn-sm" href="{{url('admin/messages/'.$message->id)}}"
                                data-target="#show{{$message->id}}" data-toggle='modal' onclick="showDetails({{$message->id}})">
                                <i class="fas fa-folder">
                                </i>
                                Lihat
                            </a>
                            <a class="btn btn-outline-danger rounded-pill btn-sm" href="#" data-target="#delete{{ $message->id }}" data-toggle="modal">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                        <td>
                            <div class="modal fade" id="show{{$message->id}}" tabindex="-1" role="basic" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" id="messagedetail{{$message->id}}">
                                    <div class="overlay dark">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="delete{{ $message->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="card modal-body card-outline card-danger shadow-lg p-0">
                                        <form method="POST" action="{{ route('messages.destroy', $message->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header d-flex justify-content-between my-0 py-0 border-0">
                                                <div class="bg-danger py-2 px-3 my-0 rounded-bottom rounded-3">
                                                <h4 class="modal-title"><i class="fa-solid fa-trash"></i> Hapus Pesan</h4>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus pesan dari "{{ $message->name }}"?</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-outline-dark rounded-pill" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Batal</button>
                                                <button type="submit" class="btn btn-danger rounded-pill float-right"><i class="fas fa-trash"></i> Hapus Pesan</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection
