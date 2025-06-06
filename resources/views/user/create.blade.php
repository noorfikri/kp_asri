<div class="card card-primary shadow-lg">
    <div class="card-header">
        <h3 class="card-title">Buat Akun Baru</h3>

        <div class="card-tools">
            <button type="button" class="close" data-target="#showcreatemodal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <img class="img-fluid pad" id="create-preview-image" src="{{ asset('assets/img/Placeholder_Image.png') }}" alt="Foto">
            <div class="form-group">
                <label for="inputImage">Gambar Profil</label>
                <input type="file" id="inputImageCreate" name="image" class="form-control" value="Masukkan Gambar" onchange="createPreviewImage(event)">
            </div>
            <div class="form-group">
                <label for="inputName">Nama</label>
                <input type="text" id="inputName" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" id="inputEmail" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="inputContact">Kontak</label>
                <input type="text" id="inputContact" name="contact_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="inputAddress">Alamat</label>
                <input type="text" id="inputAddress" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="inputPassword">Kata Sandi</label>
                <input type="password" id="inputPassword" name="password" class="form-control" required>
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
                <a href="#" class="btn btn-secondary" data-target="#showcreatemodal" data-dismiss="modal">Batal</a>
                <input type="submit" value="Buat" class="btn btn-success float-right">
            </div>
        </div>
    </form>
</div>
