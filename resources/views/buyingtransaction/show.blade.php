<div class="card card-primary shadow-lg">
    <div class="card-header">
        <h3 class="card-title">Detail Transaksi Pembelian || {{ $buyingTransaction->date }} </h3>
        <button type="button" class="close ml-auto" data-dismiss="modal" data-target="show{{$buyingTransaction->id}}" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="card-body">
        <h3><strong>Detail Transaksi Pembelian Barang</strong></h3>
        <h5><strong>Supplier:</strong> {{ $buyingTransaction->supplier->name }}</h5>
        <h5><strong>Waktu dan Tanggal:</strong> {{ $buyingTransaction->date }}</h5>

        <h5><strong>Daftar Barang</strong></h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Ukuran</th>
                    <th>Warna</th>
                    <th>Harga Per Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buyingTransaction->itemsStocks as $itemStock)
                <tr>
                    <td>{{ $itemStock->item->name }}</td>
                    <td>{{ $itemStock->size->name }}</td>
                    <td>{{ $itemStock->colour->name }}</td>
                    <td>@toIDR($itemStock->item->price)</td>
                    <td>{{ $itemStock->pivot->total_quantity }}</td>
                    <td>@toIDR($itemStock->pivot->total_price)</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4">Sub total :</td>
                    <td>{{ $buyingTransaction->total_count }}</td>
                    <td>@toIDR($buyingTransaction->sub_total)</td>
                </tr>
                <tr>
                    <td colspan="4">Discount :</td>
                    <td></td>
                    <td>@toIDR($buyingTransaction->discount_amount)</td>
                </tr>
                <tr>
                    <td colspan="4">Biaya Lainnya :</td>
                    <td></td>
                    <td>@toIDR($buyingTransaction->other_cost)</td>
                </tr>
                <tr>
                    <td colspan="4">Total:</td>
                    <td></td>
                    <td>@toIDR($buyingTransaction->total_amount)</td>
                </tr>
            </tbody>
        </table>
        <br>
        <h6><strong>Jumlah Barang:</strong> {{ $buyingTransaction->total_count }}</h6>
        <h6><strong>Sub Total:</strong> @toIDR($buyingTransaction->sub_total)</h6>
        <h6><strong>Discount:</strong> @toIDR($buyingTransaction->discount_amount)</h6>
        <h6><strong>Biaya Lainnya:</strong> @toIDR($buyingTransaction->other_cost)</h6>
        <h5><strong>Total Pengeluaran : </strong> @toIDR($buyingTransaction->total_amount)</h5>
    </div>
</div>
