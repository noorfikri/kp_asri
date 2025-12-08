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

            $("#inputImageCreate").change(function(){
                createPreviewImage(this);
            });

            initializeCreateModal();
        }
    });
}

function createPreviewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#create-preview-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function formatToIDR(amount) {
    return 'Rp. ' + parseFloat(amount).toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 }) + ',00';
}

function parseIDRToInteger(value) {
    return parseInt(value.replace(/Rp\.|,00|[^0-9]/g, ''), 10) || 0;
}

function initializeCreateModal() {
    let itemIndex = document.querySelectorAll('#itemTable tbody tr').length;

    document.getElementById('addItem').addEventListener('click', function () {
        const tableBody = document.querySelector('#itemTable tbody');
        const newRow = tableBody.rows[0].cloneNode(true);

        Array.from(newRow.querySelectorAll('select, input')).forEach(function (el) {
            el.name = el.name.replace(/\d+/, itemIndex);
            if (el.classList.contains('item-quantity') || el.classList.contains('item-total-price')) {
                el.value = '';
                el.dataset.rawPrice = 0;
            }
            if (el.classList.contains('item-price')) {
                el.value = formatToIDR(0);
                el.dataset.rawPrice = 0;
            }
            el.classList.remove('is-invalid');
        });
        tableBody.appendChild(newRow);
        itemIndex++;
        attachRowEvents(newRow);
        calculateTotals();
    });

    document.getElementById('itemTable').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-item')) {
            const rows = this.getElementsByTagName('tbody')[0].rows;
            if (rows.length > 1) {
                e.target.closest('tr').remove();
                calculateTotals();
            }
        }
    });

    document.querySelectorAll('#itemTable tbody tr').forEach(row => attachRowEvents(row));

    document.getElementById('discount').addEventListener('input', calculateTotals);
    document.getElementById('other_cost').addEventListener('input', calculateTotals);

    function attachRowEvents(row) {
        row.querySelector('.item-select').addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            const price = selected.dataset.price ? parseInt(selected.dataset.price) : 0;
            row.querySelector('.item-price').value = formatToIDR(price);
            row.querySelector('.item-price').dataset.rawPrice = price;
            updateRowTotal(row);
            calculateTotals();
        });

        row.querySelector('.item-quantity').addEventListener('input', function () {
            updateRowTotal(row);
            calculateTotals();
        });
    }

    function updateRowTotal(row) {
        const price = parseInt(row.querySelector('.item-price').dataset.rawPrice) || 0;
        const quantity = parseInt(row.querySelector('.item-quantity').value) || 0;
        const total = price * quantity;
        row.querySelector('.item-total-price').value = formatToIDR(total);
        row.querySelector('.item-total-price').dataset.rawPrice = total;
    }

    function calculateTotals() {
        let subtotal = 0;
        let totalCount = 0;

        document.querySelectorAll('#itemTable tbody tr').forEach(row => {
            const quantity = parseInt(row.querySelector('.item-quantity').value) || 0;
            const totalPrice = parseInt(row.querySelector('.item-total-price').dataset.rawPrice) || 0;
            subtotal += totalPrice;
            totalCount += quantity;
        });

        const discount = parseIDRToInteger(document.getElementById('discount').value) || 0;
        const otherCost = parseIDRToInteger(document.getElementById('other_cost').value) || 0;
        const sumTotal = subtotal + otherCost - discount;

        document.getElementById('subtotal').value = formatToIDR(subtotal);
        document.getElementById('totalCount').value = totalCount;
        document.getElementById('sumTotal').value = formatToIDR(sumTotal);
    }



    document.getElementById('discount').addEventListener('blur', function (e) {
        const field = e.target;
        const rawValue = parseIDRToInteger(field.value);
        if (field.value === '' || isNaN(rawValue)) {
            field.value = '';
            calculateTotals();
            return;
        }
        field.value = formatToIDR(rawValue);
        calculateTotals();
    });
    document.getElementById('other_cost').addEventListener('blur', function (e) {
        const field = e.target;
        const rawValue = parseIDRToInteger(field.value);
        if (field.value === '' || isNaN(rawValue)) {
            field.value = '';
            calculateTotals();
            return;
        }
        field.value = formatToIDR(rawValue);
        calculateTotals();
    });

    const form = document.querySelector('#createmodal form');
    if (form) {
        form.addEventListener('submit', function(e) {
            let valid = true;
            form.querySelectorAll('.item-quantity').forEach(function(input) {
                if (!input.value || parseInt(input.value) < 1) {
                    input.classList.add('is-invalid');
                    valid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            if (!valid) {
                e.preventDefault();
                alert('Jumlah barang per item harus diisi dan lebih dari 0.');
                return;
            }
            form.querySelectorAll('.item-price, .item-total-price').forEach(function(input) {
                input.value = parseIDRToInteger(input.value);
            });
            const subtotal = form.querySelector('#subtotal');
            if (subtotal) subtotal.value = parseIDRToInteger(subtotal.value);
            const sumTotal = form.querySelector('#sumTotal');
            if (sumTotal) sumTotal.value = parseIDRToInteger(sumTotal.value);
            const discount = form.querySelector('#discount');
            if (discount) discount.value = parseIDRToInteger(discount.value);
            const otherCost = form.querySelector('#other_cost');
            if (otherCost) otherCost.value = parseIDRToInteger(otherCost.value);
        });
    }
}
</script>
@endsection

@section('content')
@if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<section class="content-header">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Daftar Transaksi Pembelian</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Daftar Transaksi Pembelian</li>
            </ol>
        </div>
    </div>
</section>

<section class="content">
    <div class="alert alert-primary">
        <h5 class="color"><strong><i class="fa-solid fa-circle-info"></i> Bantuan</strong></h5>
        Halaman ini adalah halaman <strong>Transaksi Pembelian</strong>. Anda dapat mendaftarkan dan memanajemen <strong>Daftar Transaksi Pembelian</strong> yang terdapat didalam sistem.<br>
        <br> <strong>Cara penggunaan :</strong>
        <ul>
            <li>
                <p class="my-0 py-0">
                    <i class="fas fa-plus"></i> <strong>Buat Transaksi Baru</strong> : Untuk menambah informasi <strong>Transaksi Pembelian Baru</strong> ke sistem. <strong>Pastikan anda sudah menambahkan kombinasi stok dan warna pada barang transaksi.</strong>
                </p>
            </li>
            <li>
                <p class="my-0 py-0">
                    <i class="fas fa-folder"></i> <strong>Lihat</strong> : Untuk melakukan <strong>Melihat Rincian Transaksi Pembelian</strong> yang terdapat didalam sistem.
                </p>
            </li>
            <li>
                <p class="my-0 py-0">
                    <i class="fas fa-trash"></i> <strong> Hapus </strong>: Untuk melakukan <strong>Penghapusan Transaksi Pembelian</strong> yang terdapat disistem. <strong>Pastikan tidak ada data atau informasi yang menggunakan Transaksi Pembelian yang akan dihapus.</strong>
                </p>
            </li>
        </ul>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-tools input-group">
                <div class="flex-grow-1"></div>
                <a href="{{url('admin/buyingtransactions/create')}}" class="btn btn-primary rounded-pill float-right"
                   data-target="#showcreatemodal" data-toggle='modal' onclick="showCreate()">
                    <i class="fas fa-plus"></i> Buat Transaksi Baru
                </a>
            </div>
            <div class="modal fade" id="showcreatemodal" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content" id="createmodal">
                                    <div class="overlay dark">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover projects">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Supplier</th>
                        <th>Tanggal</th>
                        <th>Total Biaya</th>
                        <th>Jumlah Barang</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center">
                            Tidak ada data yang tersedia dalam daftar transaksi pembelian.
                        </td>
                    </tr>
                    @else
                    @foreach ($data as $d)
                    <tr id='tr{{$d->id}}'>
                        <td>{{$d->id}}</td>
                        <td>{{$d->supplier->name}}</td>
                        <td>{{$d->date}}</td>
                        <td>@toIDR($d->total_amount)</td>
                        <td>{{$d->total_count}}</td>
                        <td class="project-actions text-right">
                            <a class="btn btn-outline-primary rounded-pill" href="{{url('admin/buyingtransactions/'.$d->id)}}"
                                data-target="#show{{$d->id}}" data-toggle='modal' onclick="showDetails({{$d->id}})">
                                <i class="fas fa-folder"></i> Lihat
                            </a>
                            @can('delete', $d)
                            <a class="btn btn-outline-danger rounded-pill" href="{{url('admin/buyingtransactions/'.$d->id)}}"
                                data-target="#delete{{$d->id}}" data-toggle='modal'>
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                            @endcan
                        </td>
                        <td>
                            <div class="modal fade" id="show{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content" id="transactiondetail{{$d->id}}">
                                    <div class="overlay dark">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="delete{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content" id="transactiondelete{{$d->id}}">
                                        <div class="card modal-body card-outline card-danger shadow-lg p-0">
                                        <form method='POST' action="{{route('buyingtransactions.deleteSubstractStock', $d->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header d-flex justify-content-between my-0 py-0 border-0">
                                                <div class="bg-danger py-2 px-3 my-0 rounded-bottom rounded-3">
                                                <h4 class="modal-title"><i class="fa-solid fa-trash"></i> Hapus Transaksi</h4>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus transaksi dengan tanggal "{{$d->date}}"?</p>
                                                <br>
                                                <p>Stok barang yang dimasukkan akan dikembalikan ke semula</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-outline-dark rounded-pill" data-dismiss="modal" data-target="delete{{$d->id}}"> <i class="fa-solid fa-xmark"></i> Tutup</button>
                                                <button type="submit" class="btn btn-danger rounded-pill float-right"><i class="fas fa-trash"></i>  Hapus Transaksi</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
