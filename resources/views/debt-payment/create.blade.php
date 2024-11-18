@extends('layouts.app')
@section('title')
    Tambah Pembayaran Hutang @yield('name')
@endsection
@section('content')
    <section class="table-components">
        <div class="container-fluid">

            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <!-- end col -->
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper mb-30">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Pembayaran Hutang @yield('name')</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Tambah
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- ========== tables-wrapper start ========== -->
            <form action="{{ route('debt-payments.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="card-style mb-30">
                            <div class="input-style-1">
                                <label>Tanggal</label>
                                <input type="date" placeholder="Tanggal Pembayaran" name="date"
                                    value="{{ old('date') }}" required>
                            </div>
                            <div class="select-style-1">
                                <label>Nota Penjualan</label>
                                <div class="select-position">
                                    <select id="purchase_id" name="purchase_id" required>
                                        <option value="" selected hidden>Pilih Nota Pembelian</option>
                                        @foreach ($purchases as $purchase)
                                            <option value="{{ $purchase->id }}"
                                                {{ old('purchase_id') == $purchase->id ? 'selected' : '' }}>
                                                {{ $purchase->note_number . ' - ' . $purchase->supplier. ' - ' . $purchase->formatted_date }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="input-style-1">
                                <label>Jumlah Dibayarkan</label>
                                <input type="number" placeholder="Jumlah Dibayarkan" name="amount_paid"
                                    value="{{ old('amount_paid') }}" required>
                            </div>
                            @yield('method-input')
                        </div>
                        <!-- end card -->
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <div class="card-style mb-30">
                            <table id="tblProducts" class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6>Barang</h6>
                                        </th>
                                        <th>
                                            <h6>Jumlah</h6>
                                        </th>
                                        <th>
                                            <h6>Ukuran</h6>
                                        </th>
                                        <th>
                                            <h6>Harga</h6>
                                        </th>
                                        <th>
                                            <h6>Total</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-style mb-10 d-flex p-3 justify-content-between align-items-center">
                            <h6>Dibayarkan : <span id="paidOffTotal"></span></h6>
                            <h6>Dari : <span id="total"></span></h6>
                        </div>
                        <div class="card-style mb-30 p-3 align-items-center">
                            <h6>Kekurangan : <span id="insufficientTotal"></span></h6>
                        </div>
                        @yield('method-attr-input')
                        <div class="card-style">
                            <button type="submit" class="main-btn primary-btn rounded-md btn-hover">Simpan</button>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </form>
            <!-- ========== tables-wrapper end ========== -->
        </div>
        <!-- end container -->
    </section>
@endsection
@push('js')
    <script>
        const currentPurchaseId = "{{ old('purchase_id') }}"
        const purchases = @json($purchases);

        function changePurchaseId(purchaseId) {
            $('#tblProducts tbody tr').remove();
            let purchase = purchases.find(purchase => purchase.id === purchaseId);
            if (purchase != null) {
                $('#paidOffTotal').text(formatRupiah((purchase.debt_paid_off + purchase.amount_paid).toString()));
                $('#total').text(formatRupiah(purchase.total.toString()));
                $('#insufficientTotal').text(formatRupiah((purchase.total - (purchase.debt_paid_off + purchase.amount_paid))
                    .toString()));
                for (let purchase_detail of purchase.purchase_details) {
                    $('#tblProducts tbody').append(
                        `<tr>
                            <td>${purchase_detail.product.name}</td>
                            <td>${purchase_detail.amount}</td>
                            <td>${purchase_detail.product.unit}</td>
                            <td>${formatRupiah(purchase_detail.price.toString())}</td>
                            <td>${formatRupiah((purchase_detail.price * purchase_detail.amount).toString())}</td>
                        </tr>`
                    );
                }
            }
        }

        $(document).ready(function() {

            if (currentPurchaseId) {
                changePurchaseId(currentPurchaseId);
            }

            $('#purchase_id').on('change', function() {
                changePurchaseId(this.value);
            });
        })
    </script>
@endpush
