<div class="input-style-1">
    <label>Tanggal</label>
    <input type="date" placeholder="Tanggal Transaksi" name="date" value="{{ old('date') }}" required>
</div>
<div class="input-style-1">
    <label>Supplier</label>
    <input type="text" placeholder="Supplier" name="supplier" value="{{ old('supplier') }}" required>
</div>
<div class="input-style-1">
    <label>Nama Kasir</label>
    <div class="select-style-1">
        <div class="select-position">
            <select name="store_name" id="" required>
                <option value="" selected>Pilih Kasir</option>
                <option value="Linda">Linda</option>
                <option value="Arin">Arin</option>
                <option value="Vera">Vera</option>
                <option value="Ika">Ika</option>
                <option value="Tika">Tika</option>
                <option value="Atin">Atin</option>
            </select>
        </div>
    </div>
</div>
