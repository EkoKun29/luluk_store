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

    <section class="section" style="padding: 20px; position: relative;">

    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        <!-- POS KASIR -->
        <div class="menu-box green" style="display: flex; flex-direction: column;">
            <div class="menu-header">
                <div class="icon">💵</div>
                <div class="title">PENJUALAN</div>
                <div class="subtitle">Cash</div>
            </div>
            <a href="{{ route('sales.cash.create') }}" class="arrow-button-box green">➤</a>
        </div>

        <!-- Piutang -->
        <div class="menu-box yellow" style="display: flex; flex-direction: column;">
            <div class="menu-header">
                <div class="icon">💵</div>
                <div class="title">PENJUALAN</div>
                <div class="subtitle">Piutang</div>
            </div>
            <a href="{{ route('sales.receivable.create') }}" class="arrow-button-box green">➤</a>
        </div>

        <!-- Hutang -->
        <div class="menu-box green" style="display: flex; flex-direction: column;">
            <div class="menu-header">
                <div class="icon">🛍️</div>
                <div class="title">Pembayaran Piutang</div>
                <div class="subtitle">Cash/Transfer</div>
            </div>
            <a href="{{ route('receivable-payments.cash.create') }}" class="arrow-button-box green">➤</a>
        </div>

        <div class="menu-box green" style="display: flex; flex-direction: column;">
            <div class="menu-header">
                <div class="icon">📅</div>
                <div class="title">LAPORAN</div>
                <div class="subtitle">Penjualan</div>
            </div>
            <a href="{{ route('report.sales') }}" class="arrow-button-box green">➤</a>
        </div>

        <div class="menu-box yellow" style="display: flex; flex-direction: column;">
            <div class="menu-header">
                <div class="icon">📅</div>
                <div class="title">LAPORAN</div>
                <div class="subtitle">Pembayaran Piutang</div>
            </div>
            <a href="{{ route('report.receivable-payments') }}" class="arrow-button-box green">➤</a>
        </div>

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
