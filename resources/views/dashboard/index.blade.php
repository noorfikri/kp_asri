@extends('layouts.adminlte3')

@section('javascript')
<script>
document.addEventListener('DOMContentLoaded', function () {

    function previewImage(input, imgId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById(imgId).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    var bannerInput = document.getElementById('banner');
    if (bannerInput) {
        bannerInput.addEventListener('change', function() {
            previewImage(this, 'banner_preview_small');
        });
    }

    var logoInput = document.getElementById('logo');
    if (logoInput) {
        logoInput.addEventListener('change', function() {
            previewImage(this, 'logo_preview_small');
        });
    }

    var homeImageInput = document.getElementById('home_image');
    if (homeImageInput) {
        homeImageInput.addEventListener('change', function() {
            previewImage(this, 'home_image_preview_small');
        });
    }

    var storefrontImageInput = document.getElementById('storefront_image');
    if (storefrontImageInput) {
        storefrontImageInput.addEventListener('change', function() {
            previewImage(this, 'storefront_image_preview_small');
        });
    }

    var mapImageInput = document.getElementById('map_image');
    if (mapImageInput) {
        mapImageInput.addEventListener('change', function() {
            previewImage(this, 'map_image_preview_small');
        });
    }

    const elements = {
        inputs: {
            name: document.getElementById('name'),
            description: document.getElementById('description'),
            address: document.getElementById('address'),
            addressDescription: document.getElementById('address_description'),
            phone: document.getElementById('phone'),
            whatsapp: document.getElementById('whatsapp'),
            navbarColor: document.getElementById('navbar_color'),
            bottomBarColor: document.getElementById('bottom_bar_color'),
            textColor: document.getElementById('text_color'),
            textSecondaryColor: document.getElementById('text_secondary_color'),
        },
        previews: {
            navbar: document.getElementById('preview_navbar'),
            footer: document.getElementById('preview_footer'),
            heroTitle: document.getElementById('preview_hero_title'),
            title: document.getElementById('preview_title'),
            description: document.getElementById('preview_description'),
            address: document.getElementById('preview_address'),
            phone: document.getElementById('preview_phone'),
            whatsapp: document.getElementById('preview_whatsapp'),
            navbarLinks: document.querySelectorAll('#preview_navbar a, #preview_navbar div'),
        }
    };


    function updatePreview() {
        updateText(elements.previews.heroTitle, elements.inputs.name.value);
        updateText(elements.previews.title, elements.inputs.name.value);
        updateText(elements.previews.description, elements.inputs.description.value);
        updateText(elements.previews.phone, elements.inputs.phone.value);
        updateText(elements.previews.whatsapp, elements.inputs.whatsapp.value);

        const addressHtml = elements.inputs.addressDescription.value
            ? elements.inputs.addressDescription.value.replace(/\n/g, '<br>')
            : elements.inputs.address.value;
        updateHTML(elements.previews.address, addressHtml);

        updateStyle(elements.previews.navbar, 'backgroundColor', elements.inputs.navbarColor.value);
        updateStyle(elements.previews.footer, 'backgroundColor', elements.inputs.bottomBarColor.value);

        updateStyle(elements.previews.phone, 'color', elements.inputs.textColor.value);
        updateStyle(elements.previews.whatsapp, 'color', elements.inputs.textColor.value);
        elements.previews.navbarLinks.forEach(el => updateStyle(el, 'color', elements.inputs.textColor.value));

        updateStyle(elements.previews.heroTitle, 'color', elements.inputs.textSecondaryColor.value);
        updateStyle(elements.previews.title, 'color', elements.inputs.textSecondaryColor.value);
        updateStyle(elements.previews.description, 'color', elements.inputs.textSecondaryColor.value);
        updateStyle(elements.previews.address, 'color', elements.inputs.textSecondaryColor.value);

        updateStyle(elements.previews.footer, 'color', '#ffffff');
    }

    function updateText(el, value) {
        if (el) {
            el.textContent = value || '';
        }
    }

    function updateHTML(el, value) {
        if (el) {
            el.innerHTML = value || '';
        }
    }

    function updateStyle(el, property, value) {
        if (el) {
            el.style[property] = value || '';
        }
    }

    for (const key in elements.inputs) {
        const inputElement = elements.inputs[key];
        if (inputElement) {
            inputElement.addEventListener('input', updatePreview);
        }
    }

    updatePreview();
});
</script>
@endsection

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
      <section class="content">
        <div class="container-fluid">

    <form method="POST" action="{{ route('storeinfo.update') }}" enctype="multipart/form-data">
    @csrf
    @method('POST')
        <div class="row">
            <div class="col-md-7">
                <div class="card card-outline card-primary p-0">
                    <div class="card-header d-flex justify-content-between my-0 py-0 border-0">
                        <div class="bg-primary py-2 px-3 my-0 rounded-bottom rounded-3">
                            <h3 class="card-title"><i class="fa-solid fa-pen-to-square"></i> Ubah Informasi Toko</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <hr>
                        <h4>Informasi Toko</h4>
                        <div class="form-group form-">
                            <label for="name">Nama Toko</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $storeInfo->name ?? '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $storeInfo->description ?? '') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat (singkat)</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $storeInfo->address ?? '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="address_description">Deskripsi Alamat (tampilan depan)</label>
                            <textarea class="form-control" id="address_description" name="address_description" rows="3">{{ old('address_description', $storeInfo->address_description ?? '') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="phone">Telepon</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $storeInfo->phone ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label for="whatsapp">WhatsApp</label>
                            <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $storeInfo->whatsapp ?? '') }}">
                        </div>
                        <hr>
                        <h4>Logo dan Banner Toko</h4>
                        <div class="form-group">
                            <label for="banner">Banner Toko</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="banner" name="banner">
                                    <label class="custom-file-label" for="exampleInputFile">Masukkan Banner Toko</label>
                                </div>
                            </div>
                            @if(!empty($storeInfo->banner))
                                <img id="banner_preview_small" src="{{ asset($storeInfo->banner) }}" alt="Banner" class="img-fluid mt-2" style="max-height:80px;">
                            @else
                                <img id="banner_preview_small" src="{{ asset('assets/img/placeholder_banner.jpg') }}" alt="Banner" class="img-fluid mt-2" style="max-height:80px;">
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
                                <img id="logo_preview_small" src="{{ asset($storeInfo->logo) }}" alt="Logo" class="img-fluid mt-2" style="max-height:80px;">
                            @else
                                <img id="logo_preview_small" src="{{ asset('assets/img/favicon.ico') }}" alt="Logo" class="img-fluid mt-2" style="max-height:80px;">
                            @endif
                        </div>
                        <hr>
                        <h4>Gambar Halaman Depan</h4>
                        <div class="form-group">
                            <label for="home_image">Gambar Dalam Toko</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="home_image" name="home_image">
                                    <label class="custom-file-label" for="home_image">Pilih gambar interior</label>
                                </div>
                            </div>
                            @if(!empty($storeInfo->home_image))
                                <img id="home_image_preview_small" src="{{ asset($storeInfo->home_image) }}" alt="Home Image" class="img-fluid mt-2" style="max-height:80px;">
                            @else
                                <img id="home_image_preview_small" src="{{ asset('assets/img/ASRI Interior.jpeg') }}" alt="Home Image" class="img-fluid mt-2" style="max-height:80px;">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="storefront_image">Gambar Depan Toko</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="storefront_image" name="storefront_image">
                                    <label class="custom-file-label" for="storefront_image">Pilih gambar depan toko</label>
                                </div>
                            </div>
                            @if(!empty($storeInfo->storefront_image))
                                <img id="storefront_image_preview_small" src="{{ asset($storeInfo->storefront_image) }}" alt="Storefront Image" class="img-fluid mt-2" style="max-height:80px;">
                            @else
                                <img id="storefront_image_preview_small" src="{{ asset('assets/img/ASRI Front.jpeg') }}" alt="Storefront Image" class="img-fluid mt-2" style="max-height:80px;">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="map_image">Gambar Peta / Alamat</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="map_image" name="map_image">
                                    <label class="custom-file-label" for="map_image">Pilih gambar peta</label>
                                </div>
                            </div>
                            @if(!empty($storeInfo->map_image))
                                <img id="map_image_preview_small" src="{{ asset($storeInfo->map_image) }}" alt="Map Image" class="img-fluid mt-2" style="max-height:80px;">
                            @else
                                <img id="map_image_preview_small" src="{{ asset('assets/img/Map ASRI.PNG') }}" alt="Map Image" class="img-fluid mt-2" style="max-height:80px;">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Pratinjau Halaman Depan</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div id="preview_navbar" class="p-2" style="background-color: {{ $storeInfo->navbar_color ?? '#ffffff' }};">
                                    <div class="d-flex justify-content-between">
                                        <span class="font-weight-bold" style="color: {{ $storeInfo->text_color ?? '#000' }};">{{ $storeInfo->name }}</span>
                                        <div>
                                            <a href="#" class="mx-2" style="color: {{ $storeInfo->text_secondary_color ?? '#6c757d' }};">Beranda</a>
                                            <a href="#" class="mx-2" style="color: {{ $storeInfo->text_secondary_color ?? '#6c757d' }};">Galeri</a>
                                            <a href="#" class="mx-2" style="color: {{ $storeInfo->text_secondary_color ?? '#6c757d' }};">Kontak</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center p-5" id="preview_hero">
                                <h2 id="preview_hero_title" style="color: {{ $storeInfo->text_secondary_color ?? '#000' }};">{{ $storeInfo->name }}</h2>
                            </div>
                            <div class="col-12">
                                <div class="row p-3">
                                        <h4 id="preview_title" style="color: {{ $storeInfo->text_secondary_color ?? '#000' }};">{{ $storeInfo->name }}</h4>
                                        <p id="preview_description" style="color: {{ $storeInfo->text_secondary_color ?? '#666' }}">{{ $storeInfo->description }}</p>
                                        <br>
                                        <h5 id="preview_address_title" style="color: {{ $storeInfo->text_secondary_color ?? '#000' }};"><strong>Kontak</strong></h5>
                                        <div id="preview_address" style="font-size:13px; color: {{ $storeInfo->text_color ?? '#000' }};">Anda dapat menghubungi kami di : </div>
                                        <div style="margin-top:8px; font-size:13px;">
                                            <h6><strong id="preview_phone">{{ $storeInfo->phone }}</strong></h6>
                                            <h6><strong id="preview_whatsapp">{{ $storeInfo->whatsapp }}</strong></h6>
                                        </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="preview_footer" class="p-2 text-center text-white" style="background-color: {{ $storeInfo->bottom_bar_color ?? '#f8f9fa' }};">
                                    Website {{ $storeInfo->name }} ©
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Warna Tema</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="navbar_color">Warna Navbar</label>
                                <input type="color" id="navbar_color" name="navbar_color" class="form-control form-control-sm" value="{{ old('navbar_color', $storeInfo->navbar_color ?? '#ffffff') }}">
                            </div>
                            <div class="col-6 mb-2">
                                <label for="bottom_bar_color">Bar Bawah</label>
                                <input type="color" id="bottom_bar_color" name="bottom_bar_color" class="form-control form-control-sm" value="{{ old('bottom_bar_color', $storeInfo->bottom_bar_color ?? '#ffffff') }}">
                            </div>
                            <div class="col-6 mb-2">
                                <label for="text_color">Warna Teks Primer</label>
                                <input type="color" id="text_color" name="text_color" class="form-control form-control-sm" value="{{ old('text_color', $storeInfo->text_color ?? '#000000') }}">
                            </div>
                            <div class="col-6 mb-0">
                                <label for="text_secondary_color">Warna Teks Sekunder</label>
                                <input type="color" id="text_secondary_color" name="text_secondary_color" class="form-control form-control-sm" value="{{ old('text_secondary_color', $storeInfo->text_secondary_color ?? '#666666') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        <button type="submit" class="btn btn-lg btn-primary rounded-pill"><i class="fa-solid fa-floppy-disk"></i> Simpan Seluruh Perubahan</button>
                    </div>
                </div>
                            </div>
                          </section>
                          <!-- /.content -->
                    @endsection
