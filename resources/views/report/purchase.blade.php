@extends('layouts.app')
@section('title')
    Laporan Pembelian
@endsection
@section('content')
    <section class="table-components">
        <div class="container-fluid">

            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title mb-30">
                            <h2>Laporan Pembelian</h2>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper mb-30">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Laporan</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Pembelian
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
            <div class="row mb-3">
                <div class="col-12">
                    <form method="GET" class="d-flex flex-column flex-md-row flex-lg-row" style="gap: 20px;">
                        <input type="date" value="{{ request()->query('start_date') }}" name="start_date" id="start_date"
                            class="form-control">
                        <input type="date" value="{{ request()->query('end_date') }}" name="end_date" id="end_date"
                            class="form-control">
                        <div class="d-flex" style="gap: 20px">
                            <a href="{{ route('report.purchases') }}" type="reset" class="btn btn-sm btn-danger">Reset</a>
                            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
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
            <div class="tables-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <h6 class="mb-10">Data Laporan Penjualan</h6>
                            <div class="table-wrapper table-responsive">
                                <table class="table table-striped" id="tablePurchaseReport" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>#</h6>
                                            </th>
                                            <th>
                                                <h6>Tanggal</h6>
                                            </th>
                                            <th>
                                                <h6>No. Nota</h6>
                                            </th>
                                            <th>
                                                <h6>Supplier</h6>
                                            </th>
                                            <th>
                                                <h6>Nama Toko</h6>
                                            </th>
                                            <th>
                                                <h6>Metode</h6>
                                            </th>
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
                                        <!-- end table row-->
                                    </thead>
                                    <tbody>
                                        @foreach ($purchaseDetails as $purchaseDetail)
                                            <tr>
                                                <td class="min-width">{{ $loop->iteration }}</td>
                                                <td class="min-width">{{ $purchaseDetail->purchase->formatted_date }}</td>
                                                <td class="min-width">{{ $purchaseDetail->purchase->note_number }}</td>
                                                <td class="min-width">{{ $purchaseDetail->purchase->supplier }}</td>
                                                <td class="min-width">{{ $purchaseDetail->purchase->store_name }}</td>
                                                <td class="min-width">{{ $purchaseDetail->purchase->method->name }}</td>
                                                <td class="min-width">{{ $purchaseDetail->product->name }}</td>
                                                <td class="min-width">{{ $purchaseDetail->amount }}</td>
                                                <td class="min-width">
                                                    {{ 'Rp ' . number_format($purchaseDetail->price, 2, ',', '.') }}</td>
                                                <td class="min-width">
                                                    {{ 'Rp ' . number_format($purchaseDetail->price * $purchaseDetail->amount, 2, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!-- end table row -->
                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>
            <!-- ========== tables-wrapper end ========== -->
        </div>
        <!-- end container -->
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            let table = new DataTable('#tablePurchaseReport', {
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ]
            });
        })
    </script>
@endpush
