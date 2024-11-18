<!-- Modal -->
<div class="modal fade" id="createProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Silahkan Masukkan Barang Yang Dijual</h5>
            </div>
            <div class="modal-body">
                <form id="frmCreateProduct" class="create-form needs-validation" novalidate>
                    <div class="select-style-1">
                        <label>Barang</label>
                        <div class="select-position">
                            <select id="product_id" name="product_id" required>
                            </select>
                        </div>
                        <div class="invalid-feedback">
                            Pilih Satu Item Produk
                        </div>
                    </div>
                    <div class="select-style-1">
                        <label>Harga Satuan</label>
                        <div class="select-position">
                            <select id="product_price_id" name="product_price_id" required>
                            </select>
                        </div>
                        <div class="invalid-feedback">
                            Pilih Harga Yang Sesuai
                        </div>
                    </div>
                    <div class="input-style-1">
                        <label>Jumlah</label>
                        <input step="0.01" min="0.01" id="amount" type="number" placeholder="Jumlah Penjualan"
                            name="amount" required>
                        <div class="invalid-feedback">
                            Masukkan Jumlah Penjualan Dengan Benar
                        </div>
                    </div>
                    <div class="input-style-1">
                        <label>Satuan</label>
                        <input id="unit" type="text" placeholder="Satuan Barang"
                            name="unit" disabled>
                    </div>
                    <button id="btnAdd" type="submit"
                        class="main-btn primary-btn rounded-md btn-hover">Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                $('#product_id').on('change', function() {
                    changeProductId('#frmCreateProduct #product_price_id', this.value, $(this).find(':selected').data('unit'));
                })
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('create-form');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                            form.classList.add('was-validated');
                        } else {
                            event.preventDefault();
                            let productId = $('#frmCreateProduct #product_id option:selected')
                                .val();
                            let productPriceId = $(
                                    '#frmCreateProduct #product_price_id option:selected')
                                .val();
                            let productName = $('#frmCreateProduct #product_id option:selected')
                                .text();
                            let amount = $('#frmCreateProduct #amount').val();
                            let unit = $('#frmCreateProduct #unit').val();

                            let price = $('#frmCreateProduct #product_price_id option:selected')
                                .data('id');

                            let total = (parseFloat(amount) * parseInt(price)).toString()
                            let newRowIndex = $('#tblProducts tbody tr').length;

                            let row = `<tr id="${productPriceId}">`;
                            row += `<td class="p-name">${productName}</td>`;

                            row += `<td class="p-amount">${amount}</td>`;
                            row += `<td class="p-price">${formatRupiah(price.toString())}</td>`;
                            row += `<td class="p-unit">${unit}</td>`;
                            row +=
                                `<td class="p-total">${formatRupiah(total)}</td>`;
                            row += `<td><div class='action'>
                                <button class="text-success btn-edit" type="button" data-id="${productId}" data-price-id="${productPriceId}">
                                    <i class="lni lni-pencil"></i>
                                </button>
                                <button class="text-danger btn-delete" type="button" data-id="${productId}" data-price-id="${productPriceId}">
                                    <i class="lni lni-trash-can"></i>
                                </button>
                            </div></td>`;
                            row +=
                                `<input type='hidden' class="tbl-product-id" name="sale_details[${newRowIndex}][product_id]" value='${productId}'/>`;
                            row +=
                                `<input type='hidden' class="tbl-product-price-id" name="sale_details[${newRowIndex}][product_price_id]" value='${productPriceId}'/>`;
                            row +=
                                `<input type='hidden' class="tbl-product-name" name="sale_details[${newRowIndex}][product_name]" value='${productName}'/>`;
                            row +=
                                `<input type='hidden' class="tbl-amount" name="sale_details[${newRowIndex}][amount]" value='${amount}'/>`;
                            row +=
                                `<input type='hidden' class="tbl-price" name="sale_details[${newRowIndex}][price]" value='${price}'/>`;
                            row +=
                                `<input type='hidden' class="tbl-unit" name="sale_details[${newRowIndex}][unit]" value='${unit}'/>`;
                            row +=
                                `<input type='hidden' class="tbl-total" name="sale_details[${newRowIndex}][total]" value='${total}'/>`;
                            row += "</tr>"
                            $('#tblProducts tbody').append(row);
                            $('#createProductModal').modal('hide');
                            $('#frmCreateProduct').find("input, select").val("")
                            form.classList.remove('was-validated');
                            pushProduct(productId);
                        }
                    }, false);
                });
            }, false);
        })();
    </script>
@endpush
