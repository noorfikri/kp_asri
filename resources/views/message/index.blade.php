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
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                    <li class="breadcrumb-item active">Daftar Pesan</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <div class="card-tools input-group">
                <div class="flex-grow-1"></div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th style="width: 15%">Nama</th>
                        <th style="width: 15%">Kontak</th>
                        <th style="width: 20%">Subjek</th>
                        <th style="width: 15%">Kategori</th>
                        <th style="width: 25%">Pesan</th>
                        <th style="width: 15%">Waktu Kirim</th>
                        <th style="width: 10%"></th>
                        <th style="width: 1%"></th>
                    </tr>
                </thead>
                <tbody>
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
                            <a class="btn btn-primary btn-sm" href="{{url('admin/messages/'.$message->id)}}"
                                data-target="#show{{$message->id}}" data-toggle='modal' onclick="showDetails({{$message->id}})">
                                <i class="fas fa-folder">
                                </i>
                                Lihat
                            </a>
                            <a class="btn btn-danger btn-sm" href="#" data-target="#delete{{ $message->id }}" data-toggle="modal">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                        <td>
                            <div class="modal fade" id="show{{$message->id}}" tabindex="-1" role="basic" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" id="messagedetail{{$message->id}}">
                                        <!-- put animated gif here -->
                                        <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="delete{{ $message->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('messages.destroy', $message->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header bg-danger">
                                                <h4 class="modal-title">Hapus Pesan</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus pesan dari "{{ $message->name }}"?</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-danger">Hapus Pesan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection
