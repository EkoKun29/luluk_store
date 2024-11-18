@extends('layouts.app')
@section('title')
    Tambah Pembayara Piutang @yield('name')
@endsection
@section('content')
    <section class="table-components">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title mb-30">
                            <h2>Tambah Pembayaran Piutang @yield('name')</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper mb-30">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Pembayaran Piutang</a>
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
            <form action="{{ route('receivable-payments.store') }}" method="POST">
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
                                    <select id="sale_id" name="sale_id" required>
                                        <option value="" selected hidden>Pilih Nota Penjualan</option>
                                        @foreach ($sales as $sale)
                                            <option value="{{ $sale->id }}"
                                                {{ old('sale_id') == $sale->id ? 'selected' : '' }}>
                                                {{ $sale->note_number. ' - ' . $sale->consumer . ' - ' . $sale->formatted_date }}
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
                                            <h6>Harga</h6>
                                        </th>
                                        <th>
                                            <h6>Satuan</h6>
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
        const currentSaleId = "{{ old('sale_id') }}"
        const sales = @json($sales);

        function changeSaleId(saleId) {
            $('#tblProducts tbody tr').remove();
            let sale = sales.find(sale => sale.id === saleId);
            if (sale != null) {
                $('#paidOffTotal').text(formatRupiah((sale.receivable_paid_off + sale.amount_paid).toString()));
                $('#total').text(formatRupiah(sale.total.toString()));
                $('#insufficientTotal').text(formatRupiah((sale.total - (sale.receivable_paid_off + sale.amount_paid)).toString()));
                for (let sale_detail of sale.sale_details) {
                    $('#tblProducts tbody').append(
                        `<tr>
                            <td>${sale_detail.product_price.name}</td>
                            <td>${sale_detail.amount}</td>
                            <td>${formatRupiah(sale_detail.product_price.price.toString())}</td>
                            <td>${sale_detail.product_price.product.unit}</td>
                            <td>${formatRupiah((sale_detail.product_price.price * sale_detail.amount).toString())}</td>
                        </tr>`
                    );
                }
            }
        }

        $(document).ready(function() {
            if (currentSaleId) {
                changeSaleId(currentSaleId);
            }

            $('#sale_id').on('change', function() {
                changeSaleId(this.value);
            });
        })
    </script>
@endpush
