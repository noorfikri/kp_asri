@extends('layouts.adminlte3')

@section('javascript')
<script>
function formatToIDR(amount) {
    return 'Rp. ' + parseFloat(amount).toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 }) + ',00';
}

function parseIDRToInteger(value) {
    return parseInt(value.replace(/Rp\.|,00|[^0-9]/g, ''), 10) || 0;
}

function showDetails(transaction_id){
    $.ajax({
        type:'POST',
        url:'{{route("sellingtransactions.showDetail")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
            'id':transaction_id
        },
        success: function(data){
            $('#transactiondetail'+transaction_id).html(data.msg)
        }
    });
}

function showCreate(){
    $.ajax({
        type:'POST',
        url:'{{route("sellingtransactions.showCreate")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
        },
        success: function(data){
            $('#createmodal').html(data.msg);

            initializeCreateModal();
        }
    });
}


function showEdit(transaction_id){
    $.ajax({
        type:'POST',
        url:'{{route("sellingtransactions.showEdit")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
            'id':transaction_id,
        },
        success: function(data){
            $('#transactionedit'+transaction_id).html(data.msg);

            initializeEditModal(transaction_id);
        }
    });
}

function initializeCreateModal(){

    function calculateTotals() {
        let subtotal = 0;
        let totalCount = 0;

        document.querySelectorAll('#itemTable tbody tr').forEach(row => {
            const quantity = parseInt(row.querySelector('.item-quantity').value) || 0;
            const totalPrice = parseFloat(row.querySelector('.item-total-price').dataset.rawPrice) || 0;

            subtotal += totalPrice;
            totalCount += quantity;
        });

        const discount = parseIDRToInteger(document.getElementById('discount').value) || 0;
        const sumTotal = subtotal - discount;

        document.getElementById('subtotal').value = formatToIDR(subtotal);
        document.getElementById('totalCount').value = totalCount;
        document.getElementById('sumTotal').value = formatToIDR(sumTotal);
    }

    let itemIndex = 0;

    calculateTotals();

    document.getElementById('addItem').addEventListener('click', function () {
        const tableBody = document.querySelector('#itemTable tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
        <td>
            <select name="items[${itemIndex}][item_id]" class="form-control item-select @error('items.${itemIndex}.item_id') is-invalid @enderror" required>
            <option value="">Pilih Barang</option>
            @foreach ($items as $item)
                <option value="{{ $item->id }}" data-price="{{ $item->price }}">{{ $item->name }}</option>
            @endforeach
            </select>
            @error('items.${itemIndex}.item_id')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </td>
        <td>
            <input type="text" class="form-control item-price" readonly>
        </td>
        <td>
            <input type="number" name="items[${itemIndex}][quantity]" class="form-control item-quantity @error('items.${itemIndex}.quantity') is-invalid @enderror" placeholder="Jumlah" min="1" required>
            @error('items.${itemIndex}.quantity')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </td>
        <td>
            <input type="text" name="items[${itemIndex}][price]" class="form-control item-total-price" placeholder="Harga Total" readonly data-raw-price="0">
        </td>
        <td>
            <button type="button" class="btn btn-danger remove-item">Hapus</button>
        </td>
        `;
        tableBody.appendChild(newRow);
        itemIndex++;
    });

    document.querySelector('#itemTable').addEventListener('change', function (e) {
        if (e.target.classList.contains('item-select')) {
            const row = e.target.closest('tr');
            const price = parseFloat(e.target.selectedOptions[0].getAttribute('data-price')) || 0;

            row.querySelector('.item-price').value = formatToIDR(price);
            row.querySelector('.item-price').dataset.rawPrice = price;
            row.querySelector('.item-quantity').value = '';
            row.querySelector('.item-total-price').value = '';
            row.querySelector('.item-total-price').dataset.rawPrice = 0;

            calculateTotals();
        }

        if (e.target.classList.contains('item-quantity')) {
            const row = e.target.closest('tr');
            const price = parseFloat(row.querySelector('.item-price').dataset.rawPrice) || 0;
            const quantity = parseInt(e.target.value) || 0;
            const totalPrice = price * quantity;

            row.querySelector('.item-total-price').value = formatToIDR(totalPrice);
            row.querySelector('.item-total-price').dataset.rawPrice = totalPrice;

            calculateTotals();
        }
    });

    document.querySelector('#itemTable').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-item')) {
            e.target.closest('tr').remove();
            calculateTotals();
        }
    });

    document.getElementById('discount').addEventListener('blur', function (e) {
        const discountField = e.target;

        const rawValue = parseIDRToInteger(discountField.value);

            if (discountField.value === '' || isNaN(rawValue)) {
            discountField.value = '';
            calculateTotals();
            return;
        }

        discountField.value = formatToIDR(rawValue);

        calculateTotals();
    });

    document.querySelector('form').addEventListener('submit', function (e) {
        const subtotalField = document.getElementById('subtotal');
        const discountField = document.getElementById('discount');
        const sumTotalField = document.getElementById('sumTotal');

        subtotalField.value = parseIDRToInteger(subtotalField.value);
        discountField.value = parseIDRToInteger(discountField.value);
        sumTotalField.value = parseIDRToInteger(sumTotalField.value);

        document.querySelectorAll('#itemTable tbody tr').forEach(row => {
            const totalPriceField = row.querySelector('.item-total-price');
            totalPriceField.value = parseIDRToInteger(totalPriceField.value);
        });
    });
}

function initializeEditModal(transaction_id) {
    const itemTable = document.querySelector(`#transactionedit${transaction_id} #itemTable`);

    function calculateTotals() {
    let subtotal = 0;
    let totalCount = 0;

    itemTable.querySelectorAll('tbody tr').forEach(row => {
        const quantityField = row.querySelector('.item-quantity');
        const totalPriceField = row.querySelector('.item-total-price');

        if (quantityField && totalPriceField) {
            const quantity = parseInt(quantityField.value) || 0;
            const totalPrice = parseFloat(totalPriceField.dataset.rawPrice) || 0;

            subtotal += totalPrice;
            totalCount += quantity;
        }
    });

    const discountField = document.querySelector(`#transactionedit${transaction_id} #discount`);
    const discount = parseIDRToInteger(discountField.value) || 0;

    const sumTotal = subtotal - discount;

    document.querySelector(`#transactionedit${transaction_id} #subtotal`).value = formatToIDR(subtotal);
    document.querySelector(`#transactionedit${transaction_id} #totalCount`).value = totalCount;
    document.querySelector(`#transactionedit${transaction_id} #sumTotal`).value = formatToIDR(sumTotal);
}

    document.querySelector(`#transactionedit${transaction_id} #addItem`).addEventListener('click', function () {
        const tableBody = itemTable.querySelector('tbody');
        const newRow = document.createElement('tr');
        const itemIndex = 0;

        newRow.innerHTML = `
            <td>
            <select name="items[${itemIndex}][item_id]" class="form-control item-select @error('items.${itemIndex}.item_id') is-invalid @enderror" required>
                <option value="">Pilih Barang</option>
                @foreach ($items as $availableItem)
                <option value="{{ $availableItem->id }}" data-price="{{ $availableItem->price }}">{{ $availableItem->name }}</option>
                @endforeach
            </select>
            @error('items.${itemIndex}.item_id')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            </td>
            <td>
            <input type="text" class="form-control item-price" readonly>
            </td>
            <td>
            <input type="number" name="items[${itemIndex}][quantity]" class="form-control item-quantity @error('items.${itemIndex}.quantity') is-invalid @enderror" placeholder="Jumlah" min="1" required>
            @error('items.${itemIndex}.quantity')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            </td>
            <td>
            <input type="text" name="items[${itemIndex}][price]" class="form-control item-total-price" placeholder="Harga Total" readonly data-raw-price="0">
            </td>
            <td>
            <button type="button" class="btn btn-danger remove-item">Hapus</button>
            </td>
        `;
        tableBody.appendChild(newRow);

        itemIndex++

        calculateTotals();
    });

    itemTable.addEventListener('change', function (e) {
        if (e.target.classList.contains('item-select')) {
            const row = e.target.closest('tr');
            const price = parseFloat(e.target.selectedOptions[0].getAttribute('data-price')) || 0;

            row.querySelector('.item-price').value = formatToIDR(price);
            row.querySelector('.item-price').dataset.rawPrice = price;
            row.querySelector('.item-quantity').value = '';
            row.querySelector('.item-total-price').value = '';
            row.querySelector('.item-total-price').dataset.rawPrice = 0;

            calculateTotals();
        }

        if (e.target.classList.contains('item-quantity')) {
            const row = e.target.closest('tr');
            const price = parseFloat(row.querySelector('.item-price').dataset.rawPrice) || 0;
            const quantity = parseInt(e.target.value) || 0;
            const totalPrice = price * quantity;

            row.querySelector('.item-total-price').value = formatToIDR(totalPrice);
            row.querySelector('.item-total-price').dataset.rawPrice = totalPrice;

            calculateTotals();
        }
    });

    itemTable.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-item')) {
            e.target.closest('tr').remove();
            calculateTotals();
        }
    });

    const discountField = document.querySelector(`#transactionedit${transaction_id} #discount`);
    discountField.addEventListener('blur', function () {
        const rawValue = parseIDRToInteger(discountField.value);
        discountField.value = formatToIDR(rawValue);
        calculateTotals();
    });

    document.querySelector(`#transactionedit${transaction_id} form`).addEventListener('submit', function () {
        const subtotalField = document.querySelector(`#transactionedit${transaction_id} #subtotal`);
        const discountField = document.querySelector(`#transactionedit${transaction_id} #discount`);
        const sumTotalField = document.querySelector(`#transactionedit${transaction_id} #sumTotal`);

        subtotalField.value = parseIDRToInteger(subtotalField.value);
        discountField.value = parseIDRToInteger(discountField.value);
        sumTotalField.value = parseIDRToInteger(sumTotalField.value);


        itemTable.querySelectorAll('tbody tr').forEach(row => {
            const totalPriceField = row.querySelector('.item-total-price');
            if (totalPriceField) {
                totalPriceField.value = parseIDRToInteger(totalPriceField.value);
            }
        });
    });
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
          <h1>Daftar Transaksi Penjualan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Daftar Transaksi Penjualan</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="card">
        <div class="card-header">
            <div class="card-tools input-group">
                <input type="search" class="form-control rounded m-auto" placeholder="Cari" aria-label="Cari" aria-describedby="search-addon" />
                <button type="button" class="btn btn-outline-primary rounded" data-mdb-ripple-init>Cari</button>
                <a href="{{url('admin/sellingtransactions/create')}}" class="btn btn-primary rounded"
                data-target="#showcreatemodal" data-toggle='modal' onclick="showCreate()">Tambah</a>
            </div>
            <div class="modal fade" id="showcreatemodal" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content" id="createmodal">
                        <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
                    </div>
                </div>
            </div>
        </div>
      <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">#</th>
                    <th style="width: 10%">Penjual</th>
                    <th style="width: 10%">Tanggal</th>
                    <th style="width: 15%">Total Pendapatan</th>
                    <th style="width: 10%">Jumlah Barang</th>
                    <th style="width: 20%"></th>
                    <th style="width: 1%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                <tr id='tr{{$d->id}}'>
                    <td>{{$d->id}}</td>
                    <td>{{$d->seller->name}}</td>
                    <td>{{$d->date}}</td>
                    <td>@toIDR($d->total_amount)</td>
                    <td>{{$d->total_count}}</td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{url('admin/sellingtransactions/'.$d->id)}}"
                            data-target="#show{{$d->id}}" data-toggle='modal' onclick="showDetails({{$d->id}})">
                            <i class="fas fa-folder"></i> Lihat
                        </a>
                        <a class="btn btn-info btn-sm" href="{{url('admin/sellingtransactions/'.$d->id.'/edit')}}"
                            data-target="#edit{{$d->id}}" data-toggle='modal' onclick="showEdit({{$d->id}})">
                            <i class="fas fa-pencil-alt"></i> Ubah
                        </a>
                        <a class="btn btn-danger btn-sm" href="{{url('admin/sellingtransactions/'.$d->id)}}"
                            data-target="#delete{{$d->id}}" data-toggle='modal'>
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </td>
                    <td>
                        <div class="modal fade" id="show{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content" id="transactiondetail{{$d->id}}">
                                    <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="edit{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content" id="transactionedit{{$d->id}}">
                                    <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="delete{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content" id="transactiondelete{{$d->id}}">
                                    <form method='POST' action="{{route('sellingtransactions.destroy', $d->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header bg-danger">
                                            <h4 class="modal-title">Hapus Transaksi</h4>
                                            <button type="button" class="close" data-dismiss="modal" data-target="delete{{$d->id}}" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus transaksi dengan tanggal "{{$d->date}}"?</p>
                                            <p>Anda dapat menghapus transaksi namun tetap tidak merubah perubahan barang yang terjadi dengan <strong>"Hapus Transaksi"</strong></p>
                                            <p>Atau anda dapat menghapus transaksi dan mengembalikan perubahan barang yang telah terjadi dengan <strong>"Hapus Transaksi Dan Kembalikan Barang"</strong></p>
                                          </div>
                                          <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal" data-target="delete{{$d->id}}">Tutup</button>
                                            <form method='POST' action="{{route('sellingtransactions.destroy', $d->id)}}">
                                            @csrf
                                            @method('DELETE')
                                                 <button type="submit" class="btn btn-danger">Hapus Transaksi</button>
                                            </form>
                                            <form method='POST' action="{{route('sellingtransactions.deleteAddStock', $d->id)}}">
                                            @csrf
                                            @method('POST')
                                                <button type="submit" class="btn btn-danger">Hapus Transaksi Dan Kembalikan Barang</button>
                                            </form>
                                          </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>

  </section>
@endsection
