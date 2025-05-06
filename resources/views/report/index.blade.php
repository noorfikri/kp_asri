@extends('layouts.adminlte3')

@section('javascript')
{{--<script>
function showDetails(report_id){
    $.ajax({
        type:'POST',
        url:'{{route("reports.showDetail")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
            'id':report_id
        },
        success: function(data){
            $('#reportdetail'+report_id).html(data.msg)
        }
    });
}

function showCreate(){
    $.ajax({
        type:'POST',
        url:'{{route("reports.showCreate")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
        },
        success: function(data){
            $('#createmodal').html(data.msg)
        }
    });
}

function showEdit(report_id){
    $.ajax({
        type:'POST',
        url:'{{route("reports.showEdit")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
            'id':report_id,
        },
        success: function(data){
            $('#reportedit'+report_id).html(data.msg)
        }
    });
}
</script>--}}
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
          <h1>Daftar Laporan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Daftar Laporan</li>
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
                <input type="search" class="form-control rounded m-auto" placeholder="Cari" aria-label="Cari" aria-describedby="search-addon" />
                <button type="button" class="btn btn-outline-primary rounded" data-mdb-ripple-init>Cari</button>
                <a href="{{url('admin/reports/create')}}" class=" btn btn-primary rounded"
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
                    <th style="width: 15%">
                        Tanggal Laporan
                    </th>
                    <th style="width: 15%">
                        Pembuat Laporan
                    </th>
                    <th style="width: 10%">
                        Jenis
                    </th>
                    <th style="width: 10%">
                        Total Pembelian
                    </th>
                    <th style="width: 10%">
                        Total Penjualan
                    </th>
                    <th style="width: 10%">
                        Arus Kas
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
                            {{$d->report_date}}
                        </a>
                    </td>
                    <td>
                        {{$d->creator->name}}
                    </td>
                    <td>
                        {{$d->type}}
                    </td>
                    <td>
                        @toIDR($d->total_buying)
                    </td>
                    <td>
                        @toIDR($d->total_selling)
                    </td>
                    <td>
                        @toIDR($d->cash_flow)
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{url('admin/reports/'.$d->id)}}"
                            data-target="#show{{$d->id}}" data-toggle='modal' onclick="showDetails({{$d->id}})">
                            <i class="fas fa-folder">
                            </i>
                            Lihat
                        </a>
                        <a class="btn btn-info btn-sm" href="{{url('admin/reports/'.$d->id.'/edit')}}"
                            data-target="#edit{{$d->id}}" data-toggle='modal' onclick="showEdit({{$d->id}})">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Ubah
                        </a>
                        <a class="btn btn-danger btn-sm" href="{{url('admin/reports/'.$d->id)}}"
                            data-target="#delete{{$d->id}}" data-toggle='modal'>
                            <i class="fas fa-trash">
                            </i>
                            Hapus
                        </a>
                    </td>
                    <td>
                        <div class="modal fade" id="show{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" id="reportdetail{{$d->id}}">
                                    <!-- put animated gif here -->
                                    <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="edit{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" id="reportedit{{$d->id}}">
                                    <!-- put animated gif here -->
                                    <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="delete{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" id="reportdelete{{$d->id}}">
                                    <form method='POST' action="{{route('reports.destroy', $d->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header bg-danger">
                                            <h4 class="modal-title">Hapus Laporan</h4>
                                            <button type="button" class="close" data-dismiss="modal" data-target="delete{{$d->id}}" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus laporan bertanggal "{{$d->report_date}}"?</p>
                                          </div>
                                          <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal" data-target="delete{{$d->id}}">Tutup</button>
                                            <button type="submit" class="btn btn-danger">Hapus Laporan</button>
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
