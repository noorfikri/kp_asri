@extends('layouts.adminlte3')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Informasi Toko</h3>
                    </div>
                    <form method="POST" action="{{ route('storeinfo.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Toko</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $storeInfo->name ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $storeInfo->description ?? '') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $storeInfo->address ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="banner">Banner Toko</label>
                                <input type="file" class="form-control" id="banner" name="banner">
                                @if(!empty($storeInfo->banner))
                                    <img src="{{ asset($storeInfo->banner) }}" alt="Banner" class="img-fluid mt-2" style="max-height:80px;">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo Toko</label>
                                <input type="file" class="form-control" id="logo" name="logo">
                                @if(!empty($storeInfo->logo))
                                    <img src="{{ asset($storeInfo->logo) }}" alt="Logo" class="img-fluid mt-2" style="max-height:80px;">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone">Telepon</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $storeInfo->phone ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="whatsapp">WhatsApp</label>
                                <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $storeInfo->whatsapp ?? '') }}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
      <!-- /.content -->
@endsection
