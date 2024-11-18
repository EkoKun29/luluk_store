@extends('layouts.app')
@section('title')
Detail Pembelian
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
                                        <a href="#">Pembelian</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Detail
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== tables-wrapper start ========== -->
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="card-style mb-30">
                        <div>
                            {{ $purchase->formatted_date }}
                        </div>
                        <div>
                            <h3 class="text-success">{{ $purchase->note_number }}</h3>
                        </div>
                        <hr>
                        <div class="input-style-1">
                            <p><u><b>Supplier</b></u></p>
                            <p>{{ $purchase->supplier }}</p>
                        </div>
                        <div class="input-style-1">
                            <p><u><b>Nama Kasir</b></u></p>
                            <p>{{ $purchase->store_name }}</p>
                        </div>
                        <hr>
                        <div>
                            <h3 class="text-primary">{{ $purchase->method->name }}</h3>
                        </div>
                    </div>
                    <a target="_blank" href="{{ route('purchase.print', $purchase->id) }}" type="button" class="main-btn primary-btn rounded-md btn-hover mb-30">Cetak Struk</a>
                    <!-- end card -->
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="card-style mb-10">
                        <h6>Detail Barang</h6>
                        <hr>
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
                                        <h6>Satuan</h6>
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
                                @foreach ($purchase->purchaseDetails as $index => $purchase_detail)
                                    <tr id="{{ $purchase_detail['product_id'] }}">
                                        <td class="p-name">{{ $purchase_detail->product->name }}</td>
                                        <td class="p-amount">{{ $purchase_detail['amount'] }}</td>
                                        <td class="p-name">{{ $purchase_detail->product->unit }}</td>
                                        <td class="p-price">
                                            {{ 'Rp ' . number_format($purchase_detail['price'], 2, ',', '.') }}</td>
                                        <td class="p-total">
                                            {{ 'Rp ' . number_format($purchase_detail['amount'] * $purchase_detail['price'], 2, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-style mb-10 d-flex p-3 justify-content-between align-items-center">
                        <h6>Total Harga</h6>
                        <h4>
                            <u>{{ 'Rp ' . number_format($purchase->total, 2, ',', '.') }}</u>
                        </h4>
                    </div>
                    <div class="card-style mb-10 p-3">
                        <h6>Pembayaran</h6>
                        <hr>
                        @if ($purchase->method->value == 1)
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Pembayaran Transaksi</span>
                                <h5 class="text-primary">
                                    {{ 'Rp ' . number_format($purchase->amount_paid, 2, ',', '.') }}
                                </h5>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Pembayaran Hutang</span>
                                <h5 class="text-primary">
                                    {{ 'Rp ' . number_format($purchase->debt_paid_off, 2, ',', '.') }}
                                </h5>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Total Dibayar</span>
                                <h5 class="text-success">
                                    {{ 'Rp ' . number_format($purchase->amount_paid + $purchase->debt_paid_off, 2, ',', '.') }}
                                </h5>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Kekurangan</span>
                                <h5 class="text-danger">
                                    {{ 'Rp ' . number_format($purchase->total - ($purchase->amount_paid + $purchase->debt_paid_off), 2, ',', '.') }}
                                </h5>
                            </div>
                        @else
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Total Dibayar</span>
                                <h5 class="text-success">
                                    {{ 'Rp ' . number_format($purchase->amount_paid, 2, ',', '.') }}
                                </h5>
                            </div>
                        @endif
                    </div>
                    @if ($purchase->method->value == 1)
                        <div class="card-style mb-10">
                            <h6>Detail Pembayaran Hutang</h6>
                            <hr>
                            <table id="tblProducts" class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6>Tanggal</h6>
                                        </th>
                                        <th>
                                            <h6>Jumlah Pembayaran</h6>
                                        </th>
                                        <th>
                                            <h6>Metode</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($purchase->debtPayments as $index => $debtPayment)
                                        <tr>
                                            <td>{{ $debtPayment->date->isoFormat('dddd, D MMMM YYYY') }}</td>
                                            <td>
                                                {{ 'Rp ' . number_format($debtPayment->amount_paid, 2, ',', '.') }}
                                            </td>
                                            <td>{{ $debtPayment->method->name }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
                    @if ($purchase->method->value == '2')
                        <div class="card-style mb-10">
                            <table class="table">
                                <tr>
                                    <th>Nama Bank</th>
                                    <td>: {{ $purchase->transferPurchase?->noRekening->bank->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Rekening</th>
                                    <td>: {{ $purchase->transferPurchase?->noRekening->account_number ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Atas Nama</th>
                                    <td>: {{ $purchase->transferPurchase?->noRekening->name ?? '' }}</td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
            <!-- ========== tables-wrapper end ========== -->
        </div>
        <!-- end container -->
    </section>
@endsection
