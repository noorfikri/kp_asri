<div class="card card-outline card-primary shadow-lg p-0">
    <div class="card-header d-flex justify-content-between align-items-center my-0 py-0 border-0">
        <div class="bg-primary py-2 px-3 my-0 rounded-bottom rounded-3">
        <h3 class="card-title"><i class="fas fa-primary"> </i> Detail Transaksi Penjualan || {{ $sellingTransaction->date }} </h3>
        </div>
    </div>
    <div class="card-body" id="transaction-detail-print">
        <h3><strong>Detail Transaksi Penjualan</strong></h3>
        <p><strong>Penjual:</strong> {{ $sellingTransaction->seller->name }}</p>
        <p><strong>Waktu dan Tanggal:</strong> {{ $sellingTransaction->date }}</p>

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
                @foreach ($sellingTransaction->itemsStocks as $itemStock)
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
                    <td>{{ $sellingTransaction->total_count }}</td>
                    <td>@toIDR($sellingTransaction->sub_total)</td>
                </tr>
                <tr>
                    <td colspan="4">Diskon :</td>
                    <td></td>
                    <td>@toIDR($sellingTransaction->discount_amount)</td>
                </tr>
                <tr>
                    <td colspan="4">Total:</td>
                    <td></td>
                    <td>@toIDR($sellingTransaction->total_amount)</td>
                </tr>
            </tbody>
        </table>
        <br>
        <h6><strong>Jumlah Barang:</strong> {{ $sellingTransaction->total_count }}</h6>
        <h6><strong>Sub Total:</strong> @toIDR($sellingTransaction->sub_total)</h6>
        <h6><strong>Diskon:</strong> @toIDR($sellingTransaction->discount_amount)</h6>
        <h5><strong>Total Pendapatan : </strong> @toIDR($sellingTransaction->total_amount)</h5>
    </div>
        <div class="card-footer">
        <button type="button" class="btn btn-primary rounded-pill float-left mr-2" onclick="printTransactionDetail(this)">
            <i class="fas fa-print"></i> Cetak Transaksi
        </button>
        <button type="button" class="btn btn-outline-danger rounded-pill float-right" data-target="#show{{$sellingTransaction->id}}" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i> Tutup
        </button>
    </div>
</div>
