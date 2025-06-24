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
            <div class="form-group">
                <label for="supplier">Supplier</label>
                <select name="supplier_id" id="supplier" class="form-control @error('supplier_id') is-invalid @enderror">
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
                @error('supplier_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="datetime-local" name="date" class="form-control @error('date') is-invalid @enderror"
                    value="{{ old('date', now()->format('Y-m-d\TH:i')) }}">
                @error('date')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <h4>Daftar Barang Dibeli</h4>
            <table class="table table-bordered" id="itemTable">
                <thead>
                    <tr>
                        <th>Barang (Nama/Ukuran/Warna)</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Harga Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="items[0][items_stock_id]" class="form-control item-select @error('items.0.items_stock_id') is-invalid @enderror" required>
                                <option value="">Pilih Barang</option>
                                @foreach ($itemsStock as $stock)
                                    <option value="{{ $stock->id }}" data-price="{{ $stock->item->price }}">
                                        {{ $stock->item->name }} / {{ $stock->size->name }} / {{ $stock->colour->name }} (Stok: {{ $stock->stock }})
                                    </option>
                                @endforeach
                            </select>
                            @error('items.0.items_stock_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control item-price" value="@toIDR(0)" readonly data-raw-price="0">
                        </td>
                        <td>
                            <input type="number" name="items[0][quantity]" class="form-control item-quantity @error('items.0.quantity') is-invalid @enderror"
                                placeholder="Jumlah" min="1" value="{{ old('items.0.quantity') }}">
                            @error('items.0.quantity')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="items[0][price]" class="form-control item-total-price" placeholder="Harga Total" readonly data-raw-price="0" value="{{ old('items.0.price') }}">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-item">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-success" id="addItem">Tambah Barang</button>

            <div class="mt-4">
                <div class="form-group">
                    <label for="subtotal">Sub Total</label>
                    <input type="text" id="subtotal" class="form-control" name="sub_total" readonly value="{{ old('sub_total') }}">
                </div>
                <div class="form-group">
                    <label for="totalCount">Jumlah Barang</label>
                    <input type="text" id="totalCount" class="form-control" name="total_count" readonly value="{{ old('total_count') }}">
                </div>
                <div class="form-group">
                    <label for="discount">Diskon</label>
                    <input type="text" id="discount" class="form-control @error('discount_amount') is-invalid @enderror"
                        name="discount_amount" placeholder="Diskon" value="{{ old('discount_amount', 0) }}" min="0">
                    @error('discount_amount')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="other_cost">Biaya Lainnya</label>
                    <input type="text" id="other_cost" class="form-control @error('other_cost') is-invalid @enderror"
                        name="other_cost" placeholder="Biaya Lainnya" value="{{ old('other_cost', 0) }}" min="0">
                    @error('other_cost')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="sumTotal">Total Harga</label>
                    <input type="text" id="sumTotal" class="form-control" name="total_amount" readonly value="{{ old('total_amount') }}">
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
