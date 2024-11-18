<!-- Modal -->
<div class="modal fade" id="createProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Silahkan Masukkan Barang Yang Dibeli</h5>
            </div>
            <div class="modal-body">
                <form id="frmCreateProduct" class="create-form needs-validation" novalidate>
                    <div class="select-style-1">
                        <label>Barang</label>
                        <div class="select-position">
                            <select id="product_id" name="product_id" required>
                                <option value="" selected hidden>Pilih Produk</option>
                            </select>
                        </div>
                        <div class="invalid-feedback">
                            Pilih Satu Item Produk
                        </div>
                    </div>
                    <div class="input-style-1">
                        <label>Jumlah</label>
                        <input step="0.01" min="0.01" id="amount" type="number" placeholder="Jumlah Pembelian" name="amount" required>
                        <div class="invalid-feedback">
                            Masukkan Jumlah Pembelian Dengan Benar
                        </div>
                    </div>
                    <div class="input-style-1">
                        <label>Harga</label>
                        <input id="price" type="number" placeholder="Harga Pembelian" name="price" required>
                        <div class="invalid-feedback">
                            Masukkan Harga Beli Produk Dengan Benar
                        </div>
                    </div>
                    <div class="input-style-1">
                        <label>Satuan</label>
                        <input id="unit" type="text" placeholder="Satuan Barang" name="unit" disabled>
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
                    $("#frmCreateProduct #unit").val($(this).find(':selected').data('unit'));
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
                            let productId = $('#frmCreateProduct #product_id option:selected').val();
                            let productName = $('#frmCreateProduct #product_id option:selected').text();
                            let amount = $('#frmCreateProduct #amount').val();
                            let price = $('#frmCreateProduct #price').val();
                            let unit = $('#frmCreateProduct #unit').val();
                            let total = (parseFloat(amount)*parseInt(price)).toString()
                            let newRowIndex = $('#tblProducts tbody tr').length;

                            let row = `<tr id="${productId}">`;
                            row += `<td class="p-name">${productName}</td>`;
                            row += `<td class="p-amount">${amount}</td>`;
                            row += `<td class="p-price">${formatRupiah(price)}</td>`;
                            row += `<td class="p-unit">${unit}</td>`;
                            row +=
                                `<td class="p-total">${formatRupiah(total)}</td>`;
                            row += `<td><div class='action'>
                                <button class="text-success btn-edit" type="button" data-id="${productId}">
                                    <i class="lni lni-pencil"></i>
                                </button>
                                <button class="text-danger btn-delete" type="button" data-id="${productId}">
                                    <i class="lni lni-trash-can"></i>
                                </button>
                            </div></td>`;
                            row +=
                                `<input type='hidden' class="tbl-product-id" name="purchase_details[${newRowIndex}][product_id]" value='${productId}'/>`;
                            row +=
                                `<input type='hidden' class="tbl-product-name" name="purchase_details[${newRowIndex}][product_name]" value='${productName}'/>`;
                            row +=
                                `<input type='hidden' class="tbl-amount" name="purchase_details[${newRowIndex}][amount]" value='${amount}'/>`;
                            row +=
                                `<input type='hidden' class="tbl-price" name="purchase_details[${newRowIndex}][price]" value='${price}'/>`;
                            row +=
                                `<input type='hidden' class="tbl-unit" name="purchase_details[${newRowIndex}][unit]" value='${unit}'/>`;
                            row +=
                                `<input type='hidden' class="tbl-total" name="purchase_details[${newRowIndex}][total]" value='${total}'/>`;
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
