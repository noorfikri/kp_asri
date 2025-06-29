@extends('layouts.adminlte3')

@section('javascript')
<script>
function showDetails(item_id){
    $.ajax({
        type:'POST',
        url:'{{route("items.showDetail")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
            'id':item_id
        },
        success: function(data){
            $('#itemdetail'+item_id).html(data.msg)
        }
    });
}

function showCreate(){
    $.ajax({
        type:'POST',
        url:'{{route("items.showCreate")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
        },
        success: function(data){
            $('#createmodal').html(data.msg)

            $("#inputImageCreate").change(function(){
                createPreviewImage(this);
            });

            createAddStock();
        }
    });
}

function showEdit(item_id, row_id){
    $.ajax({
        type:'POST',
        url:'{{route("items.showEdit")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
            'id':item_id,
        },
        success: function(data){
            $('#itemedit'+item_id).html(data.msg)

            $("#inputImageEdit").change(function(){
                editPreviewImage(this);
            });

            editAddStock(row_id);
        }
    });
}

function createAddStock(){
    let rowIdx = 1;
    document.getElementById('addRow').addEventListener('click', function () {
        const table = document.getElementById('stockTable').getElementsByTagName('tbody')[0];
        const newRow = table.rows[0].cloneNode(true);
        Array.from(newRow.querySelectorAll('select, input')).forEach(function (el) {
            el.name = el.name.replace(/\d+/, rowIdx);
            el.value = '';
            el.classList.remove('is-invalid');
        });
        table.appendChild(newRow);
        rowIdx++;
    });

    document.getElementById('stockTable').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            const rows = this.getElementsByTagName('tbody')[0].rows;
            if (rows.length > 1) {
                e.target.closest('tr').remove();
            }
        }
    });
}

function editAddStock(rowIdx) {
    document.getElementById('addRow').addEventListener('click', function () {
        const table = document.getElementById('stockTable').getElementsByTagName('tbody')[0];
        const newRow = table.rows[0].cloneNode(true);
        Array.from(newRow.querySelectorAll('select, input')).forEach(function (el) {
            el.name = el.name.replace(/\d+/, rowIdx);
            el.value = '';
            el.classList.remove('is-invalid');
        });
        table.appendChild(newRow);
        rowIdx++;
    });

    document.getElementById('stockTable').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            const rows = this.getElementsByTagName('tbody')[0].rows;
            if (rows.length > 1) {
                e.target.closest('tr').remove();
            }
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
          <h1>Daftar Barang</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Daftar Barang</li>
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
                <a href="{{url('admin/items/create')}}" class=" btn btn-primary rounded float-right"
                data-target="#showcreatemodal" data-toggle='modal' onclick="showCreate()">Tambah</a>
            </div>
            <div class="modal fade" id="showcreatemodal" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" id="createmodal">
                        <!-- put animated gif here -->
                        <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
                    </div>
                </div>
            </div>
        </div>
      <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">
                        #
                    </th>
                    <th style="width: 15%">
                        Nama
                    </th>
                    <th style="width: 10%">
                        Harga
                    </th>
                    <th style="width: 10%" class="text-center">
                        Stok
                    </th>
                    <th style="width: 15%">
                    </th>
                    <th style="width: 1%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                <tr id='tr{{$d->id}}'>
                    <td>
                        {{$d->id}}
                    </td>
                    <td>
                        <a>
                            {{$d->name}}
                        </a>
                        <br/>
                        <small>Kategori: {{$d->category->name}}</small><br>
                         <small>Merek: {{$d->brand->name}}</small>
                    </td>
                    <td class="project_progress">
                        @toIDR($d->price)
                    </td>
                    <td class="text-center">
                        {{ $d->stocks->sum('stock') }}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{url('admin/items/'.$d->id)}}"
                            data-target="#show{{$d->id}}" data-toggle='modal' onclick="showDetails({{$d->id}})">
                            <i class="fas fa-folder">
                            </i>
                            Lihat
                        </a>
                        <a class="btn btn-info btn-sm" href="{{url('admin/items/'.$d->id.'/edit')}}"
                            data-target="#edit{{$d->id}}" data-toggle='modal' onclick="showEdit({{$d->id}},{{ $d->stocks->count() }})">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Ubah
                        </a>
                        <a class="btn btn-danger btn-sm" href="{{url('admin/items/'.$d->id)}}"
                            data-target="#delete{{$d->id}}" data-toggle='modal'>
                            <i class="fas fa-trash">
                            </i>
                            Hapus
                        </a>
                    </td>
                    <td>
                        <div class="modal fade" id="show{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content" id="itemdetail{{$d->id}}">
                                    <!-- put animated gif here -->
                                    <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="edit{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content" id="itemedit{{$d->id}}">
                                    <!-- put animated gif here -->
                                    <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="delete{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" id="itemdelete{{$d->id}}">
                                    <form method='POST' action="{{route('items.destroy', $d->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header bg-danger">
                                            <h4 class="modal-title">Hapus Barang</h4>
                                            <button type="button" class="close" data-dismiss="modal" data-target="delete{{$d->id}}" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus barang "{{$d->name}}"?</p>
                                          </div>
                                          <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal" data-target="delete{{$d->id}}">Tutup</button>
                                            <button type="submit" class="btn btn-danger">Hapus Barang</button>
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
<!-- Vertically centered scrollable modal -->
