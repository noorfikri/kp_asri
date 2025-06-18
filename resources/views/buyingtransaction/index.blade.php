@extends('layouts.adminlte3')

@section('javascript')
<script>
function showDetails(transaction_id){
    $.ajax({
        type:'POST',
        url:'{{route("buyingtransactions.showDetail")}}',
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
        url:'{{route("buyingtransactions.showCreate")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
        },
        success: function(data){
            $('#createmodal').html(data.msg);

            initializeCreateModal();
        }
    });
}

/*
function showEdit(transaction_id){
    $.ajax({
        type:'POST',
        url:'{{--route("buyingtransactions.showEdit")--}}',
        data:{'_token':'<?php echo csrf_token() ?>',
            'id':transaction_id,
        },
        success: function(data){
            $('#transactionedit'+transaction_id).html(data.msg)
        }
    });
} */

function formatToIDR(amount) {
    return 'Rp. ' + parseFloat(amount).toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 }) + ',00';
}

function parseIDRToInteger(value) {
    return parseInt(value.replace(/Rp\.|,00|[^0-9]/g, ''), 10) || 0;
}

function initializeCreateModal() {
    let itemIndex = 0;

    function calculateTotals() {
        let subtotal = 0;
        let totalCount = 0;

        document.querySelectorAll('#itemTable .itemFields').forEach(row => {
            let quantity =  0;
            if(row.querySelector('.item-quantity').value !== null){
                quantity = parseInt(row.querySelector('.item-quantity').value) || 0;
            }
            const totalPrice = parseFloat(row.querySelector('.item-total-price').dataset.rawPrice) || 0;

            subtotal += totalPrice;
            totalCount += quantity;
        });

        const otherCost = parseIDRToInteger(document.getElementById('otherCost').value) || 0;
        const discount = parseIDRToInteger(document.getElementById('discount').value) || 0;
        const sumTotal = subtotal + otherCost - discount;

        document.getElementById('subtotal').value = formatToIDR(subtotal);
        document.getElementById('totalCount').value = totalCount;
        document.getElementById('sumTotal').value = formatToIDR(sumTotal);
    }

    document.getElementById('addItem').addEventListener('click', function () {
        const tableBody = document.querySelector('#itemTable tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
            <select name="items[${itemIndex}][item_id]" class="form-control item-select @error('items.${itemIndex}.item_id') is-invalid @enderror" required>
                <option value="">Pilih Barang</option>
                <option value="new">Tambah Barang Baru</option>
                @foreach ($items as $item)
                <option value="{{ $item->id }}" data-price="{{ $item->price }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('items.${itemIndex}.item_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </td>
            <td>
            <input type="text" class="form-control item-price" readonly>
            </td>
            <td>
            <input type="number" name="items[${itemIndex}][quantity]" class="form-control item-quantity @error('items.${itemIndex}.quantity') is-invalid @enderror" placeholder="Jumlah" min="1" required>
            @error('items.${itemIndex}.quantity')
                <div class="invalid-feedback">{{ $message }}</div>
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

        const newItemRow = document.createElement('tr');
        newItemRow.classList.add('new-item-fields');
        newItemRow.style.display = 'none';
        newItemRow.innerHTML = `
            <td>
            <input type="text" name="items[${itemIndex}][new_name]" class="form-control @error('items.${itemIndex}.new_name') is-invalid @enderror" placeholder="Nama Barang Baru" required>
            @error('items.${itemIndex}.new_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </td>
            <td>
            <input type="number" name="items[${itemIndex}][new_price]" class="form-control @error('items.${itemIndex}.new_price') is-invalid @enderror" placeholder="Harga Barang Baru" min="0" required>
            @error('items.${itemIndex}.new_price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </td>
            <td>
            <input type="number" name="items[${itemIndex}][new_stock]" class="form-control @error('items.${itemIndex}.new_stock') is-invalid @enderror" placeholder="Stok Barang Baru" min="0" required>
            @error('items.${itemIndex}.new_stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </td>
            <td colspan="2"></td>
        `;
        tableBody.appendChild(newItemRow);
    });

    document.querySelector('#itemTable').addEventListener('change', function (e) {
        if (e.target.classList.contains('item-select')) {
            const row = e.target.closest('tr');
            const newItemRow = row.nextElementSibling;
            const priceField = row.querySelector('.item-price');

            if (e.target.value === 'new') {
                newItemRow.style.display = 'table-row';
                priceField.value = '';
            } else {
                newItemRow.style.display = 'none';
                const price = parseFloat(e.target.selectedOptions[0].getAttribute('data-price')) || 0;

                row.querySelector('.item-price').value = formatToIDR(price);
                row.querySelector('.item-price').dataset.rawPrice = price;
                row.querySelector('.item-quantity').value = '';
                row.querySelector('.item-total-price').value = '';
                row.querySelector('.item-total-price').dataset.rawPrice = 0;

                calculateTotals();
            }
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
            const row = e.target.closest('tr');
            const newItemRow = row.nextElementSibling;
            row.remove();
            if (newItemRow && newItemRow.classList.contains('new-item-fields')) {
                newItemRow.remove();
            }
        }
    });

    document.getElementById('otherCost').addEventListener('blur', function () {
        const field = document.getElementById('otherCost');
        field.value = formatToIDR(parseIDRToInteger(field.value));
        calculateTotals();
    });

    document.getElementById('discount').addEventListener('blur', function () {
        const field = document.getElementById('discount');
        field.value = formatToIDR(parseIDRToInteger(field.value));
        calculateTotals();
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
          <h1>Daftar Transaksi Pembelian</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Daftar Transaksi Pembelian</li>
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
                <a href="{{url('admin/buyingtransactions/create')}}" class="btn btn-primary rounded"
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
                    <th style="width: 10%">Supplier</th>
                    <th style="width: 10%">Tanggal</th>
                    <th style="width: 15%">Total Biaya</th>
                    <th style="width: 10%">Jumlah Barang</th>
                    <th style="width: 20%"></th>
                    <th style="width: 1%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                <tr id='tr{{$d->id}}'>
                    <td>{{$d->id}}</td>
                    <td>{{$d->supplier->name}}</td>
                    <td>{{$d->date}}</td>
                    <td>@toIDR($d->total_amount)</td>
                    <td>{{$d->total_count}}</td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{url('admin/buyingtransactions/'.$d->id)}}"
                            data-target="#show{{$d->id}}" data-toggle='modal' onclick="showDetails({{$d->id}})">
                            <i class="fas fa-folder"></i> Lihat
                        </a>
                        <a class="btn btn-info btn-sm" href="{{url('admin/buyingtransactions/'.$d->id.'/edit')}}"
                            data-target="#edit{{$d->id}}" data-toggle='modal' onclick="showEdit({{$d->id}})">
                            <i class="fas fa-pencil-alt"></i> Ubah
                        </a>
                        <a class="btn btn-danger btn-sm" href="{{url('admin/buyingtransactions/'.$d->id)}}"
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
                            <div class="modal-dialog">
                                <div class="modal-content" id="transactionedit{{$d->id}}">
                                    <img src="{{ asset('assets/img/ajax-modal-loading.gif')}}" alt="" class="loading">
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="delete{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" id="transactiondelete{{$d->id}}">
                                    <form method='POST' action="{{route('buyingtransactions.destroy', $d->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header bg-danger">
                                            <h4 class="modal-title">Hapus Transaksi</h4>
                                            <button type="button" class="close" data-dismiss="modal" data-target="delete{{$d->id}}" aria-label="Tutup">
                                              <span aria-hidden="true">×</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus transaksi "{{$d->transaction_code}}"?</p>
                                          </div>
                                          <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal" data-target="delete{{$d->id}}">Tutup</button>
                                            <button type="submit" class="btn btn-danger">Hapus Transaksi</button>
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
    </div>

  </section>
@endsection
