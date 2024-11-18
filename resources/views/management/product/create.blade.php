<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Silahkan Masukkan Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="input-style-1">
                        <label>Nama Barang</label>
                        <input type="text" placeholder="Nama Barang" name="name" required>
                    </div>
                    <div class="select-style-1">
                        <label>Ukuran</label>
                        <div class="select-position">
                            <select name="unit" required>
                                <option value="METER">METER</option>
                                <option value="BIJI">BIJI</option>
                                <option value="LUSIN">LUSIN</option>
                                <option value="GROSS">GROSS</option>
                                <option value="ONS">ONS</option>
                                <option value="MASS">MASS</option>
                                <option value="LITER">LITER</option>
                                <option value="PIS">PIS</option>
                                <option value="PASANG">PASANG</option>
                                <option value="PAK">PAK</option>
                                <option value="ROL">ROL</option>
                                <option value="KG">KG</option>
                                <option value="BUNGKUS">BUNGKUS</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-style-1">
                        <label>Stok Awal</label>
                        <input type="number" min="0" step="0.01" placeholder="Stok Awal Barang" name="stock" required>
                    </div>
                    <button type="submit" class="main-btn primary-btn rounded-md btn-hover">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


@push('js')
@endpush
