<!-- Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Silahkan Masukkan Barang Yang Dibeli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmEditProduct" class="edit-form needs-validation" novalidate>
                    <div class="input-style-1">
                        <label>Barang</label>
                        <input id="product_name" type="text" placeholder="Nama Barang" name="product_name" disabled>
                        <input id="product_id" type="hidden" placeholder="Nama Barang" name="product_id" disabled>
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
                        <input min="1" id="price" type="number" placeholder="Harga Pembelian" name="price" required>
                        <div class="invalid-feedback">
                            Masukkan Harga Beli Produk Dengan Benar
                        </div>
                    </div>
                    <button id="btnEdit" type="submit"
                        class="main-btn primary-btn rounded-md btn-hover">Ubah</button>
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
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('edit-form');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                            form.classList.add('was-validated');
                        } else {
                            event.preventDefault();
                            let productId = $('#frmEditProduct #product_id').val();
                            let amount = $('#frmEditProduct #amount').val();
                            let price = $('#frmEditProduct #price').val();
                            let total = formatRupiah((parseInt(amount)*parseInt(price)).toString())
                            let tableRow = $(`#tblProducts tbody tr#${productId}`);

                            tableRow.find("td.p-amount").html(amount)
                            tableRow.find("input.tbl-amount").val(amount)
                            tableRow.find("td.p-price").html(formatRupiah(price))
                            tableRow.find("input.tbl-price").val(price)
                            tableRow.find("td.p-total").html(total)

                            $('#editProductModal').modal('hide');
                            hitungTotal();
                            $('#frmEditProduct').find("input, select").val("")
                            form.classList.remove('was-validated');
                        }
                    }, false);
                });
            }, false);
        })();
    </script>
@endpush
