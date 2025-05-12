<div class="card card-primary shadow-lg">
    <div class="card-header">
        <h3 class="card-title">Detail Transaksi Penjualan || {{ $sellingTransaction->date }} </h3>
        <button type="button" class="close ml-auto" data-dismiss="modal" data-target="show{{$sellingTransaction->id}}" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="card-body">
        <h3><strong>Detail Transaksi Penjualan Barang</strong></h3>
        <p><strong>Penjual:</strong> {{ $sellingTransaction->seller->name }}</p>
        <p><strong>Waktu dan Tanggal:</strong> {{ $sellingTransaction->date }}</p>

        <h5><strong>Daftar Barang</strong></h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga Per Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sellingTransaction->items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>@toIDR($item->price)</td>
                    <td>{{ $item->pivot->total_quantity }}</td>
                    <td>@toIDR($item->pivot->total_price)</td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td>Sub total : </td>
                    <td>{{ $sellingTransaction->total_count }}</td>
                    <td>@toIDR($sellingTransaction->sub_total)</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Discount : </td>
                    <td></td>
                    <td>@toIDR($sellingTransaction->discount_amount)</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Total: </td>
                    <td></td>
                    <td>@toIDR($sellingTransaction->total_amount)</td>
                </tr>
            </tbody>
        </table>
        <br>
        <h6><strong>Jumlah Barang:</strong> {{ $sellingTransaction->total_count }}</h6>
        <h6><strong>Sub Total:</strong> @toIDR($sellingTransaction->sub_total)</h6>
        <h6><strong>Discount:</strong> @toIDR($sellingTransaction->discount_amount)</h6>
        <h5><strong>Total Pendapatan : </strong> @toIDR($sellingTransaction->total_amount)</h5>
    </div>
</div>
