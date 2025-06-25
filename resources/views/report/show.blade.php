<div class="card card-primary shadow-lg">
    <div class="card-header">
        <h3 class="card-title">Detail Laporan</h3>
        <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="card-body" id="report-detail-print">
        {{-- Info Section --}}
        <h5 class="mb-3"><strong>Informasi Laporan</strong></h5>
        <table class="table table-bordered mb-4">
            <tbody>
                <tr>
                    <th style="width: 30%;">Tanggal Laporan</th>
                    <td>{{ $report->report_date }}</td>
                </tr>
                <tr>
                    <th>Pembuat</th>
                    <td>{{ $report->creator->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jenis</th>
                    <td>{{ ucfirst($report->type) }}</td>
                </tr>
            </tbody>
        </table>

        {{-- Transactions Section --}}
        <h5 class="mt-3 mb-2"><strong>Rekapitulasi Transaksi</strong></h5>
        <table class="table table-bordered table-sm mb-4">
            <thead>
                <tr>
                    <th colspan="8" class="text-center bg-success text-white">Transaksi Penjualan</th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Penjual</th>
                    <th>Jumlah Barang</th>
                    <th>Sub Total</th>
                    <th>Diskon</th>
                    <th>Biaya Lainnya</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $totalSoldCount = 0; @endphp
                @forelse($report->sellingTransactions ?? [] as $st)
                    @php $totalSoldCount += $st->total_count; @endphp
                    <tr>
                        <td>{{ $st->id }}</td>
                        <td>{{ $st->date }}</td>
                        <td>{{ $st->seller->name ?? '-' }}</td>
                        <td>{{ $st->total_count }}</td>
                        <td>@toIDR($st->sub_total)</td>
                        <td>@toIDR($st->discount_amount ?? 0)</td>
                        <td class="text-center">-</td>
                        <td>@toIDR($st->total_amount)</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Tidak ada transaksi penjualan</td>
                    </tr>
                @endforelse
                <tr class="bg-light font-weight-bold">
                    <td colspan="3" class="text-right">Total Barang Dijual</td>
                    <td>{{ $report->total_sold_count ?? $totalSoldCount }}</td>
                    <td colspan="3" class="text-right">Total Penjualan</td>
                    <td>@toIDR(($report->sellingTransactions ?? collect())->sum('total_amount'))</td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th colspan="8" class="text-center bg-primary text-white">Transaksi Pembelian</th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Supplier</th>
                    <th>Jumlah Barang</th>
                    <th>Sub Total</th>
                    <th>Diskon</th>
                    <th>Biaya Lainnya</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $totalBoughtCount = 0; @endphp
                @forelse($report->buyingTransactions ?? [] as $bt)
                    @php $totalBoughtCount += $bt->total_count; @endphp
                    <tr>
                        <td>{{ $bt->id }}</td>
                        <td>{{ $bt->date }}</td>
                        <td>{{ $bt->supplier->name ?? '-' }}</td>
                        <td>{{ $bt->total_count }}</td>
                        <td>@toIDR($bt->sub_total)</td>
                        <td>@toIDR($bt->discount_amount ?? 0)</td>
                        <td>@toIDR($bt->other_cost ?? 0)</td>
                        <td>@toIDR($bt->total_amount)</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Tidak ada transaksi pembelian</td>
                    </tr>
                @endforelse
                <tr class="bg-light font-weight-bold">
                    <td colspan="3" class="text-right">Total Barang Dibeli</td>
                    <td>{{ $report->total_bought_count ?? $totalBoughtCount }}</td>
                    <td colspan="3" class="text-right">Total Pembelian</td>
                    <td>@toIDR(($report->buyingTransactions ?? collect())->sum('total_amount'))</td>
                </tr>
            </tbody>
        </table>

        {{-- Other Costs and Cash Flow Section --}}
        <h5 class="mt-3 mb-2"><strong>Rekapitulasi & Arus Kas</strong></h5>
        <table class="table table-bordered table-sm">
            <tbody>
                <tr>
                    <th style="width: 40%;">Total Barang Terjual</th>
                    <td>{{ $report->total_sold_count ?? $totalSoldCount }}</td>
                </tr>
                <tr>
                    <th>Total Barang Dibeli</th>
                    <td>{{ $report->total_bought_count ?? $totalBoughtCount }}</td>
                </tr>
                <tr>
                    <th>Total Penjualan</th>
                    <td>@toIDR($report->total_selling)</td>
                </tr>
                <tr>
                    <th>Total Pembelian</th>
                    <td>@toIDR($report->total_buying)</td>
                </tr>
                <tr>
                    <th>Biaya Lainnya (Laporan)</th>
                    <td>@toIDR($report->other_cost)</td>
                </tr>
                <tr>
                    <th>Arus Kas (Cash Flow)</th>
                    <td><strong>@toIDR($report->cash_flow)</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-info btn-sm mr-2" onclick="printReportDetail(this)">
            <i class="fas fa-print"></i> Print
        </button>
        <button type="button" class="btn btn-secondary btn-sm float-right" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span> Tutup
        </button>
    </div>
</div>
