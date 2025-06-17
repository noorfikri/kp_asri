<div class="card card-primary shadow-lg">
    <div class="card-header">
        <h3 class="card-title">Buat Transaksi Pembelian Baru</h3>
        <button type="button" class="close" data-target="#showcreatemodal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form method="POST" action="{{ route('buyingtransactions.store') }}">
        @csrf
        <div class="card-body">
            <h3><strong>Buat Transaksi Pembelian Baru</strong></h3>
            <div class="form-group">
                <label for="supplier">Supplier</label>
                <select name="supplier_id" id="supplier" class="form-control">
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="datetime-local" name="date" class="form-control" value="{{ now() }}">
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
                    <tr class="itemFields">
                        <td>
                            <select name="items[0][item_id]" class="form-control item-select">
                                <option value="">Pilih Barang</option>
                                <option value="new">Tambah Barang Baru</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}" data-price="{{ $item->price }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" class="form-control item-price" value="0" readonly data-raw-price="0"></td>
                        <td><input type="number" name="items[0][quantity]" class="form-control item-quantity" placeholder="Jumlah" min="1"></td>
                        <td><input type="text" name="items[0][price]" class="form-control item-total-price" placeholder="Harga Total" readonly data-raw-price="0"></td>
                        <td><button type="button" class="btn btn-danger remove-item">Hapus</button></td>
                    </tr>
                    <tr class="new-item-fields" style="display: none;">
                        <td>
                            <input type="text" name="items[0][new_name]" class="form-control" placeholder="Nama Barang Baru">
                        </td>
                        <td>
                            <input type="number" name="items[0][new_price]" class="form-control" placeholder="Harga Barang Baru">
                        </td>
                        <td>
                            <input type="number" name="items[0][new_stock]" class="form-control" placeholder="Stok Barang Baru">
                        </td>
                        <td colspan="2"></td>
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
                    <label for="otherCost">Biaya Lain</label>
                    <input type="text" id="otherCost" class="form-control" name="other_cost" placeholder="Biaya Lain" value="0" min="0">
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