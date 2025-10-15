@extends('layouts.adminlte3')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Informasi Toko</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Beranda</li>
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
                <div class="card card-outline card-primary p-0">
                    <div class="card-header d-flex justify-content-between my-0 py-0 border-0">
                        <div class="bg-primary py-2 px-3 my-0 rounded-bottom rounded-3">
                            <h3 class="card-title"><i class="fa-solid fa-pen-to-square"></i> Ubah Informasi Toko</h3>
                        </div>
                    </div>
<form method="POST" action="{{ route('storeinfo.update') }}" enctype="multipart/form-data">
@csrf
@method('POST')
    <div class="card-body">
        <div class="form-group form-">
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
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="banner" name="banner">
                    <label class="custom-file-label" for="exampleInputFile">Masukkan Banner Toko</label>
                </div>
            </div>
            @if(!empty($storeInfo->banner))
                <img src="{{ asset($storeInfo->banner) }}" alt="Banner" class="img-fluid mt-2" style="max-height:80px;">
            @endif
        </div>
        <div class="form-group">
            <label for="logo">Logo Toko</label>
            <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="logo" name="logo">
                        <label class="custom-file-label" for="exampleInputFile">Masukkan Logo Toko</label>
                      </div>
            </div>
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
        <div class="form-group">
            <button type="submit" class="btn-lg btn-primary rounded-pill float-right"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
        </div>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
      <!-- /.content -->
@endsection
