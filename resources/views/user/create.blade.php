<div class="card card-outline card-primary shadow-lg p-0">
    <div class="card-header d-flex justify-content-between my-0 py-0 border-0">
        <div class="bg-primary py-2 px-3 my-0 rounded-bottom rounded-3">
        <h3 class="card-title"><i class="fas fa-plus"></i> Buat Akun Baru</h3>
        </div>
    </div>
    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <img class="img-fluid pad" id="create-preview-image" src="{{ asset('assets/img/Placeholder_Image.png') }}" alt="Foto">
            <div class="form-group">
            <label for="inputImage">Gambar Profil</label>
            <div class="input-group">
                      <div class="custom-file">
                        <input type="file" id="inputImageCreate" name="image" class="form-control @error('image') is-invalid @enderror" onchange="createPreviewImage(event)">
                        <label class="custom-file-label" for="inputImageCreate">Masukkan Gambar Profil</label>
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                      </div>
            </div>
            </div>
            <div class="form-group">
                <label for="inputName">Nama</label>
                <input type="text" id="inputName" name="name" class="form-control" required>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" id="inputEmail" name="email" class="form-control" required>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputContact">Kontak</label>
                <input type="text" id="inputContact" name="contact_number" class="form-control" required>
                @error('contact_number')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputAddress">Alamat</label>
                <input type="text" id="inputAddress" name="address" class="form-control" required>
                @error('address')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputPassword">Kata Sandi</label>
                <input type="password" id="inputPassword" name="password" class="form-control" required>
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputRole">Peran</label>
                <select id="inputRole" name="category" class="form-control custom-select" required>
                    <option selected="" disabled="">Pilih salah satu</option>
                    <option value="staff">Staff</option>
                    <option value="owner">Owner</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <div class="col-12">
                <a href="#" class="btn btn-outline-danger rounded-pill" data-target="#showcreatemodal" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Batal</a>
                <button type="submit" class="btn btn-success float-right rounded-pill"><i class="fa-solid fa-floppy-disk"></i> Simpan Akun Baru</button>
            </div>
        </div>
    </form>
</div>
