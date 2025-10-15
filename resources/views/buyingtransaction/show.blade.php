<div class="card card-outline card-info shadow-lg p-0">
    <div class="card-header d-flex justify-content-between align-items-center my-0 py-0 border-0">
        <div class="bg-info py-2 px-3 my-0 rounded-bottom rounded-3">
        <h3 class="card-title"><i class="fas fa-info"> </i> Detail Transaksi Pembelian || {{ $buyingTransaction->date }} </h3>
        </div>
    </div>
    <div class="card-body">
        @if($buyingTransaction->reciept_image)
        <div class="mb-3 text-center">
            <strong>Bukti Pembelian:</strong><br>
            <img src="{{ asset($buyingTransaction->reciept_image) }}" alt="Bukti Pembelian" class="img-fluid rounded shadow" style="max-width:300px;max-height:300px;">
        </div>
        @endif

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
        <div class="pt-3 mt-3 pr-1 mr-1">
            <button type="button" class="btn btn-outline-danger rounded-pill float-right" data-target="#show{{$buyingTransaction->id}}" data-dismiss="modal"> <i class="fa-solid fa-xmark"></i> Tutup</button>
        </div>
    </div>
</div>
