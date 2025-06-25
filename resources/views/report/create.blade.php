<div class="card card-primary shadow-lg">
    <div class="card-header">
        <h3 class="card-title">Buat Laporan Baru</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form method="POST" action="{{ route('reports.store') }}" id="reportCreateForm">
        @csrf
        <div class="card-body">
            <div>
                <label for="report_date">Tanggal Laporan</label>
                <input type="date" name="report_date"
                class="form-control @error('report_date') is-invalid @enderror"
                value="{{ old('report_date', date('Y-m-d')) }}" required>
                @error('report_date')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="type">Jenis</label>
                <select name="type" class="form-control" required>
                    <option value="monthly" selected>Bulanan</option>
                    <option value="yearly">Tahunan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="creator_id">Pembuat</label>
                <select name="creator_id" class="form-control @error('creator_id') is-invalid @enderror" required>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        {{ old('creator_id', Auth::id()) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                    @endforeach
                </select>
                @error('creator_id')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <h5 class="mt-4">Transaksi Penjualan</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-sm" id="sellingTable">
                    <thead>
                        <tr>
                            <th>Transaksi</th>
                            <th>Tanggal</th>
                            <th>Jumlah Terjual Barang</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Selling transactions will be added here -->
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <select id="sellingSelect" class="form-control">
                    <option value="">Pilih Transaksi Penjualan</option>
                    @foreach($sellingTransactions as $st)
                        <option value="{{ $st->id }}"
                            data-date="{{ $st->date }}"
                            data-total_count="{{ $st->total_count }}"
                            data-total_amount="{{ $st->total_amount }}">
                            #{{ $st->id }} - {{ $st->date }} - @toIDR($st->total_amount)
                        </option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-success mt-2" id="addSellingBtn">Tambah Transaksi Penjualan</button>
            </div>

            <h5 class="mt-4">Transaksi Pembelian</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-sm" id="buyingTable">
                    <thead>
                        <tr>
                            <th>Transaksi</th>
                            <th>Tanggal</th>
                            <th>Jumlah Dibeli Barang</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Buying transactions will be added here -->
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <select id="buyingSelect" class="form-control">
                    <option value="">Pilih Transaksi Pembelian</option>
                    @foreach($buyingTransactions as $bt)
                        <option value="{{ $bt->id }}"
                            data-date="{{ $bt->date }}"
                            data-total_count="{{ $bt->total_count }}"
                            data-total_amount="{{ $bt->total_amount }}">
                            #{{ $bt->id }} - {{ $bt->date }} - @toIDR($bt->total_amount)
                        </option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-success mt-2" id="addBuyingBtn">Tambah Transaksi Pembelian</button>
            </div>

            <div class="form-group mt-4">
                <label for="other_cost">Biaya Lainnya</label>
                <input type="text" id="other_cost" name="other_cost" class="form-control" value="0">
            </div>

            <div class="form-group">
                <label>Rekapitulasi</label>
                <table class="table table-bordered table-sm">
                    <tbody>
                        <tr>
                            <th>Total Barang Terjual</th>
                            <td id="totalSoldCount">0</td>
                        </tr>
                        <tr>
                            <th>Total Barang Dibeli</th>
                            <td id="totalBoughtCount">0</td>
                        </tr>
                        <tr>
                            <th>Total Penjualan</th>
                            <td id="totalSelling">@toIDR(0)</td>
                        </tr>
                        <tr>
                            <th>Total Pembelian</th>
                            <td id="totalBuying">@toIDR(0)</td>
                        </tr>
                        <tr>
                            <th>Biaya Lainnya</th>
                            <td id="recapOtherCost">@toIDR(0)</td>
                        </tr>
                        <tr>
                            <th>Arus Kas (Cash Flow)</th>
                            <td id="cashFlow">@toIDR(0)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
