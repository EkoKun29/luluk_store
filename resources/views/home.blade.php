@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <!-- ========== section start ========== -->
    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title mb-30">
                            <h2>Toko Luluk Dashboard</h2>
                        </div>
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon purple">
                            <i class="lni lni-cart-full"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">User</h6>
                            <h3 class="text-bold mb-10">{{ $usersCount }}</h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon success">
                            <i class="lni lni-dollar"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Produk</h6>
                            <h3 class="text-bold mb-10">{{ $productsCount }}</h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon primary">
                            <i class="lni lni-credit-cards"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Pembelian</h6>
                            <h3 class="text-bold mb-10">{{ $purchasesCount }}</h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon orange">
                            <i class="lni lni-user"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Penjualan</h6>
                            <h3 class="text-bold mb-10">{{ $salesCount }}</h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card-style mb-30">
                        <div
                            class="title d-flex flex-wrap justify-content-between align-items-center">
                            <div class="left">
                                <h6 class="text-medium mb-30">Riwayat Pembelian</h6>
                            </div>
                        </div>
                        <!-- End Title -->
                        <div class="table-responsive">
                            <table class="table top-selling-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6 class="text-sm text-medium">Tanggal</h6>
                                        </th>
                                        <th>
                                            <h6 class="text-sm text-medium">Nota</h6>
                                        </th>
                                        <th class="min-width">
                                            <h6 class="text-sm text-medium">Total</h6>
                                        </th>
                                        <th class="min-width">
                                            <h6 class="text-sm text-medium">Metode</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($purchases as $purchase)
                                        <tr>
                                            <td>
                                                <p class="text-sm">{{ $purchase->formatted_date }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">{{ $purchase->note_number }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">{{ 'Rp ' . number_format($purchase->total, 2, ',', '.') }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">{{ $purchase->method->name }}</p>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-sm">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- End Table -->
                        </div>
                    </div>
                </div>
                <!-- End Col -->
                <div class="col-lg-6">
                    <div class="card-style mb-30">
                        <div class="title d-flex flex-wrap align-items-center justify-content-between">
                            <div class="left">
                                <h6 class="text-medium mb-30">Riwayat Penjualan</h6>
                            </div>
                            <div class="right">
                                <!-- end select -->
                            </div>
                        </div>
                        <!-- End Title -->
                        <div class="table-responsive">
                            <table class="table top-selling-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6 class="text-sm text-medium">Tanggal</h6>
                                        </th>
                                        <th>
                                            <h6 class="text-sm text-medium">Nota</h6>
                                        </th>
                                        <th class="min-width">
                                            <h6 class="text-sm text-medium">Total</h6>
                                        </th>
                                        <th class="min-width">
                                            <h6 class="text-sm text-medium">Metode</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sales as $sale)
                                        <tr>
                                            <td>
                                                <p class="text-sm">{{ $sale->formatted_date }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">{{ $sale->note_number }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">{{ 'Rp ' . number_format($sale->total, 2, ',', '.') }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">{{ $sale->method->name }}</p>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-sm">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- End Table -->
                        </div>
                    </div>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
            <div class="row">
                <div class="col-lg-5">
                    <div class="card-style calendar-card mb-30">
                        <div id="calendar-mini"></div>
                    </div>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- end container -->
    </section>
    <!-- ========== section end ========== -->
@endsection
@push('js')
    <script>
        // ====== calendar activation
        document.addEventListener("DOMContentLoaded", function() {
            var calendarMiniEl = document.getElementById("calendar-mini");
            var calendarMini = new FullCalendar.Calendar(calendarMiniEl, {
                initialView: "dayGridMonth",
                headerToolbar: {
                    end: "today prev,next",
                },
            });
            calendarMini.render();
        });
    </script>
@endpush
