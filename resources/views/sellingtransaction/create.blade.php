<div class="card card-primary shadow-lg">
    <div class="card-header">
        <h3 class="card-title">Buat Transaksi Penjualan Baru</h3>
        <button type="button" class="close" data-target="#showcreatemodal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
    </div>
    <form method="POST" action="{{ route('sellingtransactions.store') }}">
        @csrf
        <div class="card-body">
            <h3><strong>Buat Transaksi Penjualan Baru</strong></h3>
            <div class="form-group">
                <label for="seller">Penjual</label>
                <select name="seller_id" id="seller" class="form-control">
                    @foreach ($users as $user)
                        @if (Auth::user() == $user)
                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                        @else
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="datetime-local" name="date" class="form-control" value="{{now()}}">
            </div>

            <h4>Daftar Barang</h4>
            <table class="table table-bordered" id="itemTable">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Harga Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="items[0][item_id]" class="form-control item-select">
                                <option value="" data-price="0">Pilih Barang</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}" data-price="{{ $item->price }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" class="form-control item-price" value="@toIDR(0)" readonly data-raw-price="{{ $items[0]->price }}"></td>
                        <td><input type="number" name="items[0][quantity]" class="form-control item-quantity" placeholder="Jumlah" min="1"></td>
                        <td><input type="text" name="items[0][price]" class="form-control item-total-price" placeholder="Harga Total" readonly data-raw-price="0"></td>
                        <td><button type="button" class="btn btn-danger remove-item">Hapus</button></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <button type="button" class="btn btn-success" id="addItem">Tambah Barang</button>

            <div class="mt-4">
                <div class="form-group">
                    <label for="subtotal">Sub Total</label>
                    <input type="text" id="subtotal" class="form-control" name="sub_total" readonly>
                </div>
                <div class="form-group">
                    <label for="totalCount">Jumlah Barang</label>
                    <input type="text" id="totalCount" class="form-control" name="total_count" readonly>
                </div>
                <div class="form-group">
                    <label for="discount">Diskon</label>
                    <input type="text" id="discount" class="form-control" name="discount_amount" placeholder="Diskon" value="0" min="0">
                </div>
                <div class="form-group">
                    <label for="sumTotal">Total Harga</label>
                    <input type="text" id="sumTotal" class="form-control" name="total_amount" readonly>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="col-12">
                <a href="#" class="btn btn-secondary" data-target="#showcreatemodal" data-dismiss="modal">Batal</a>
                <input type="submit" value="Buat Transaksi Baru" class="btn btn-success float-right">
            </div>
        </div>
    </form>
</div>
