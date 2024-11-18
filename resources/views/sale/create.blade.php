@extends('layouts.app')
@section('title')
    Tambah Penjualan @yield('name')
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
                            <h2>Tambah Penjualan @yield('name')</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper mb-30">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Penjualan @yield('name')</a>
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
            <form action="{{ route('sales.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="card-style mb-30">
                            @include('sale.components.sale_input')
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
                                    @if (old('sale_details'))
                                        @foreach (old('sale_details') as $index => $sale_detail)
                                            <tr id="{{ $sale_detail['product_price_id'] }}">
                                                <td class="p-name">{{ $sale_detail['product_name'] }}</td>
                                                <td class="p-amount">{{ $sale_detail['amount'] }}</td>
                                                <td class="p-price">
                                                    {{ 'Rp ' . number_format($sale_detail['price'], 2, ',', '.') }}
                                                </td>
                                                <td class="p-unit">
                                                    {{ $sale_detail['unit'] }}
                                                </td>
                                                <td class="p-total">
                                                    {{ 'Rp ' . number_format($sale_detail['total'], 2, ',', '.') }}
                                                </td>
                                                <td>
                                                    <div class='action'>
                                                        <button class="text-success btn-edit" type="button"
                                                            data-id="{{ $sale_detail['product_id'] }}"
                                                            data-price-id="{{ $sale_detail['product_price_id'] }}">
                                                            <i class="lni lni-pencil"></i>
                                                        </button>
                                                        <button class="text-danger btn-delete" type="button"
                                                            data-id="{{ $sale_detail['product_id'] }}"
                                                            data-price-id="{{ $sale_detail['product_price_id'] }}">
                                                            <i class="lni lni-trash-can"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <input type='hidden' class="tbl-product-id"
                                                    name="sale_details[{{ $index }}][product_id]"
                                                    value='{{ $sale_detail['product_id'] }}' />
                                                <input type='hidden' class="tbl-product-price-id"
                                                    name="sale_details[{{ $index }}][product_price_id]"
                                                    value='{{ $sale_detail['product_price_id'] }}' />
                                                <input type='hidden' class="tbl-product-name"
                                                    name="sale_details[{{ $index }}][product_name]"
                                                    value='{{ $sale_detail['product_name'] }}' />
                                                <input type='hidden' class="tbl-amount"
                                                    name="sale_details[{{ $index }}][amount]"
                                                    value='{{ $sale_detail['amount'] }}' />
                                                <input type='hidden' class="tbl-price"
                                                    name="sale_details[{{ $index }}][price]"
                                                    value='{{ $sale_detail['price'] }}' />
                                                <input type='hidden' class="tbl-unit"
                                                    name="sale_details[{{ $index }}][unit]"
                                                    value='{{ $sale_detail['unit'] }}' />
                                                <input type='hidden' class="tbl-total"
                                                    name="sale_details[{{ $index }}][total]"
                                                    value='{{ $sale_detail['total'] }}' />
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" class="text-center">
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
                            <h6>Total : <span id="totalSale"></span></h6>
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
    @include('sale.components.create_product_modal')
    @include('sale.components.edit_product_modal')
@endsection
@push('js')
    <script>
        const products = @json($products);
        const oldSaleDetails = @json(old('sale_details'));
        let rowsId = [];

        function initProductSelect() {
            // Buat elemen select
            var selectElement = $('<select id="product_id"></select>');

            // Tambahkan setiap produk ke dalam elemen select
            $.each(products, function(index, product) {
                var option = new Option(product.name, product.id);
                $(option).attr('data-id', product.product_price.price);
                $(option).attr('data-unit', product.unit);
                $(selectElement).append(option);
            });

            // Ganti elemen #frmCreateProduct #product_id dengan elemen select baru
            $("#frmCreateProduct #product_id").replaceWith(selectElement);

            // Inisialisasi TomSelect
            var select = new TomSelect('#product_id', {
                create: true, // Izinkan membuat opsi baru
                // Tambahkan konfigurasi lain yang diperlukan
            });

            // Jika ada detail penjualan sebelumnya, tambahkan produk yang sesuai
            if (oldSaleDetails != null) {
                oldSaleDetails.forEach(element => {
                    select.addItem(element['product_id']);
                });
            }
        }


        function pushProduct(id) {
            rowsId.push(id)
            $(`#frmCreateProduct #product_id option[value='${id}']`).remove();
            hitungTotal();
        }

        function pullProduct(productId, priceId) {
            if (products.length > 0 && rowsId.length > 0) {
                rowsId.splice(rowsId.indexOf(productId), 1);

                $('table#tblProducts tbody tr#' + priceId).remove();
                $('table#tblProducts tbody tr#' + productId).remove();

                let currentProduct = products.find((product) => product.id === productId)

                var o = new Option(currentProduct.name, currentProduct.id);
                $(o).html(currentProduct.name);
                $("#frmCreateProduct #product_id").append(o);
                hitungTotal();
            }
        }

        function getProductPrices(id) {
            let productPrices = products.find(product => product.id === id)?.product_prices;
            return productPrices;
        }

        function changeProductId(selector, id, unit) {
            $(selector)
                .find('option')
                .remove()
                .end()
            let product_prices = getProductPrices(id);
            for (let product_price of product_prices) {
                let label = `${formatRupiah(product_price.price.toString())} - ${product_price.local_created_at}`
                var o = new Option(label, product_price.id);
                /// jquerify the DOM object 'o' so we can use the html method
                $(o).html(label);
                $(o).attr('data-id', product_price.price)
                $(selector).append(o);
            }
            $("#frmCreateProduct #unit").val(unit)
        }

        function hitungTotal() {
            let total = 0;
            $('#tblProducts tbody tr').each(function() {
                let amount = parseFloat($(this).find("input.tbl-amount").val())
                let price = parseInt($(this).find("input.tbl-price").val())
                total += amount * price
            })
            $('#totalSale').text(formatRupiah(total.toString()))
        }

        $(document).ready(function() {
            hitungTotal()
            initProductSelect()

            $('#btnAddProduct').on('click', function() {
                $('#frmCreateProduct').removeClass('was-validated');
                $('#frmCreateProduct #product_id').val("");
                $('#frmCreateProduct #product_price_id').val("");
                $('#frmCreateProduct #product_price_id')
                    .find('option')
                    .remove()
                    .end()
                $('#frmCreateProduct #amount').val("");
                $('#createProductModal').modal('show');
            })

            $('#tblProducts').on('click', '.btn-edit', function() {
                let parentRow = $(this).closest('tr');
                $('#frmEditProduct #product_id').val($(this).data('id'))
                changeProductId('#frmEditProduct #product_price_id', $(this).data('id'));
                $('#frmEditProduct #product_price_id').val($(this).data('price-id'))
                $('#frmEditProduct #product_name').val(parentRow.find('td.p-name').text())
                $('#frmEditProduct #amount').val(parentRow.find('.tbl-amount').val())
                $('#frmEditProduct #price').val(parentRow.find('.tbl-price').val())
                $('#frmEditProduct').removeClass('was-validated');
                $('#editProductModal').modal('show');
            })

            $('#tblProducts').on('click', '.btn-delete', function() {
                if (confirm('Hapus Produk?') == true) {
                    pullProduct($(this).data('id'), $(this).data('price-id'))
                }
            })
        });
    </script>
@endpush
