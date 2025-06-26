@extends('layouts.adminlte3')

@push('styles')
<style>
@media print {
    .bg-success, .bg-primary, .bg-info, .bg-danger, .bg-warning, .bg-secondary, .bg-dark {
        background-color: #fff !important;
        color: #000 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    .text-white {
        color: #000 !important;
    }
    th, td {
        color: #000 !important;
    }
}
</style>
@endpush

@section('javascript')
<script>
function formatToIDR(amount) {
    return 'Rp. ' + (parseInt(amount) || 0).toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 }) + ',00';
}
function parseIDRToInteger(value) {
    return parseInt((value || '').toString().replace(/Rp\.|,00|[^0-9]/g, ''), 10) || 0;
}
function showDetails(report_id){
    $.ajax({
        type:'POST',
        url:'{{route("reports.showDetail")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
            'id':report_id
        },
        success: function(data){
            $('#reportdetail'+report_id).html(data.msg)
        }
    });
}

function showCreate(){
    $.ajax({
        type:'POST',
        url:'{{route("reports.showCreate")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
        },
        success: function(data){
            $('#createmodal').html(data.msg);

            initializeCreateModal();
        }
    });
}

function initializeCreateModal() {
    let sellingTransactions = {};
    let buyingTransactions = {};

    // Add Selling Transaction
    document.getElementById('addSellingBtn').addEventListener('click', function() {
        const select = document.getElementById('sellingSelect');
        const id = select.value;
        if (!id || sellingTransactions[id]) return;
        const option = select.options[select.selectedIndex];
        const date = option.dataset.date;
        const total_count = parseInt(option.dataset.total_count) || 0;
        const total_amount = parseInt(option.dataset.total_amount) || 0;

        sellingTransactions[id] = {id, date, total_count, total_amount};

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <input type="hidden" name="selling_transactions[]" value="${id}">
                #${id}
            </td>
            <td>${date}</td>
            <td class="selling-count">${total_count}</td>
            <td class="selling-amount" data-amount="${total_amount}">${formatToIDR(total_amount)}</td>
            <td><button type="button" class="btn btn-danger btn-sm remove-selling" data-id="${id}">Hapus</button></td>
        `;
        document.querySelector('#sellingTable tbody').appendChild(row);
        updateRecap();
    });

    // Remove Selling Transaction
    document.getElementById('sellingTable').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-selling')) {
            const id = e.target.dataset.id;
            delete sellingTransactions[id];
            e.target.closest('tr').remove();
            updateRecap();
        }
    });

    // Add Buying Transaction
    document.getElementById('addBuyingBtn').addEventListener('click', function() {
        const select = document.getElementById('buyingSelect');
        const id = select.value;
        if (!id || buyingTransactions[id]) return;
        const option = select.options[select.selectedIndex];
        const date = option.dataset.date;
        const total_count = parseInt(option.dataset.total_count) || 0;
        const total_amount = parseInt(option.dataset.total_amount) || 0;

        buyingTransactions[id] = {id, date, total_count, total_amount};

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <input type="hidden" name="buying_transactions[]" value="${id}">
                #${id}
            </td>
            <td>${date}</td>
            <td class="buying-count">${total_count}</td>
            <td class="buying-amount" data-amount="${total_amount}">${formatToIDR(total_amount)}</td>
            <td><button type="button" class="btn btn-danger btn-sm remove-buying" data-id="${id}">Hapus</button></td>
        `;
        document.querySelector('#buyingTable tbody').appendChild(row);
        updateRecap();
    });

    // Remove Buying Transaction
    document.getElementById('buyingTable').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-buying')) {
            const id = e.target.dataset.id;
            delete buyingTransactions[id];
            e.target.closest('tr').remove();
            updateRecap();
        }
    });

        // Helper to parse date string (YYYY-MM-DD or YYYY-MM-DDTHH:MM)
    function parseDate(str) {
        if (!str) return null;
        const parts = str.split('T')[0].split('-');
        return {
            year: parseInt(parts[0], 10),
            month: parseInt(parts[1], 10)
        };
    }

    function autoSelectTransactions() {
        const type = document.querySelector('select[name="type"]').value;
        const dateStr = document.querySelector('input[name="report_date"]').value;
        const dateObj = parseDate(dateStr);
        if (!type || !dateObj) return;

        // Clear current selections
        sellingTransactions = {};
        buyingTransactions = {};
        document.querySelector('#sellingTable tbody').innerHTML = '';
        document.querySelector('#buyingTable tbody').innerHTML = '';

        // Selling
        document.querySelectorAll('#sellingSelect option[value]').forEach(option => {
            const tDate = parseDate(option.dataset.date);
            if (!tDate) return;
            let match = false;
            if (type === 'monthly' && tDate.year === dateObj.year && tDate.month === dateObj.month) match = true;
            if (type === 'yearly' && tDate.year === dateObj.year) match = true;
            if (match) {
                const id = option.value;
                if (!sellingTransactions[id]) {
                    sellingTransactions[id] = {
                        id,
                        date: option.dataset.date,
                        total_count: parseInt(option.dataset.total_count) || 0,
                        total_amount: parseInt(option.dataset.total_amount) || 0
                    };
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>
                            <input type="hidden" name="selling_transactions[]" value="${id}">
                            #${id}
                        </td>
                        <td>${option.dataset.date}</td>
                        <td class="selling-count">${option.dataset.total_count}</td>
                        <td class="selling-amount" data-amount="${option.dataset.total_amount}">${formatToIDR(option.dataset.total_amount)}</td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-selling" data-id="${id}">Hapus</button></td>
                    `;
                    document.querySelector('#sellingTable tbody').appendChild(row);
                }
            }
        });

        // Buying
        document.querySelectorAll('#buyingSelect option[value]').forEach(option => {
            const tDate = parseDate(option.dataset.date);
            if (!tDate) return;
            let match = false;
            if (type === 'monthly' && tDate.year === dateObj.year && tDate.month === dateObj.month) match = true;
            if (type === 'yearly' && tDate.year === dateObj.year) match = true;
            if (match) {
                const id = option.value;
                if (!buyingTransactions[id]) {
                    buyingTransactions[id] = {
                        id,
                        date: option.dataset.date,
                        total_count: parseInt(option.dataset.total_count) || 0,
                        total_amount: parseInt(option.dataset.total_amount) || 0
                    };
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>
                            <input type="hidden" name="buying_transactions[]" value="${id}">
                            #${id}
                        </td>
                        <td>${option.dataset.date}</td>
                        <td class="buying-count">${option.dataset.total_count}</td>
                        <td class="buying-amount" data-amount="${option.dataset.total_amount}">${formatToIDR(option.dataset.total_amount)}</td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-buying" data-id="${id}">Hapus</button></td>
                    `;
                    document.querySelector('#buyingTable tbody').appendChild(row);
                }
            }
        });

        updateRecap();
    }

    // Attach event listeners for auto-select
    document.querySelector('select[name="type"]').addEventListener('change', autoSelectTransactions);
    document.querySelector('input[name="report_date"]').addEventListener('change', autoSelectTransactions);

    // Currency formatting and calculation for other_cost
    document.getElementById('other_cost').addEventListener('blur', function(e) {
        const field = e.target;
        const rawValue = parseIDRToInteger(field.value);
        field.value = formatToIDR(rawValue);
        updateRecap();
    });
    document.getElementById('other_cost').addEventListener('input', updateRecap);

    function updateRecap() {
        // Selling
        let totalSoldCount = 0, totalSelling = 0;
        Object.values(sellingTransactions).forEach(st => {
            totalSoldCount += st.total_count;
            totalSelling += st.total_amount;
        });
        // Buying
        let totalBoughtCount = 0, totalBuying = 0;
        Object.values(buyingTransactions).forEach(bt => {
            totalBoughtCount += bt.total_count;
            totalBuying += bt.total_amount;
        });
        // Other cost
        const otherCost = parseIDRToInteger(document.getElementById('other_cost').value) || 0;
        // Cash flow
        const cashFlow = totalSelling - totalBuying - otherCost;

        document.getElementById('totalSoldCount').innerText = totalSoldCount;
        document.getElementById('totalBoughtCount').innerText = totalBoughtCount;
        document.getElementById('totalSelling').innerText = formatToIDR(totalSelling);
        document.getElementById('totalBuying').innerText = formatToIDR(totalBuying);
        document.getElementById('recapOtherCost').innerText = formatToIDR(otherCost);
        document.getElementById('cashFlow').innerText = formatToIDR(cashFlow);
    }

    // On submit, convert currency fields to integer
    document.getElementById('reportCreateForm').addEventListener('submit', function(e) {
        const otherCost = document.getElementById('other_cost');
        if (otherCost) otherCost.value = parseIDRToInteger(otherCost.value);
    });
}

