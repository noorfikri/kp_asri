<div class="card card-primary shadow-lg">
    <div class="card-header">
        <h5 class="card-title">Edit Transaksi Penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form method="POST" action="{{url('admin/sellingtransactions/'.$sellingTransaction->id)}}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <input type="hidden" name="id" value="{{ $sellingTransaction->id }}">
            <div class="form-group">
                <label for="seller">Penjual</label>
                <select name="seller_id" id="seller" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $sellingTransaction->seller_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="datetime-local" name="date" class="form-control" value="{{ $sellingTransaction->date }}">
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
                    @foreach ($sellingTransaction->items as $index => $item)
                    <tr>
                        <td>
                            <select name="items[{{ $index }}][item_id]" class="form-control item-select">
                                @foreach ($items as $availableItem)
                                    <option value="{{ $availableItem->id }}" data-price="{{ $availableItem->price }}"
                                        {{ $availableItem->id == $item->id ? 'selected' : '' }}>
                                        {{ $availableItem->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control item-price" value="@toIDR($item->price)" data-raw-price="{{ $item->price }}" readonly>
                        </td>
                        <td>
                            <input type="number" name="items[{{ $index }}][quantity]" class="form-control item-quantity" value="{{ $item->pivot->total_quantity }}" min="1">
                        </td>
                        <td>
                            <input type="text" name="items[{{ $index }}][price]" class="form-control item-total-price" value="@toIDR($item->pivot->total_price)" data-raw-price="{{ $item->pivot->total_price }}" readonly>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-item">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" class="btn btn-success" id="addItem">Tambah Barang</button>
    
            <div class="mt-4">
                <div class="form-group">
                    <label for="subtotal">Sub Total</label>
                    <input type="text" id="subtotal" name="sub_total" class="form-control" value="@toIDR($sellingTransaction->sub_total)" readonly>
                </div>
                <div class="form-group">
                    <label for="totalCount">Jumlah Barang</label>
                    <input type="text" id="totalCount" class="form-control" name="total_count" value="{{$sellingTransaction->total_count}}" readonly>
                </div>
                <div class="form-group">
                    <label for="discount">Diskon</label>
                    <input type="text" id="discount" name="discount_amount" class="form-control" value="@toIDR($sellingTransaction->discount_amount)">
                </div>
                <div class="form-group">
                    <label for="sumTotal">Total Harga</label>
                    <input type="text" id="sumTotal" name="total_amount" class="form-control" value="@toIDR($sellingTransaction->total_amount)" readonly>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
        </div>
    </form>
</div>