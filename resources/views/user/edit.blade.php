<div class="card card-primary shadow-lg">
    <div class="card-header">
        <h3 class="card-title">Edit Akun Pengguna</h3>

        <div class="card-tools">
            <button type="button" class="close" data-target="#showeditmodal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <form method="POST" action="{{url('admin/users/'.$user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <img class="img-fluid pad" id="edit-preview-image" src="{{asset($user->profile_picture) }}" alt="Foto">
            <div class="form-group">
                <label for="inputImage">Gambar Profil</label>
                <input type="file" id="inputImageEdit" name="image" class="form-control" value="Masukkan Gambar">
            </div>
            <div class="form-group">
                <label for="inputName">Nama</label>
                <input type="text" id="inputName" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" id="inputEmail" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="inputContact">Kontak</label>
                <input type="text" id="inputContact" name="contact_number" class="form-control" value="{{ $user->contact_number }}" required>
            </div>
            <div class="form-group">
                <label for="inputAddress">Alamat</label>
                <input type="text" id="inputAddress" name="address" class="form-control" value="{{ $user->address }}" required>
            </div>
            <div class="form-group">
                <label for="inputPassword">Kata Sandi (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" id="inputPassword" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="inputRole">Peran</label>
                <select id="inputRole" name="category" class="form-control custom-select" required>
                    <option selected="" disabled="">Pilih salah satu</option>
                    <option value="staff" {{ $user->category == 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="owner" {{ $user->category == 'owner' ? 'selected' : '' }}>Owner</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <div class="col-12">
                <a href="#" class="btn btn-secondary" data-target="#showeditmodal" data-dismiss="modal">Batal</a>
                <input type="submit" value="Simpan Perubahan" class="btn btn-success float-right">
            </div>
        </div>
    </form>
</div>
