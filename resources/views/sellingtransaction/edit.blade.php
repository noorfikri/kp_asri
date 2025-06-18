<div class="card card-primary shadow-lg">
    <div class="card-header">
        <h5 class="card-title">Edit Transaksi Penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form method="POST" action="{{ route('sellingtransactions.update', $sellingTransaction->id) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <input type="hidden" name="id" value="{{ old('id', $sellingTransaction->id) }}">
            <div class="form-group">
                <label for="seller">Penjual</label>
                <select name="seller_id" id="seller" class="form-control @error('seller_id') is-invalid @enderror">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('seller_id', $sellingTransaction->seller_id) == $user->id ? 'selected' : '' }}>
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
                <input type="datetime-local" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', \Carbon\Carbon::parse($sellingTransaction->date)->format('Y-m-d\TH:i')) }}">
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
                    @php
                        $oldItems = old('items', []);
                        $itemsData = count($oldItems) ? $oldItems : $sellingTransaction->items->map(function($item, $index) {
                            return [
                                'item_id' => $item->id,
                                'quantity' => $item->pivot->total_quantity,
                                'price' => $item->pivot->total_price,
                                'unit_price' => $item->price,
                            ];
                        })->toArray();
                    @endphp
                    @foreach ($itemsData as $index => $itemData)
                        @php
                            $itemId = is_array($itemData) ? $itemData['item_id'] : $itemData->id;
                            $quantity = is_array($itemData) ? $itemData['quantity'] : $itemData->pivot->total_quantity;
                            $totalPrice = is_array($itemData) ? $itemData['price'] : $itemData->pivot->total_price;
                            $unitPrice = is_array($itemData) ? ($itemData['unit_price'] ?? 0) : $itemData->price;
                        @endphp
                        <tr>
                            <td>
                                <select name="items[{{ $index }}][item_id]" class="form-control item-select @error('items.'.$index.'.item_id') is-invalid @enderror">
                                    @foreach ($items as $availableItem)
                                        <option value="{{ $availableItem->id }}" data-price="{{ $availableItem->price }}"
                                            {{ $availableItem->id == $itemId ? 'selected' : '' }}>
                                            {{ $availableItem->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('items.'.$index.'.item_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control item-price" value="@toIDR($unitPrice)" data-raw-price="{{ $unitPrice }}" readonly>
                            </td>
                            <td>
                                <input type="number" name="items[{{ $index }}][quantity]" class="form-control item-quantity @error('items.'.$index.'.quantity') is-invalid @enderror" value="{{ $quantity }}" min="1">
                                @error('items.'.$index.'.quantity')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <input type="text" name="items[{{ $index }}][price]" class="form-control item-total-price" value="@toIDR($totalPrice)" data-raw-price="{{ $totalPrice }}" readonly>
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
                    <input type="text" id="subtotal" name="sub_total" class="form-control" value="@toIDR(old('sub_total', $sellingTransaction->sub_total))" readonly>
                </div>
                <div class="form-group">
                    <label for="totalCount">Jumlah Barang</label>
                    <input type="text" id="totalCount" class="form-control" name="total_count" value="{{ old('total_count', $sellingTransaction->total_count) }}" readonly>
                </div>
                <div class="form-group">
                    <label for="discount">Diskon</label>
                    <input type="text" id="discount" name="discount_amount" class="form-control @error('discount_amount') is-invalid @enderror" value="@toIDR(old('discount_amount', $sellingTransaction->discount_amount))">
                    @error('discount_amount')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="sumTotal">Total Harga</label>
                    <input type="text" id="sumTotal" name="total_amount" class="form-control" value="@toIDR(old('total_amount', $sellingTransaction->total_amount))" readonly>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="col-12">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <input type="submit" value="Ubah Data Transaksi" class="btn btn-success float-right">
            </div>
        </div>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger mt-2">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
