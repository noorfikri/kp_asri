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

            {{-- Show global errors --}}
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
                <label for="seller">Penjual</label>
                <select name="seller_id" id="seller" class="form-control @error('seller_id') is-invalid @enderror">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('seller_id', Auth::id()) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('seller_id')
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
                            <select name="items[0][item_id]" class="form-control item-select @error('items.0.item_id') is-invalid @enderror">
                                <option value="" data-price="0">Pilih Barang</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}" data-price="{{ $item->price }}"
                                        {{ old('items.0.item_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('items.0.item_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control item-price" value="@toIDR(0)" readonly data-raw-price="{{ $items[0]->price }}">
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
            <br>
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
