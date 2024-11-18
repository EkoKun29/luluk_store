@extends('layouts.app')
@section('title')
    Tambah Pembelian @yield('name')
@endsection
@section('content')
    <section class="table-components">
        <div class="container-fluid">

            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <!-- end col -->
                    <div class="col-md-6">
                        <div class="title mb-30">
                            <h2>Tambah Pembelian @yield('name')</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper mb-30">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Pembelian @yield('name')</a>
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
            <form action="{{ route('purchases.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="card-style mb-30">
                            @include('purchase.components.purchase_input')
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
                                            <h6>Nama</h6>
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
                                        <th>
                                            <h6>#</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (old('purchase_details'))
                                        @foreach (old('purchase_details') as $index => $purchase_detail)
                                            <tr id="{{ $purchase_detail['product_id'] }}">
                                                <td class="p-name">{{ $purchase_detail['product_name'] }}</td>
                                                <td class="p-amount">{{ $purchase_detail['amount'] }}</td>
                                                <td class="p-price">
                                                    {{ 'Rp ' . number_format($purchase_detail['price'], 2, ',', '.') }}
                                                </td>
                                                <td class="p-total">
                                                    {{ 'Rp ' . number_format($purchase_detail['total'], 2, ',', '.') }}
                                                </td>
                                                <td>
                                                    <div class='action'>
                                                        <button class="text-success btn-edit" type="button"
                                                            data-id="{{ $purchase_detail['product_id'] }}">
                                                            <i class="lni lni-pencil"></i>
                                                        </button>
                                                        <button class="text-danger btn-delete" type="button"
                                                            data-id="{{ $purchase_detail['product_id'] }}">
                                                            <i class="lni lni-trash-can"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <input type='hidden' class="tbl-product-id"
                                                    name="purchase_details[{{ $index }}][product_id]"
                                                    value='{{ $purchase_detail['product_id'] }}' />
                                                <input type='hidden' class="tbl-product-name"
                                                    name="purchase_details[{{ $index }}][product_name]"
                                                    value='{{ $purchase_detail['product_name'] }}' />
                                                <input type='hidden' class="tbl-amount"
                                                    name="purchase_details[{{ $index }}][amount]"
                                                    value='{{ $purchase_detail['amount'] }}' />
                                                <input type='hidden' class="tbl-price"
                                                    name="purchase_details[{{ $index }}][price]"
                                                    value='{{ $purchase_detail['price'] }}' />
                                                <input type='hidden' class="tbl-unit"
                                                    name="purchase_details[{{ $index }}][unit]"
                                                    value='{{ $purchase_detail['unit'] }}' />
                                                <input type='hidden' class="tbl-total"
                                                    name="purchase_details[{{ $index }}][total]"
                                                    value='{{ $purchase_detail['total'] }}' />
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <a href="#" id="btnAddProduct">
                                                <span style="font-size: 10pt;">Tambahkan Barang</span>
                                            </a>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        @yield('method-attr-input')
                        <div class="card-style mb-30 d-flex p-3 justify-content-between align-items-center">
                            <h6>Total : <span id="totalPurchase"></span></h6>
                        </div>
                        <div class="card-style mb-30">
                            <div class="input-style-1">
                                <input type="number" min="0" placeholder="Jumlah Dibayarkan" name="amount_paid"
                                    value="{{ old('amount_paid') }}" required>
                            </div>
                        </div>
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
    @include('purchase.components.create_product_modal')
    @include('purchase.components.edit_product_modal')
@endsection
@push('js')
    <script>
        const products = @json($products);
        let rowsId = [];

        function initProductSelect() {
            $.each(products, function(index, product) {
                var o = new Option(product.name, product.id);
                /// jquerify the DOM object 'o' so we can use the html method
                $(o).html(product.name);
                $(o).attr('data-unit', product.unit)
                $("#frmCreateProduct #product_id").append(o);
            })
        }

        function pushProduct(id) {
            rowsId.push(id)
            $(`#frmCreateProduct #product_id option[value='${id}']`).remove();
            hitungTotal();
        }

        function pullProduct(id) {
            if (products.length > 0 && rowsId.length > 0) {
                rowsId.splice(rowsId.indexOf(id), 1);

                $('table#tblProducts tbody tr#' + id).remove();

                let currentProduct = products.find((product) => product.id === id)

                var o = new Option(currentProduct.name, currentProduct.id);
                $(o).html(currentProduct.name);
                $("#frmCreateProduct #product_id").append(o);
                hitungTotal();
            }
        }

        function hitungTotal() {
            let total = 0;
            $('#tblProducts tbody tr').each(function() {
                let amount = parseFloat($(this).find("input.tbl-amount").val())
                let price = parseFloat($(this).find("input.tbl-price").val())
                total += amount * price
            })
            $('#totalPurchase').text(formatRupiah(total.toString()))
        }

        $(document).ready(function() {
            hitungTotal()
            initProductSelect()

            $('#btnAddProduct').on('click', function() {
                $('#frmCreateProduct').removeClass('was-validated');
                $('#createProductModal').modal('show');
            })

            $('#tblProducts').on('click', '.btn-edit', function() {
                let parentRow = $(this).closest('tr');
                $('#frmEditProduct #product_id').val($(this).data('id'))
                $('#frmEditProduct #product_name').val(parentRow.find('td.p-name').text())
                $('#frmEditProduct #amount').val(parentRow.find('.tbl-amount').val())
                $('#frmEditProduct #price').val(parentRow.find('.tbl-price').val())
                $('#frmEditProduct').removeClass('was-validated');
                $('#editProductModal').modal('show');
            })

            $('#tblProducts').on('click', '.btn-delete', function() {
                if (confirm('Hapus Produk?') == true) {
                    pullProduct($(this).data('id'))
                }
            })
        });
    </script>
@endpush
