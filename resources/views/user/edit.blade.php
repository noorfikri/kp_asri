<div class="card card-outline card-info shadow-lg p-0">
    <div class="card-header d-flex justify-content-between align-items-center my-0 py-0 border-0">
        <div class="bg-info py-2 px-3 my-0 rounded-bottom rounded-3>
        <h3 class="card-title"><i class="fa-solid fa-pen-to-square"></i> Ubah Akun Pengguna</h3>
        </div>
    </div>
    <form method="POST" action="{{url('admin/users/'.$user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <img class="img-fluid pad" id="edit-preview-image" src="{{asset($user->profile_picture) }}" alt="Foto">
            <div class="form-group">
            <label for="inputImage">Gambar Profil</label>
            <div class="input-group">
                      <div class="custom-file">
                        <input  type="file" id="inputImageEdit" name="image" class="form-control @error('image') is-invalid @enderror" onchange="editPreviewImage(event)">
                        <label class="custom-file-label" for="inputImageEdit">Masukkan Gambar Barang</label>
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                      </div>
            </div>
            </div>
            <div class="form-group">
                <label for="inputName">Nama</label>
                <input type="text" id="inputName" name="name" class="form-control" value="{{ $user->name }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" id="inputEmail" name="email" class="form-control" value="{{ $user->email }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputContact">Kontak</label>
                <input type="text" id="inputContact" name="contact_number" class="form-control" value="{{ $user->contact_number }}" required>
                @error('contact_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputAddress">Alamat</label>
                <input type="text" id="inputAddress" name="address" class="form-control" value="{{ $user->address }}" required>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror            </div>
            <div class="form-group">
                <label for="inputPassword">Kata Sandi (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" id="inputPassword" name="password" class="form-control">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
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
                <a href="#" class="btn btn-outline-danger rounded-pill" data-target="#showeditmodal" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Batal</a>
                <button type="submit" class="btn btn-success float-right rounded-pill"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Akun</button>
            </div>
        </div>
    </form>
</div>
