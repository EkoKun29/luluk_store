@extends('layouts.app')
@section('title')
    Detail Penjualan
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
                                        <a href="#">Penjualan</a>
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
                            {{ $sale->formatted_date }}
                        </div>
                        <div>
                            <h3 class="text-success">{{ $sale->note_number }}</h3>
                        </div>
                        <hr>
                        <div class="input-style-1">
                            <p><u><b>Konsumen</b></u></p>
                            <p>{{ $sale->consumer }}</p>
                        </div>
                        <div class="input-style-1">
                            <p><u><b>Nama Kasir</b></u></p>
                            <p>{{ $sale->store_name }}</p>
                        </div>
                        <hr>
                        <div>
                            <h3 class="text-primary">{{ $sale->method->name }}</h3>
                        </div>
                    </div>
                    <a target="_blank" href="{{ route('sale.print', $sale->id) }}" type="button" class="main-btn primary-btn rounded-md btn-hover mb-30">Cetak Struk</a>
                    <!-- end card -->
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="card-style mb-10">
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
                                        <h6>Harga</h6>
                                    </th>
                                    <th>
                                        <h6>Total</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sale->saleDetails as $index => $sale_detail)
                                    <tr id="{{ $sale_detail['product_id'] }}">
                                        <td class="p-name">{{ $sale_detail->productPrice->product->name }}</td>
                                        <td class="p-amount">{{ $sale_detail->amount }}</td>
                                        <td class="p-price">
                                            {{ 'Rp ' . number_format($sale_detail->price, 2, ',', '.') }}</td>
                                        <td class="p-total">
                                            {{ 'Rp ' . number_format($sale_detail->amount * $sale_detail->price, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($sale->method->value == 2)
                        <div class="row" id="cardBank">
                            <div class="col-md-6 col-sm-12">
                                <div class="card-style mb-10">
                                    <table class="table">
                                        <tr>
                                            <th>Nama Bank</th>
                                            <td>: {{ $sale->transfersale?->noRekening->bank->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Rekening</th>
                                            <td>: {{ $sale->transfersale?->noRekening->account_number ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Atas Nama</th>
                                            <td>: {{ $sale->transfersale?->noRekening->name ?? '' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-style mb-10 d-flex p-3 justify-content-between align-items-center">
                            <h6>Total : </h6>
                            <h4>
                                <u>{{ 'Rp ' . number_format($sale->total, 2, ',', '.') }}</u>
                            </h4>
                        </div>
                    @elseif ($sale->method->value == 1)
                        <div id="additionalData" class="card-style mb-30">
                            <div class="input-style-1">
                                <label>Sales</label>
                                <input type="text" placeholder="Sales" name="sales"
                                    value="{{ $sale->receivableSale->sales }}" disabled>
                            </div>
                        </div>
                        <div class="card-style mb-30 d-flex p-3 justify-content-between align-items-center">
                            <h6>Total : </h6>
                            <span
                                id="totalsale">{{ 'Rp ' . number_format($sale->total, 2, ',', '.') }}</span>
                        </div>
                    @else
                        <div class="card-style mb-30 d-flex p-3 justify-content-between align-items-center">
                            <h6>Total : </h6>
                            <span id="totalsale">{{ 'Rp ' . number_format($sale->total, 2, ',', '.') }}</span>
                        </div>
                    @endif
                    <div class="card-style mb-30 d-flex p-3 justify-content-between align-items-center">
                        <h6>Total Dibayar : </h6>
                        <h4 class="text-primary">
                            {{ 'Rp ' . number_format($sale->amount_paid, 2, ',', '.') }}
                        </h4>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
            <!-- ========== tables-wrapper end ========== -->
        </div>
        <!-- end container -->
    </section>
@endsection
