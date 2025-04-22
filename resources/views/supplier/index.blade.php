@extends('layouts.adminlte3')

@section('javascript')
{{-- <script>
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
        }
    });
}
</script> --}}
@endsection

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
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
            <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                <input type="search" class="form-control rounded m-auto" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                <button type="button" class="btn btn-outline-primary rounded" data-mdb-ripple-init>Cari</button>
                <a href="{{url('suppliers/create')}}" class=" btn btn-primary rounded"
                data-target="#showcreatemodal" data-toggle='modal' onclick="showCreate()">Tambah</a>
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
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">
                        #
                    </th>
                    <th style="width: 20%">
                        Name
                    </th>
                    <th style="width: 30%">
                        Address
                    </th>
                    <th style="width: 20%">
                        Telephone
                    </th>
                    <th style="width: 20%">
                    </th>
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
                    </td>
                    <td>
                        {{$d->address}}
                    </td>
                    <td>
                        {{$d->telephone}}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{url('suppliers/'.$d->id)}}"
                            data-target="#show{{$d->id}}" data-toggle='modal' onclick="showDetails({{$d->id}})">
                            <i class="fas fa-folder">
                            </i>
                            View
                        </a>
                        <div class="modal fade" id="show{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" id="supplierdetail{{$d->id}}">
                                    <!-- put animated gif here -->
                                    <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-info btn-sm" href="{{url('suppliers/'.$d->id.'/edit')}}"
                            data-target="#edit{{$d->id}}" data-toggle='modal' onclick="showEdit({{$d->id}})">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <div class="modal fade" id="edit{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" id="supplieredit{{$d->id}}">
                                    <!-- put animated gif here -->
                                    <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-danger btn-sm" href="{{url('suppliers/'.$d->id)}}"
                            data-target="#delete{{$d->id}}" data-toggle='modal'>
                            <i class="fas fa-trash">
                            </i>
                            Delete
                        </a>
                        <div class="modal fade" id="delete{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" id="supplierdelete{{$d->id}}">
                                    <form method='POST' action="{{route('suppliers.destroy', $d->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header bg-danger">
                                            <h4 class="modal-title">Delete Supplier</h4>
                                            <button type="button" class="close" data-dismiss="modal" data-target="delete{{$d->id}}" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <p>Are you sure you want to delete supplier "{{$d->name}}"?</p>
                                          </div>
                                          <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal" data-target="delete{{$d->id}}">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete Supplier</button>
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
