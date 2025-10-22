@extends('layouts.adminlte3')

@section('javascript')
<script>
function showDetails(supplier_id){
    $.ajax({
        type:'POST',
        url:'{{route("suppliers.showDetail")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
            'id':supplier_id
        },
        success: function(data){
            $('#supplierdetail'+supplier_id).html(data.msg)
        }
    });
}

function showCreate(){
    $.ajax({
        type:'POST',
        url:'{{route("suppliers.showCreate")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
        },
        success: function(data){
            $('#createmodal').html(data.msg)

            $("#inputImageCreate").change(function(){
                createPreviewImage(this);
            });
        }
    });
}

function showEdit(supplier_id){
    $.ajax({
        type:'POST',
        url:'{{route("suppliers.showEdit")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
            'id':supplier_id,
        },
        success: function(data){
            $('#supplieredit'+supplier_id).html(data.msg)

            $("#inputImageEdit").change(function(){
                editPreviewImage(this);
            });
        }
    });
}

function createPreviewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#create-preview-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function editPreviewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#edit-preview-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
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
          <h1>Daftar Supplier</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Daftar Supplier</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <div class="card-tools input-group">
                <div class="flex-grow-1"></div>
                <a href="{{url('admin/suppliers/create')}}" class=" btn btn-primary rounded-pill float-right"
                data-target="#showcreatemodal" data-toggle='modal' onclick="showCreate()"><i class="fas fa-plus"></i> Tambah Supplier Baru</a>
            </div>
            <div class="modal fade" id="showcreatemodal" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" id="createmodal">
                        <!-- put animated gif here -->
                        <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
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
                    <th style="width: 20%">
                        Nama
                    </th>
                    <th style="width: 30%">
                        Alamat
                    </th>
                    <th style="width: 20%">
                        Nomor Telepon
                    </th>
                    <th style="width: 20%">
                    </th>
                    <th style="width: 1%"></th>
                </tr>
            </thead>
            <tbody>
                @if ($data->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">
                        Tidak ada data yang tersedia dalam daftar supplier.
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
                    <td>
                        {{$d->address}}
                    </td>
                    <td>
                        {{$d->telephone}}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-outline-primary rounded-pill" href="{{url('admin/suppliers/'.$d->id)}}"
                            data-target="#show{{$d->id}}" data-toggle='modal' onclick="showDetails({{$d->id}})">
                            <i class="fas fa-folder">
                            </i>
                            Lihat
                        </a>
                        <a class="btn btn-outline-info rounded-pill" href="{{url('admin/suppliers/'.$d->id.'/edit')}}"
                            data-target="#edit{{$d->id}}" data-toggle='modal' onclick="showEdit({{$d->id}})">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Ubah
                        </a>
                        <a class="btn btn-outline-danger rounded-pill" href="{{url('admin/suppliers/'.$d->id)}}"
                            data-target="#delete{{$d->id}}" data-toggle='modal'>
                            <i class="fas fa-trash">
                            </i>
                            Hapus
                        </a>
                    </td>
                    <td>
                        <div class="modal fade" id="show{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" id="supplierdetail{{$d->id}}">
                                    <!-- put animated gif here -->
                                    <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="edit{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" id="supplieredit{{$d->id}}">
                                    <!-- put animated gif here -->
                                    <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="delete{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" id="supplierdelete{{$d->id}}">
                                    <div class="card modal-body card-outline card-danger shadow-lg p-0">
                                    <form method='POST' action="{{route('suppliers.destroy', $d->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header d-flex justify-content-between my-0 py-0 border-0">
                                            <div class="bg-danger py-2 px-3 my-0 rounded-bottom rounded-3">
                                            <h4 class="modal-title"><i class="fa-solid fa-trash"></i> Hapus Supplier</h4>
                                            </div>>
                                          </div>
                                          <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus supplier "{{$d->name}}"?</p>
                                          </div>
                                          <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-outline-dark rounded-pill" data-dismiss="modal" data-target="delete{{$d->id}}"><i class="fa-solid fa-xmark"></i> Batal</button>
                                            <button type="submit" class="btn btn-danger rounded-pill float-right"> <i class="fa-solid fa-trash"></i> Hapus Supplier</button>
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
