@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <!-- ========== section start ========== -->
    @if(Auth::user()->code== 'A')
    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                </div>
                <!-- end row -->
            </div>
            {{-- <h1 style="text-align: center; color: #f49d2c;">Selamat Datang Di Toko Luluk</h1> --}}
            <div class="row">
                <div class="col-lg-5">
                    <div class="card-style calendar-card mb-30">
                        <div id="calendar-mini"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                </div>
                <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-sm-6" style="display: flex; flex-direction: column;">
                    <a href="{{ route('sales.cash.index') }}" style="text-decoration: none;">
                        <div class="icon-card mb-30" style="background-color: #84aaf6; border: 1px solid #5fccff; border-radius: 8px;">
                            <div class="icon purple" style="color: #ffffff;">
                                <i class="lni lni-cart-full"></i>
                            </div>
                            <div class="content">
                                <h6 class="mb-10" style="color: #ffffff;">Penjualan</h6>
                                <h3 class="text-bold mb-10" style="color: #ffffff;">Cash</h3>
                            </div>
                        </div>
                    </a>
                </div>
            
                <div class="col-xl-3 col-lg-4 col-sm-6" style="display: flex; flex-direction: column;">
                    <a href="{{ route('sales.receivable.index') }}" style="text-decoration: none;">
                        <div class="icon-card mb-30" style="background-color: #ffffff; border: 1px solid #070e11; border-radius: 8px;">
                            <div class="icon purple" style="color: #000000;">
                                <i class="lni lni-package"></i>
                            </div>
                            <div class="content">
                                <h6 class="mb-10">Penjualan</h6>
                                <h3 class="text-bold mb-10">Piutang</h3>
                            </div>
                        </div>
                    </a>
                </div>
                
            
                <div class="col-xl-3 col-lg-4 col-sm-6" style="display: flex; flex-direction: column;">
                    <a href="{{ route('receivable-payments.cash.index') }}" style="text-decoration: none;">
                        <div class="icon-card mb-30" style="background-color: #fc8f8f; border: 1px solid #fb6a93; border-radius: 8px;">
                            <div class="icon success" style="color: #ffffff;">
                                <i class="lni lni-dollar"></i>
                            </div>
                            <div class="content">
                                <h6 class="mb-10" style="color: #ffffff;">Pembayaran Piutang</h6>
                                <h3 class="text-bold mb-10" style="color: #ffffff;">Cash</h3>
                            </div>
                        </div>
                    </a>
                </div>
            
                <div class="col-xl-3 col-lg-4 col-sm-6" style="display: flex; flex-direction: column;">
                    <a href="{{ route('report.sales') }}" style="text-decoration: none;">
                        <div class="icon-card mb-30" style="background-color: #e5e5e5; border: 1px solid #cccccc; border-radius: 8px;">
                            <div class="icon success" style="color: #000000;">
                                <i class="lni lni-layout"></i>
                            </div>
                            <div class="content">
                                <h6 class="mb-10">Laporan</h6>
                                <h3 class="text-bold mb-10">Penjualan</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
            
            {{-- <div class="row">
                <div class="col-lg-5">
                    <div class="card-style calendar-card mb-30">
                        <div id="calendar-mini"></div>
                    </div>
                </div>
            </div> --}}
            <!-- End Row -->
        </div>
    </section>
    @endif
    
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
