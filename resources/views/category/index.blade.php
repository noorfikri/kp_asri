@extends('layouts.adminlte3')

@section('javascript')
<script>
function showCreate(){
    $.ajax({
        type:'POST',
        url:'{{route("categories.showCreate")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
        },
        success: function(data){
            $('#createmodal').html(data.msg)
        }
    });
}

function showEdit(category_id){
    $.ajax({
        type:'POST',
        url:'{{route("categories.showEdit")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
            'id':category_id,
        },
        success: function(data){
            $('#categoryedit'+category_id).html(data.msg)
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
    <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Daftar Kategori</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Daftar Kategori</li>
          </ol>
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
                <a href="{{url('admin/categories/create')}}" class=" btn btn-primary float-right rounded-pill"
                data-target="#showcreatemodal" data-toggle='modal' onclick="showCreate()"><i class="fas fa-plus"></i> Tambah Kategori Baru</a>
            </div>
            <div class="modal fade" id="showcreatemodal" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" id="createmodal">
                                    <div class="overlay dark">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                    </div>
                </div>
            </div>
        </div>
      <div class="card-body p-0">
        <table class="table table-hover projects">
            <thead>
                <tr>
                    <th style="width: 1%">
                        #
                    </th>
                    <th style="width: 50%">
                        Nama
                    </th>
                    <th style="width: 20%">
                    </th>
                    <th style="width: 1%">
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($data->isEmpty())
                <tr>
                    <td colspan="3" class="text-center">
                        Tidak ada data dalam daftar kategori.
                    </td>
                </tr>
                @else
                @foreach ($data as $d)
                <tr id='tr{{$d->id}}'>
                    <td>
                        {{$d->id}}
                    </td>
                    <td>
                        <a>
                            {{$d->name}}
                        </a>
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-outline-info rounded-pill" href="{{url('admin/categories/'.$d->id.'/edit')}}"
                            data-target="#edit{{$d->id}}" data-toggle='modal' onclick="showEdit({{$d->id}})">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Ubah
                        </a>
                        <a class="btn btn-outline-danger rounded-pill" href="{{url('admin/categories/'.$d->id)}}"
                            data-target="#delete{{$d->id}}" data-toggle='modal'>
                            <i class="fas fa-trash">
                            </i>
                            Hapus
                        </a>
                    </td>
                    <td>
                        <div class="modal fade" id="edit{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" id="categoryedit{{$d->id}}">
                                    <div class="overlay dark">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="delete{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" id="categorydelete{{$d->id}}">
                                    <div class="card modal-body card-outline card-danger shadow-lg p-0">
                                    <form method='POST' action="{{route('categories.destroy', $d->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header d-flex justify-content-between my-0 py-0 border-0">
                                            <div class="bg-danger py-2 px-3 my-0 rounded-bottom rounded-3">
                                                <h4 class="modal-title"> <i class="fa-solid fa-trash"></i> Hapus Kategori</h4>
                                            </div>
                                          </div>
                                          <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus kategori "{{$d->name}}"?</p>
                                          </div>
                                          <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-outline-dark rounded-pill" data-dismiss="modal" data-target="delete{{$d->id}}"> <i class="fa-solid fa-xmark"></i> Batal</button>
                                            <button type="submit" class="btn btn-danger rounded-pill"><i class="fas fa-trash"></i> Hapus Kategori</button>
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
