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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="supplier">Supplier</label>
                <select name="supplier_id" id="supplier" class="form-control @error('supplier_id') is-invalid @enderror" required>
                    <option value="">Pilih Supplier</option>
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
                <input type="datetime-local" name="date" id="date" class="form-control @error('date') is-invalid @enderror"
                    value="{{ old('date', now()->format('Y-m-d\TH:i')) }}" required>
                @error('date')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
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
                            <select name="items[0][item_id]" class="form-control item-select @error('items.0.item_id') is-invalid @enderror" required>
                                <option value="">Pilih Barang</option>
                                <option value="new">Tambah Barang Baru</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}" data-price="{{ $item->price }}" {{ old('items.0.item_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('items.0.item_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control item-price" value="0" readonly data-raw-price="0">
                        </td>
                        <td>
                            <input type="number" name="items[0][quantity]" class="form-control item-quantity @error('items.0.quantity') is-invalid @enderror"
                                placeholder="Jumlah" min="1" value="{{ old('items.0.quantity') }}" required>
                            @error('items.0.quantity')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="items[0][price]" class="form-control item-total-price" placeholder="Harga Total" readonly data-raw-price="0">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-item">Hapus</button>
                        </td>
                    </tr>
                    <tr class="new-item-fields" style="display: none;">
                        <td>
                            <input type="text" name="items[0][new_name]" class="form-control @error('items.0.new_name') is-invalid @enderror" placeholder="Nama Barang Baru">
                            @error('items.0.new_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="number" name="items[0][new_price]" class="form-control @error('items.0.new_price') is-invalid @enderror" placeholder="Harga Barang Baru" min="0">
                            @error('items.0.new_price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="number" name="items[0][new_stock]" class="form-control @error('items.0.new_stock') is-invalid @enderror" placeholder="Stok Barang Baru" min="0">
                            @error('items.0.new_stock')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
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
                    <input type="text" id="subtotal" class="form-control" name="sub_total" value="{{ old('sub_total') }}" readonly>
                </div>
                <div class="form-group">
                    <label for="totalCount">Jumlah Barang</label>
                    <input type="text" id="totalCount" class="form-control" name="total_count" value="{{ old('total_count') }}" readonly>
                </div>
                <div class="form-group">
                    <label for="otherCost">Biaya Lain</label>
                    <input type="number" id="otherCost" class="form-control @error('other_cost') is-invalid @enderror" name="other_cost"
                        placeholder="Biaya Lain" value="{{ old('other_cost', 0) }}" min="0">
                    @error('other_cost')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="discount">Diskon</label>
                    <input type="number" id="discount" class="form-control @error('discount_amount') is-invalid @enderror" name="discount_amount"
                        placeholder="Diskon" value="{{ old('discount_amount', 0) }}" min="0">
                    @error('discount_amount')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="sumTotal">Total Harga</label>
                    <input type="text" id="sumTotal" class="form-control" name="total_amount" value="{{ old('total_amount') }}" readonly>
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