function printReportDetail(btn) {
    // Find the closest modal and get the report content
    var modal = btn.closest('.modal-content') || document;
    var printContents = modal.querySelector('#report-detail-print').innerHTML;
    var win = window.open('', '', 'height=800,width=1000');
    win.document.write('<html><head><title>Cetak Laporan</title>');
    win.document.write('<link rel="stylesheet" href="{{ asset("assets/plugins/fontawesome-free/css/all.min.css") }}">');
    win.document.write('<link rel="stylesheet" href="{{ asset("assets/css/adminlte.min.css") }}">');
    win.document.write('</head><body>');
    win.document.write(printContents);
    win.document.write('</body></html>');
    win.document.close();
    win.focus();
    setTimeout(function() {
        win.print();
        win.close();
    }, 500);
}
</script>
@endsection
@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Daftar Laporan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Daftar Laporan</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <div class="card-tools input-group">
                <div class="flex-grow-1"></div>
                <a href="{{url('admin/reports/create')}}" class=" btn btn-primary rounded float-right"
                data-target="#showcreatemodal" data-toggle='modal' onclick="showCreate()">Tambah</a>
            </div>
            <div class="modal fade" id="showcreatemodal" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content" id="createmodal">
                        <!-- put animated gif here -->
                        <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
                    </div>
                </div>
            </div>
        </div>
      <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">
                        #
                    </th>
                    <th style="width: 15%">
                        Tanggal Laporan
                    </th>
                    <th style="width: 15%">
                        Pembuat Laporan
                    </th>
                    <th style="width: 10%">
                        Jenis
                    </th>
                    <th style="width: 10%">
                        Total Pembelian
                    </th>
                    <th style="width: 10%">
                        Total Penjualan
                    </th>
                    <th style="width: 10%">
                        Arus Kas
                    </th>
                    <th style="width: 15%">
                    </th>
                    <th style="width: 1%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                <tr id='tr{{$d->id}}'>
                    <td>
                        {{$d->id}}
                    </td>
                    <td>
                        <a>
                            {{$d->report_date}}
                        </a>
                    </td>
                    <td>
                        {{$d->creator->name}}
                    </td>
                    <td>
                        {{$d->type}}
                    </td>
                    <td>
                        @toIDR($d->total_buying)
                    </td>
                    <td>
                        @toIDR($d->total_selling)
                    </td>
                    <td>
                        @toIDR($d->cash_flow)
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{url('admin/reports/'.$d->id)}}"
                            data-target="#show{{$d->id}}" data-toggle='modal' onclick="showDetails({{$d->id}})">
                            <i class="fas fa-folder">
                            </i>
                            Lihat
                        </a>
                        <a class="btn btn-danger btn-sm" href="{{url('admin/reports/'.$d->id)}}"
                            data-target="#delete{{$d->id}}" data-toggle='modal'>
                            <i class="fas fa-trash">
                            </i>
                            Hapus
                        </a>
                    </td>
                    <td>
                        <div class="modal fade" id="show{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content" id="reportdetail{{$d->id}}">
                                    <!-- put animated gif here -->
                                    <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="edit{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" id="reportedit{{$d->id}}">
                                    <!-- put animated gif here -->
                                    <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="delete{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" id="reportdelete{{$d->id}}">
                                    <form method='POST' action="{{route('reports.destroy', $d->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header bg-danger">
                                            <h4 class="modal-title">Hapus Laporan</h4>
                                            <button type="button" class="close" data-dismiss="modal" data-target="delete{{$d->id}}" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus laporan bertanggal "{{$d->report_date}}"?</p>
                                          </div>
                                          <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal" data-target="delete{{$d->id}}">Tutup</button>
                                            <button type="submit" class="btn btn-danger">Hapus Laporan</button>
                                          </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection
