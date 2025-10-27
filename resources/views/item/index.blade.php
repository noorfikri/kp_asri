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
    const addRowButton = document.getElementById('addRow');
    if (!addRowButton) {
        return;
    }
    addRowButton.addEventListener('click', function () {
        const table = document.getElementById('stockTable').getElementsByTagName('tbody')[0];
        const newRow = table.rows[0].cloneNode(true);
        Array.from(newRow.querySelectorAll('select, input')).forEach(function (el) {
            el.name = el.name.replace(/\d+/, rowIdx);
            if (el.name.includes('stock')) {
                el.value = '0';
            } else {
                el.value = '';
            }
            el.classList.remove('is-invalid');
        });
        table.appendChild(newRow);
        rowIdx++;
    });

    document.getElementById('stockTable').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            const removeRowButton = e.target;
            if (!removeRowButton) {
                return;
            }
            const rows = this.getElementsByTagName('tbody')[0].rows;
            if (rows.length > 1) {
                e.target.closest('tr').remove();
            }
        }
    });
}

function editAddStock(rowIdx) {
    const addRowButton = document.getElementById('addRow');
    if (!addRowButton) {
        return;
    }
    addRowButton.addEventListener('click', function () {
        const table = document.getElementById('stockTable').getElementsByTagName('tbody')[0];
        const newRow = table.rows[0].cloneNode(true);
        Array.from(newRow.querySelectorAll('select, input')).forEach(function (el) {
            el.name = el.name.replace(/\d+/, rowIdx);
            if (el.tagName === 'SELECT') {
                el.disabled = false;
                el.value = '';
            } else if (el.name.includes('stock')) {
                el.value = '0';
            } else {
                el.value = '';
            }
            el.classList.remove('is-invalid');
        });
        const removeButton = newRow.querySelector('.remove-row');
        if (removeButton) {
            removeButton.disabled = false;
        }
        table.appendChild(newRow);
        rowIdx++;
    });

    document.getElementById('stockTable').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            const removeRowButton = e.target;
            if (!removeRowButton.disabled) {
                const rows = this.getElementsByTagName('tbody')[0].rows;
                if (rows.length > 1) {
                    e.target.closest('tr').remove();
                }
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
    <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Daftar Barang</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Beranda</a></li>
            <li class="breadcrumb-item active">Daftar Barang</li>
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
                @can('create', App\Models\Item::class)
                <a href="{{url('admin/items/create')}}" class=" btn btn-primary rounded float-right rounded-pill"
                data-target="#showcreatemodal" data-toggle='modal' onclick="showCreate()">
                <i class="fas fa-plus"></i>
                Tambah Barang Baru
                </a>
                @endcan
            </div>
            <div class="modal fade" id="showcreatemodal" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" id="createmodal">
                                    <div class="overlay dark">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                    </div>
                </div>
            </div>
        </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-hover projects">
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
                @if ($data->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">
                        Tidak ada data yang tersedia dalam daftar barang.
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
                        <a class="btn btn-outline-primary rounded-pill" href="{{url('admin/items/'.$d->id)}}"
                            data-target="#show{{$d->id}}" data-toggle='modal' onclick="showDetails({{$d->id}})">
                            <i class="fas fa-folder">
                            </i>
                            Lihat
                        </a>
                        @can('update', $d)
                        <a class="btn btn-outline-info rounded-pill" href="{{url('admin/items/'.$d->id.'/edit')}}"
                            data-target="#edit{{$d->id}}" data-toggle='modal' onclick="showEdit({{$d->id}},{{ $d->stocks->count() }})">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Ubah
                        </a>
                        @endcan
                        @can('delete', $d)
                        <a class="btn btn-outline-danger rounded-pill" href="{{url('admin/items/'.$d->id)}}"
                            data-target="#delete{{$d->id}}" data-toggle='modal'>
                            <i class="fas fa-trash">
                            </i>
                            Hapus
                        </a>
                        @endcan
                    </td>
                    <td>
                        <div class="modal fade" id="show{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content" id="itemdetail{{$d->id}}">
                                    <div class="overlay dark">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="edit{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content" id="itemedit{{$d->id}}">
                                    <div class="overlay dark">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="delete{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" id="itemdelete{{$d->id}}">
                                    <div class="card modal-body card-outline card-danger shadow-lg p-0">
                                    <form method='POST' action="{{route('items.destroy', $d->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header d-flex justify-content-between my-0 py-0 border-0">
                                            <div class="bg-danger  py-2 px-3 my-0 rounded-bottom rounded-3">
                                                <h4 class="modal-title"><i class="fa-solid fa-trash"></i> Hapus Barang</h4>
                                            </div>
                                          </div>
                                          <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus barang "{{$d->name}}"?</p>
                                          </div>
                                          <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-outline-dark rounded-pill" data-dismiss="modal" data-target="delete{{$d->id}}"> <i class="fa-solid fa-xmark"></i> Batal</button>
                                            <button type="submit" class="btn btn-danger rounded-pill"><i class="fas fa-trash"></i> Hapus Barang</button>
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
<!-- Vertically centered scrollable modal -->
